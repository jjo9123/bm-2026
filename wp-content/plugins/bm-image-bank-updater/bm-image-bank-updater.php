<?php
/**
 * Plugin Name: BM Image Bank Updater (Dry Run + Batch, Combined Mode)
 * Description: Bulk-assign featured images from an ACF image bank to Posts, Press, or a combined Posts + Press index order, with dry-run support, offsets, backups, and locking.
 * Version: 1.3
 */

if (!defined('ABSPATH')) exit;

class BM_Image_Bank_Updater_Combined {

  const META_BACKUP = '_bm_old_thumbnail_id';
  const META_LOCK   = '_bm_bank_image_id';

  const POST_TYPE_POST     = 'post';
  const POST_TYPE_PRESS    = 'press';
  const POST_TYPE_COMBINED = 'combined';

  private array $allowed_modes = [
    self::POST_TYPE_POST,
    self::POST_TYPE_PRESS,
    self::POST_TYPE_COMBINED,
  ];

  public function __construct() {
    add_action('admin_menu', [$this, 'menu']);
    add_action('admin_post_bm_image_bank_run', [$this, 'run']);
  }

  public function menu(): void {
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
      if (is_numeric($item)) {
        $ids[] = (int) $item;
      } elseif (is_array($item) && !empty($item['ID'])) {
        $ids[] = (int) $item['ID'];
      }
    }

