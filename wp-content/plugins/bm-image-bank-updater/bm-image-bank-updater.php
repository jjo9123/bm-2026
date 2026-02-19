<?php
/**
 * Plugin Name: BM Image Bank Updater (Dry Run + Batch, Split Post Types)
 * Description: Bulk-assign featured images from ACF image bank to Posts or Press, with dry-run support and locking.
 * Version: 1.2
 */

if (!defined('ABSPATH')) exit;

class BM_Image_Bank_Updater_Split {

  const META_BACKUP = '_bm_old_thumbnail_id';
  const META_LOCK   = '_bm_bank_image_id';

  public function __construct() {
    add_action('admin_menu', [$this, 'menu']);
    add_action('admin_post_bm_image_bank_run', [$this, 'run']);
  }

  public function menu() {
    add_management_page(
      'Image Bank Updater',
      'Image Bank Updater',
      'manage_options',
      'bm-image-bank-updater',
      [$this, 'page']
    );
  }

  private function get_bank_ids(): array {
    if (!function_exists('get_field')) return [];

    $bank = get_field('blog_image_bank', 'option');
    if (empty($bank) || !is_array($bank)) return [];

    $ids = [];
    foreach ($bank as $item) {
      if (is_numeric($item)) $ids[] = (int)$item;
      elseif (is_array($item) && !empty($item['ID'])) $ids[] = (int)$item['ID'];
    }

    return array_values(array_unique(array_filter($ids)));
  }

  private function get_offset_key(string $post_type): string {
    return 'bm_image_bank_offset_' . $post_type;
  }

  private function get_saved_offset(string $post_type): int {
    return (int) get_option($this->get_offset_key($post_type), 0);
  }

  private function save_offset(string $post_type, int $offset): void {
    update_option($this->get_offset_key($post_type), max(0, $offset), false);
  }

  private function reset_offset(string $post_type): void {
    delete_option($this->get_offset_key($post_type));
  }

  private function count_total(string $post_type): int {
    $args = [
      'post_type'      => $post_type,
      'post_status'    => 'publish',
      'posts_per_page' => 1,
      'fields'         => 'ids',
      'no_found_rows'  => false,
    ];

    // Exclude events/pastevents for normal posts only
    if ($post_type === 'post') {
      $args['tax_query'] = [[
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => ['events', 'pastevents'],
        'operator' => 'NOT IN',
      ]];
    }

    $q = new WP_Query($args);
    return (int) $q->found_posts;
  }

  /**
   * Deterministic “random” pick per post ID.
   * Used for save_post style behaviour (not list-order aware).
   */
  private function pick_hashed(int $post_id, array $bank_ids): int {
    $count = count($bank_ids);
    if ($count === 0) return 0;

    $index = abs(crc32('bm-blog-bank-' . $post_id)) % $count;
    return (int) $bank_ids[$index];
  }

  /**
   * List-order aware pick: cycles through bank in the same order as the bulk query.
   * This gives best distribution on date-sorted index pages.
   */
  private function pick_cycled(int $position, array $bank_ids): int {
    $count = count($bank_ids);
    if ($count === 0) return 0;

    return (int) $bank_ids[$position % $count];
  }

  public function page() {
    if (!current_user_can('manage_options')) return;

    $bank_ids = $this->get_bank_ids();

    $ran      = isset($_GET['ran']);
    $dry      = !empty($_GET['dry']);
    $type     = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
    $updated  = isset($_GET['updated']) ? (int) $_GET['updated'] : 0;
    $skipped  = isset($_GET['skipped']) ? (int) $_GET['skipped'] : 0;
    $done     = !empty($_GET['done']);
    $next     = isset($_GET['next']) ? (int) $_GET['next'] : null;

    $samples  = [];
    if (!empty($_GET['samples'])) {
      $decoded = json_decode(stripslashes((string)$_GET['samples']), true);
      if (is_array($decoded)) $samples = $decoded;
    }

    $offset_post  = $this->get_saved_offset('post');
    $offset_press = $this->get_saved_offset('press');

    $total_post   = $this->count_total('post');
    $total_press  = $this->count_total('press');

    ?>
    <div class="wrap">
      <h1>Image Bank Updater</h1>

      <p><strong>Bank size:</strong> <?php echo esc_html(count($bank_ids)); ?></p>

      <?php if (empty($bank_ids)) : ?>
        <div class="notice notice-error"><p>
          No images found in ACF Options gallery field <code>blog_image_bank</code>.
        </p></div>
      <?php endif; ?>

      <div class="notice notice-info">
        <p>
          <strong>Progress</strong><br>
          Posts: offset <code><?php echo esc_html($offset_post); ?></code> of ~<code><?php echo esc_html($total_post); ?></code><br>
          Press: offset <code><?php echo esc_html($offset_press); ?></code> of ~<code><?php echo esc_html($total_press); ?></code>
        </p>
      </div>

      <?php if ($ran) : ?>
        <div class="notice notice-success"><p>
          <?php echo $dry ? '<strong>DRY RUN</strong> — ' : ''; ?>
          Type: <strong><?php echo esc_html($type ?: '—'); ?></strong><br>
          Updated/Would update: <strong><?php echo esc_html($updated); ?></strong><br>
          Skipped: <strong><?php echo esc_html($skipped); ?></strong><br>
          Next offset: <strong><?php echo esc_html($next ?? 0); ?></strong>
          <?php if ($done) : ?> — <strong>Done for this type.</strong><?php endif; ?>
        </p></div>

        <?php if (!empty($samples)) : ?>
          <h2>Sample (first few items from this run)</h2>
          <table class="widefat striped">
            <thead>
              <tr>
                <th>Post ID</th>
                <th>Old Thumb</th>
                <th>New Thumb</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($samples as $row) : ?>
                <tr>
                  <td><?php echo esc_html($row['id']); ?></td>
                  <td><?php echo esc_html($row['old']); ?></td>
                  <td><?php echo esc_html($row['new']); ?></td>
                  <td><?php echo esc_html($row['action']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      <?php endif; ?>

      <hr>

      <h2>Run Posts</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-bottom: 24px;">
        <?php wp_nonce_field('bm_image_bank_run'); ?>
        <input type="hidden" name="action" value="bm_image_bank_run">
        <input type="hidden" name="post_type" value="post">

        <table class="form-table">
          <tr>
            <th scope="row"><label for="batch_post">Batch size</label></th>
            <td><input name="batch" id="batch_post" value="200" class="small-text"> (100–300 recommended)</td>
          </tr>
          <tr>
            <th scope="row"><label for="dry_post">Dry run</label></th>
            <td><label><input type="checkbox" id="dry_post" name="dry_run" value="1" checked> Do not write changes</label></td>
          </tr>
          <tr>
            <th scope="row"><label for="overwrite_post">Overwrite existing featured images?</label></th>
            <td><label><input type="checkbox" id="overwrite_post" name="overwrite" value="1" checked> Yes</label></td>
          </tr>
          <tr>
            <th scope="row"><label for="backup_post">Backup old thumbnail?</label></th>
            <td><label><input type="checkbox" id="backup_post" name="backup" value="1" checked> Save old to <code><?php echo esc_html(self::META_BACKUP); ?></code></label></td>
          </tr>
          <tr>
            <th scope="row"><label for="lock_post">Lock bank choice?</label></th>
            <td><label><input type="checkbox" id="lock_post" name="lock" value="1" checked> Save to <code><?php echo esc_html(self::META_LOCK); ?></code></label></td>
          </tr>
        </table>

        <?php submit_button('Run Posts Batch'); ?>
      </form>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top:-10px;">
        <?php wp_nonce_field('bm_image_bank_run'); ?>
        <input type="hidden" name="action" value="bm_image_bank_run">
        <input type="hidden" name="post_type" value="post">
        <input type="hidden" name="reset_offset" value="1">
        <?php submit_button('Reset Posts Offset', 'secondary'); ?>
      </form>

      <hr>

      <h2>Run Press</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-bottom: 24px;">
        <?php wp_nonce_field('bm_image_bank_run'); ?>
        <input type="hidden" name="action" value="bm_image_bank_run">
        <input type="hidden" name="post_type" value="press">

        <table class="form-table">
          <tr>
            <th scope="row"><label for="batch_press">Batch size</label></th>
            <td><input name="batch" id="batch_press" value="200" class="small-text"> (100–300 recommended)</td>
          </tr>
          <tr>
            <th scope="row"><label for="dry_press">Dry run</label></th>
            <td><label><input type="checkbox" id="dry_press" name="dry_run" value="1" checked> Do not write changes</label></td>
          </tr>
          <tr>
            <th scope="row"><label for="overwrite_press">Overwrite existing featured images?</label></th>
            <td><label><input type="checkbox" id="overwrite_press" name="overwrite" value="1" checked> Yes</label></td>
          </tr>
          <tr>
            <th scope="row"><label for="backup_press">Backup old thumbnail?</label></th>
            <td><label><input type="checkbox" id="backup_press" name="backup" value="1" checked> Save old to <code><?php echo esc_html(self::META_BACKUP); ?></code></label></td>
          </tr>
          <tr>
            <th scope="row"><label for="lock_press">Lock bank choice?</label></th>
            <td><label><input type="checkbox" id="lock_press" name="lock" value="1" checked> Save to <code><?php echo esc_html(self::META_LOCK); ?></code></label></td>
          </tr>
        </table>

        <?php submit_button('Run Press Batch'); ?>
      </form>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top:-10px;">
        <?php wp_nonce_field('bm_image_bank_run'); ?>
        <input type="hidden" name="action" value="bm_image_bank_run">
        <input type="hidden" name="post_type" value="press">
        <input type="hidden" name="reset_offset" value="1">
        <?php submit_button('Reset Press Offset', 'secondary'); ?>
      </form>

      <p style="margin-top: 24px;">
        <strong>Notes:</strong><br>
        - Posts exclude categories <code>events</code> and <code>pastevents</code>.<br>
        - Press has no exclusions (runs on all press).<br>
        - Bulk assignment runs newest → oldest (date DESC) to match your index order and distribute images evenly.<br>
        - When you’re done, deactivate and delete this plugin.
      </p>
    </div>
    <?php
  }

  public function run() {
    if (!current_user_can('manage_options')) wp_die('Nope.');
    check_admin_referer('bm_image_bank_run');

    $bank_ids = $this->get_bank_ids();
    if (empty($bank_ids)) wp_die('No bank images found.');

    $post_type = isset($_POST['post_type']) ? sanitize_key($_POST['post_type']) : '';
    if (!in_array($post_type, ['post', 'press'], true)) wp_die('Invalid post type.');

    if (!empty($_POST['reset_offset'])) {
      $this->reset_offset($post_type);
      wp_safe_redirect(add_query_arg(['page' => 'bm-image-bank-updater'], admin_url('tools.php')));
      exit;
    }

    $batch     = max(1, (int)($_POST['batch'] ?? 200));
    $dry_run   = !empty($_POST['dry_run']);
    $backup    = !empty($_POST['backup']);
    $overwrite = !empty($_POST['overwrite']);
    $lock      = !empty($_POST['lock']);

    $offset = $this->get_saved_offset($post_type);

    // IMPORTANT: order by DATE DESC to match the index page order, so images cycle nicely.
    $args = [
      'post_type'      => $post_type,
      'post_status'    => 'publish',
      'posts_per_page' => $batch,
      'offset'         => $offset,
      'fields'         => 'ids',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ];

    if ($post_type === 'post') {
      $args['tax_query'] = [[
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => ['events', 'pastevents'],
        'operator' => 'NOT IN',
      ]];
    }

    $ids = get_posts($args);

    $updated_count = 0;
    $skipped_count = 0;
    $samples = [];

    $bank_count = count($bank_ids);

    foreach ($ids as $i => $post_id) {
      $post_id = (int) $post_id;

      $old_thumb = (int) get_post_thumbnail_id($post_id);

      if (!$overwrite && $old_thumb) {
        $skipped_count++;
        $this->maybe_sample($samples, $post_id, $old_thumb, $old_thumb, 'skip (has thumb)');
        continue;
      }

      // Position-aware cycling gives best visible distribution on date-sorted listings
      $position = $offset + (int)$i;
      $new_thumb = $this->pick_cycled($position, $bank_ids);

      // If you ever run without lock, fall back to hashed per-post (still decent)
      if (!$new_thumb) {
        $new_thumb = $this->pick_hashed($post_id, $bank_ids);
      }

      if ($old_thumb === $new_thumb) {
        $skipped_count++;
        $this->maybe_sample($samples, $post_id, $old_thumb, $new_thumb, 'skip (already set)');
        continue;
      }

      if ($dry_run) {
        $updated_count++;
        $this->maybe_sample($samples, $post_id, $old_thumb, $new_thumb, 'would update');
        continue;
      }

      if ($backup && $old_thumb && !get_post_meta($post_id, self::META_BACKUP, true)) {
        update_post_meta($post_id, self::META_BACKUP, $old_thumb);
      }

      if ($lock) {
        update_post_meta($post_id, self::META_LOCK, $new_thumb);
      }

      set_post_thumbnail($post_id, $new_thumb);
      $updated_count++;
      $this->maybe_sample($samples, $post_id, $old_thumb, $new_thumb, 'updated');
    }

    $next_offset = $offset + $batch;
    $done = (count($ids) < $batch);

    // Persist offset only when NOT dry run (so you can rerun same batch while testing)
    if (!$dry_run) {
      $this->save_offset($post_type, $next_offset);
    }

    wp_safe_redirect(add_query_arg([
      'page'    => 'bm-image-bank-updater',
      'ran'     => 1,
      'type'    => $post_type,
      'updated' => $updated_count,
      'skipped' => $skipped_count,
      'next'    => $next_offset,
      'done'    => $done ? 1 : 0,
      'dry'     => $dry_run ? 1 : 0,
      'samples' => wp_json_encode($samples),
    ], admin_url('tools.php')));

    exit;
  }

  private function maybe_sample(&$samples, int $id, $old, $new, string $action): void {
    if (count($samples) >= 12) return;
    $samples[] = [
      'id'     => $id,
      'old'    => $old ?: '—',
      'new'    => $new ?: '—',
      'action' => $action,
    ];
  }
}

new BM_Image_Bank_Updater_Split();