    return array_values(array_unique(array_filter($ids)));
  }

  private function get_offset_key(string $mode): string {
    return 'bm_image_bank_offset_' . $mode;
  }

  private function get_saved_offset(string $mode): int {
    return (int) get_option($this->get_offset_key($mode), 0);
  }

  private function save_offset(string $mode, int $offset): void {
    update_option($this->get_offset_key($mode), max(0, $offset), false);
  }

  private function reset_offset(string $mode): void {
    delete_option($this->get_offset_key($mode));
  }

  /**
   * Count published items for progress display.
   * Posts exclude events and pastevents.
   * Press has no exclusion.
   * Combined = non-event posts + all press.
   */
  private function count_total(string $mode): int {
    if ($mode === self::POST_TYPE_COMBINED) {
      return $this->count_total(self::POST_TYPE_POST) + $this->count_total(self::POST_TYPE_PRESS);
    }

    $args = [
      'post_type'      => $mode,
      'post_status'    => 'publish',
      'posts_per_page' => 1,
      'fields'         => 'ids',
      'no_found_rows'  => false,
    ];

    if ($mode === self::POST_TYPE_POST) {
      $args['tax_query'] = $this->get_post_exclusion_tax_query();
    }

    $q = new WP_Query($args);
    return (int) $q->found_posts;
  }

  private function get_post_exclusion_tax_query(): array {
    return [[
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => ['events', 'pastevents'],
      'operator' => 'NOT IN',
    ]];
  }

  /**
   * Deterministic fallback pick per post ID.
   */
  private function pick_hashed(int $post_id, array $bank_ids): int {
    $count = count($bank_ids);
    if ($count === 0) return 0;

    $index = abs(crc32('bm-blog-bank-' . $post_id)) % $count;
    return (int) $bank_ids[$index];
  }

  /**
   * List-order aware pick. This cycles through the bank in the same order as the query.
   */
  private function pick_cycled(int $position, array $bank_ids): int {
    $count = count($bank_ids);
    if ($count === 0) return 0;

    return (int) $bank_ids[$position % $count];
  }

  public function page(): void {
    if (!current_user_can('manage_options')) return;

    $bank_ids = $this->get_bank_ids();

    $ran      = isset($_GET['ran']);
    $dry      = !empty($_GET['dry']);
    $type     = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
    $updated  = isset($_GET['updated']) ? (int) $_GET['updated'] : 0;
    $skipped  = isset($_GET['skipped']) ? (int) $_GET['skipped'] : 0;
    $done     = !empty($_GET['done']);
    $next     = isset($_GET['next']) ? (int) $_GET['next'] : null;

    $samples = [];
    if (!empty($_GET['samples'])) {
      $decoded = json_decode(stripslashes((string) $_GET['samples']), true);
      if (is_array($decoded)) $samples = $decoded;
    }

    $offset_post     = $this->get_saved_offset(self::POST_TYPE_POST);
    $offset_press    = $this->get_saved_offset(self::POST_TYPE_PRESS);
    $offset_combined = $this->get_saved_offset(self::POST_TYPE_COMBINED);

    $total_post      = $this->count_total(self::POST_TYPE_POST);
    $total_press     = $this->count_total(self::POST_TYPE_PRESS);
    $total_combined  = $this->count_total(self::POST_TYPE_COMBINED);

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
          Press: offset <code><?php echo esc_html($offset_press); ?></code> of ~<code><?php echo esc_html($total_press); ?></code><br>
          Combined: offset <code><?php echo esc_html($offset_combined); ?></code> of ~<code><?php echo esc_html($total_combined); ?></code>
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
          <h2>Sample from this run</h2>
          <table class="widefat striped">
            <thead>
              <tr>
                <th>Post ID</th>
                <th>Post Type</th>
                <th>Old Thumb</th>
                <th>New Thumb</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($samples as $row) : ?>
                <tr>
                  <td><?php echo esc_html($row['id']); ?></td>
                  <td><?php echo esc_html($row['type'] ?? '—'); ?></td>
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

      <?php $this->render_runner('Run Combined Posts + Press', self::POST_TYPE_COMBINED, 'Run Combined Batch', 'Reset Combined Offset'); ?>

      <hr>

      <?php $this->render_runner('Run Posts Only', self::POST_TYPE_POST, 'Run Posts Batch', 'Reset Posts Offset'); ?>

      <hr>

      <?php $this->render_runner('Run Press Only', self::POST_TYPE_PRESS, 'Run Press Batch', 'Reset Press Offset'); ?>

      <p style="margin-top: 24px;">
        <strong>Notes:</strong><br>
        - Combined mode processes non-event Posts and all Press together in newest → oldest order.<br>
        - Posts exclude categories <code>events</code> and <code>pastevents</code> in both Posts-only and Combined mode.<br>
        - Press has no exclusions.<br>
        - If your front-end index combines Posts and Press, use <strong>Combined</strong> instead of running Posts and Press separately.<br>
        - Dry runs do not advance the saved offset.<br>
        - When you’re done, deactivate and delete this plugin.
      </p>
    </div>
    <?php
  }

  private function render_runner(string $heading, string $mode, string $button_label, string $reset_label): void {
    $suffix = esc_attr($mode);
    ?>
    <h2><?php echo esc_html($heading); ?></h2>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-bottom: 24px;">
      <?php wp_nonce_field('bm_image_bank_run'); ?>
      <input type="hidden" name="action" value="bm_image_bank_run">
      <input type="hidden" name="post_type" value="<?php echo esc_attr($mode); ?>">

      <table class="form-table">
        <tr>
          <th scope="row"><label for="batch_<?php echo $suffix; ?>">Batch size</label></th>
          <td><input name="batch" id="batch_<?php echo $suffix; ?>" value="200" class="small-text"> (100–300 recommended)</td>
        </tr>
        <tr>
          <th scope="row"><label for="dry_<?php echo $suffix; ?>">Dry run</label></th>
          <td><label><input type="checkbox" id="dry_<?php echo $suffix; ?>" name="dry_run" value="1" checked> Do not write changes</label></td>
        </tr>
        <tr>
          <th scope="row"><label for="overwrite_<?php echo $suffix; ?>">Overwrite existing featured images?</label></th>
          <td><label><input type="checkbox" id="overwrite_<?php echo $suffix; ?>" name="overwrite" value="1" checked> Yes</label></td>
        </tr>
        <tr>
          <th scope="row"><label for="backup_<?php echo $suffix; ?>">Backup old thumbnail?</label></th>
          <td><label><input type="checkbox" id="backup_<?php echo $suffix; ?>" name="backup" value="1" checked> Save old to <code><?php echo esc_html(self::META_BACKUP); ?></code></label></td>
        </tr>
        <tr>
          <th scope="row"><label for="lock_<?php echo $suffix; ?>">Lock bank choice?</label></th>
          <td><label><input type="checkbox" id="lock_<?php echo $suffix; ?>" name="lock" value="1" checked> Save to <code><?php echo esc_html(self::META_LOCK); ?></code></label></td>
        </tr>
      </table>

      <?php submit_button($button_label); ?>
    </form>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top:-10px;">
      <?php wp_nonce_field('bm_image_bank_run'); ?>
      <input type="hidden" name="action" value="bm_image_bank_run">
      <input type="hidden" name="post_type" value="<?php echo esc_attr($mode); ?>">
      <input type="hidden" name="reset_offset" value="1">
      <?php submit_button($reset_label, 'secondary'); ?>
    </form>
    <?php
  }

  public function run(): void {
    if (!current_user_can('manage_options')) wp_die('Nope.');
    check_admin_referer('bm_image_bank_run');

    $bank_ids = $this->get_bank_ids();
    if (empty($bank_ids)) wp_die('No bank images found.');

    $mode = isset($_POST['post_type']) ? sanitize_key($_POST['post_type']) : '';
    if (!in_array($mode, $this->allowed_modes, true)) wp_die('Invalid post type.');

    if (!empty($_POST['reset_offset'])) {
      $this->reset_offset($mode);
      wp_safe_redirect(add_query_arg(['page' => 'bm-image-bank-updater'], admin_url('tools.php')));
      exit;
    }

    $batch     = max(1, (int) ($_POST['batch'] ?? 200));
    $dry_run   = !empty($_POST['dry_run']);
    $backup    = !empty($_POST['backup']);
    $overwrite = !empty($_POST['overwrite']);
    $lock      = !empty($_POST['lock']);

    $offset = $this->get_saved_offset($mode);
    $ids    = $this->get_batch_ids($mode, $offset, $batch);

    $updated_count = 0;
    $skipped_count = 0;
    $samples = [];

    foreach ($ids as $i => $post_id) {
      $post_id = (int) $post_id;

      // Extra safety: never update event or pastevent posts.
      if (get_post_type($post_id) === self::POST_TYPE_POST && has_category(['events', 'pastevents'], $post_id)) {
        $skipped_count++;
        $this->maybe_sample($samples, $post_id, get_post_thumbnail_id($post_id), get_post_thumbnail_id($post_id), 'skip (event category)');
        continue;
      }

      $old_thumb = (int) get_post_thumbnail_id($post_id);

      if (!$overwrite && $old_thumb) {
        $skipped_count++;
        $this->maybe_sample($samples, $post_id, $old_thumb, $old_thumb, 'skip (has thumb)');
        continue;
      }

      $position = $offset + (int) $i;
      $new_thumb = $this->pick_cycled($position, $bank_ids);

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
    $done = count($ids) < $batch;

    if (!$dry_run) {
      $this->save_offset($mode, $next_offset);
    }

    wp_safe_redirect(add_query_arg([
      'page'    => 'bm-image-bank-updater',
      'ran'     => 1,
      'type'    => $mode,
      'updated' => $updated_count,
      'skipped' => $skipped_count,
      'next'    => $next_offset,
      'done'    => $done ? 1 : 0,
      'dry'     => $dry_run ? 1 : 0,
      'samples' => wp_json_encode($samples),
    ], admin_url('tools.php')));

    exit;
  }

  private function get_batch_ids(string $mode, int $offset, int $batch): array {
    if ($mode === self::POST_TYPE_COMBINED) {
      return $this->get_combined_batch_ids($offset, $batch);
    }

    $args = [
      'post_type'      => $mode,
      'post_status'    => 'publish',
      'posts_per_page' => $batch,
      'offset'         => $offset,
      'fields'         => 'ids',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ];

    if ($mode === self::POST_TYPE_POST) {
      $args['tax_query'] = $this->get_post_exclusion_tax_query();
    }

    return get_posts($args);
  }

  /**
   * Combined mode deliberately uses two queries so category exclusions only apply to posts.
   * This avoids accidentally excluding press items if the press post type does not use categories.
   */
  private function get_combined_batch_ids(int $offset, int $batch): array {
    $post_ids = get_posts([
      'post_type'      => self::POST_TYPE_POST,
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'orderby'        => 'date',
      'order'          => 'DESC',
      'tax_query'      => $this->get_post_exclusion_tax_query(),
    ]);

    $press_ids = get_posts([
      'post_type'      => self::POST_TYPE_PRESS,
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ]);

    $all_ids = array_merge($post_ids, $press_ids);

    usort($all_ids, function ($a, $b) {
      $time_b = get_post_time('U', true, (int) $b);
      $time_a = get_post_time('U', true, (int) $a);

      if ($time_b === $time_a) {
        return (int) $b <=> (int) $a;
      }

      return $time_b <=> $time_a;
    });

    return array_slice($all_ids, $offset, $batch);
  }

  private function maybe_sample(array &$samples, int $id, $old, $new, string $action): void {
    if (count($samples) >= 12) return;

    $samples[] = [
      'id'     => $id,
      'type'   => get_post_type($id),
      'old'    => $old ?: '—',
      'new'    => $new ?: '—',
      'action' => $action,
    ];
  }
}

new BM_Image_Bank_Updater_Combined();
