<?php
/**
 * Plugin Name: UberMenu Menu Backup & Clone (JSON)
 * Description: Clone/export/import WP menus while safely preserving UberMenu menu-item meta (normalizes types to avoid UberMenu string/array fatals).
 * Version: 0.6.0
 * Author: Your Team
 */

if (!defined('ABSPATH')) exit;

class UM_Menu_Backup_Clone_JSON {
  const SLUG = 'um-menu-backup-clone';

  public function __construct() {
    add_action('admin_menu', [$this, 'admin_menu']);
    add_action('admin_post_um_mbc_clone', [$this, 'handle_clone']);
    add_action('admin_post_um_mbc_export', [$this, 'handle_export']);
    add_action('admin_post_um_mbc_import', [$this, 'handle_import']);
    add_action('admin_post_um_mbc_repair', [$this, 'handle_repair']);
    add_action('admin_notices', [$this, 'admin_notices']);
  }

  public function admin_menu() {
    add_management_page(
      'Menu Backup & Clone (UberMenu)',
      'Menu Backup & Clone',
      'manage_options',
      self::SLUG,
      [$this, 'render_page']
    );
  }

  private function get_menus_for_select() {
    $menus = wp_get_nav_menus();
    $out = [];
    foreach ($menus as $m) {
      $out[] = [
        'term_id' => (int)$m->term_id,
        'name' => $m->name,
      ];
    }
    return $out;
  }

  public function render_page() {
    if (!current_user_can('manage_options')) return;

    $menus = $this->get_menus_for_select();
    ?>
    <div class="wrap">
      <h1>Menu Backup &amp; Clone (UberMenu-safe)</h1>
      <p>
        Clones/export/import menus while preserving UberMenu meta.
        Includes a <strong>Repair</strong> tool that normalizes UberMenu meta types to prevent the
        “Cannot access offset of type string on string” fatal.
      </p>

      <hr />

      <h2>Clone Menu (create a backup menu)</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('um_mbc_clone'); ?>
        <input type="hidden" name="action" value="um_mbc_clone" />
        <table class="form-table">
          <tr>
            <th scope="row"><label for="menu_id_clone">Menu to clone</label></th>
            <td>
              <select name="menu_id" id="menu_id_clone" required>
                <option value="">Select a menu…</option>
                <?php foreach ($menus as $m): ?>
                  <option value="<?php echo esc_attr($m['term_id']); ?>"><?php echo esc_html($m['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="new_name">New menu name</label></th>
            <td>
              <input type="text" name="new_name" id="new_name" class="regular-text" placeholder="e.g. Main Menu – BACKUP" />
              <p class="description">Leave blank to auto-name: “{Original} – BACKUP {YYYY-MM-DD HH:MM}”.</p>
            </td>
          </tr>
        </table>
        <?php submit_button('Clone Menu (Backup)'); ?>
      </form>

      <hr />

      <h2>Export Menu (JSON)</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('um_mbc_export'); ?>
        <input type="hidden" name="action" value="um_mbc_export" />
        <table class="form-table">
          <tr>
            <th scope="row"><label for="menu_id_export">Menu to export</label></th>
            <td>
              <select name="menu_id" id="menu_id_export" required>
                <option value="">Select a menu…</option>
                <?php foreach ($menus as $m): ?>
                  <option value="<?php echo esc_attr($m['term_id']); ?>"><?php echo esc_html($m['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
        </table>
        <?php submit_button('Download JSON Export'); ?>
      </form>

      <hr />

      <h2>Import Menu (JSON)</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('um_mbc_import'); ?>
        <input type="hidden" name="action" value="um_mbc_import" />
        <table class="form-table">
          <tr>
            <th scope="row"><label for="import_file">JSON file</label></th>
            <td>
              <input type="file" name="import_file" id="import_file" accept="application/json,.json" required />
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="import_name">New menu name</label></th>
            <td>
              <input type="text" name="import_name" id="import_name" class="regular-text" placeholder="Optional override name" />
              <p class="description">If blank, it will use the name stored in the JSON, with a timestamp suffix.</p>
            </td>
          </tr>
        </table>
        <?php submit_button('Import as New Menu'); ?>
      </form>

      <hr />

      <h2>Repair UberMenu Meta (fix “string on string” fatal)</h2>
      <p class="description">
        Use this if the menu is throwing a fatal in UberMenu. It scans all items in the selected menu and normalizes UberMenu meta types.
      </p>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('um_mbc_repair'); ?>
        <input type="hidden" name="action" value="um_mbc_repair" />
        <table class="form-table">
          <tr>
            <th scope="row"><label for="menu_id_repair">Menu to repair</label></th>
            <td>
              <select name="menu_id" id="menu_id_repair" required>
                <option value="">Select a menu…</option>
                <?php foreach ($menus as $m): ?>
                  <option value="<?php echo esc_attr($m['term_id']); ?>"><?php echo esc_html($m['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
        </table>
        <?php submit_button('Repair Selected Menu'); ?>
      </form>

      <hr />
      <p><strong>Tip:</strong> If you cloned a menu “as backup”, make sure the backup menu is <em>not assigned</em> to the theme location (Appearance → Menus → Manage Locations), so it won’t render on the front-end.</p>
    </div>
    <?php
  }

  public function admin_notices() {
    if (empty($_GET['um_mbc_notice'])) return;
    $code = sanitize_text_field($_GET['um_mbc_notice']);
    $msg = '';
    $type = 'success';

    switch ($code) {
      case 'cloned':
        $msg = 'Menu cloned successfully.';
        break;
      case 'imported':
        $msg = 'Menu imported successfully.';
        break;
      case 'repaired':
        $msg = 'Menu repaired: UberMenu meta normalized.';
        break;
      case 'error':
      default:
        $msg = 'Something went wrong. Check your PHP error log for details.';
        $type = 'error';
        break;
    }

    echo '<div class="notice notice-' . esc_attr($type) . ' is-dismissible"><p>' . esc_html($msg) . '</p></div>';
  }

  public function handle_clone() {
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('um_mbc_clone');

    $menu_id = isset($_POST['menu_id']) ? (int)$_POST['menu_id'] : 0;
    if (!$menu_id) $this->redirect_notice('error');

    $orig_menu = wp_get_nav_menu_object($menu_id);
    if (!$orig_menu || is_wp_error($orig_menu)) $this->redirect_notice('error');

    $new_name = isset($_POST['new_name']) ? sanitize_text_field($_POST['new_name']) : '';
    if ($new_name === '') {
      $new_name = $orig_menu->name . ' – BACKUP ' . current_time('Y-m-d H:i');
    }

    $new_menu_id = wp_create_nav_menu($new_name);
    if (is_wp_error($new_menu_id)) $this->redirect_notice('error');

    $ok = $this->clone_menu_items($menu_id, $new_menu_id);
    if (!$ok) $this->redirect_notice('error');

    $this->redirect_notice('cloned');
  }

  public function handle_export() {
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('um_mbc_export');

    $menu_id = isset($_POST['menu_id']) ? (int)$_POST['menu_id'] : 0;
    if (!$menu_id) wp_die('Missing menu_id');

    $data = $this->build_menu_export_payload($menu_id);
    if (!$data) wp_die('Failed to export menu');

    $filename = 'menu-export-' . sanitize_title($data['menu']['name']) . '-' . current_time('Ymd-His') . '.json';
    nocache_headers();
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo wp_json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
  }

  public function handle_import() {
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('um_mbc_import');

    if (empty($_FILES['import_file']['tmp_name'])) $this->redirect_notice('error');

    $raw = file_get_contents($_FILES['import_file']['tmp_name']);
    $payload = json_decode($raw, true);

    if (!is_array($payload) || empty($payload['menu']) || empty($payload['items'])) {
      $this->redirect_notice('error');
    }

    $name_override = isset($_POST['import_name']) ? sanitize_text_field($_POST['import_name']) : '';
    $base_name = $name_override ?: sanitize_text_field($payload['menu']['name']);
    $new_name = $base_name . ' (Imported ' . current_time('Y-m-d H:i') . ')';

    $new_menu_id = wp_create_nav_menu($new_name);
    if (is_wp_error($new_menu_id)) $this->redirect_notice('error');

    $ok = $this->import_menu_items($payload, $new_menu_id);
    if (!$ok) $this->redirect_notice('error');

    $this->redirect_notice('imported');
  }

  public function handle_repair() {
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('um_mbc_repair');

    $menu_id = isset($_POST['menu_id']) ? (int)$_POST['menu_id'] : 0;
    if (!$menu_id) $this->redirect_notice('error');

    $items = wp_get_nav_menu_items($menu_id, ['update_post_term_cache' => false]);
    if (!is_array($items)) $items = [];

    foreach ($items as $item) {
      $this->normalize_ubermenu_meta_on_item((int)$item->ID);
    }

    $this->redirect_notice('repaired');
  }

  private function redirect_notice($code) {
    wp_safe_redirect(add_query_arg(['page' => self::SLUG, 'um_mbc_notice' => $code], admin_url('tools.php')));
    exit;
  }

  /**
   * Clone items:
   *  - Create each item once via wp_update_nav_menu_item (so WP core meta is generated correctly)
   *  - Copy and NORMALIZE UberMenu meta
   *  - Set parents via _menu_item_menu_item_parent meta (do not re-call wp_update_nav_menu_item with partial args)
   */
  private function clone_menu_items($from_menu_id, $to_menu_id) {
    $items = wp_get_nav_menu_items($from_menu_id, ['update_post_term_cache' => false]);
    if (!is_array($items)) return false;

    usort($items, function($a, $b) {
      return ((int)$a->menu_order <=> (int)$b->menu_order);
    });

    $map = [];

    foreach ($items as $item) {
      $new_id = $this->create_menu_item_from_existing($to_menu_id, $item);
      if (!$new_id) return false;

      $map[(int)$item->ID] = (int)$new_id;

      $this->copy_and_normalize_ubermenu_meta((int)$item->ID, (int)$new_id);
    }

    foreach ($items as $item) {
      $old_id = (int)$item->ID;
      if (empty($map[$old_id])) continue;

      $new_id = (int)$map[$old_id];
      $old_parent = (int)$item->menu_item_parent;
      $new_parent = ($old_parent && !empty($map[$old_parent])) ? (int)$map[$old_parent] : 0;

      update_post_meta($new_id, '_menu_item_menu_item_parent', $new_parent);
    }

    return true;
  }

  private function create_menu_item_from_existing($menu_id, $item) {
    $title = (string)$item->title;
    $type  = (string)$item->type;
    $object = (string)$item->object;
    $object_id = (int)$item->object_id;
    $url = (string)$item->url;

    $args = [
      'menu-item-status'       => 'publish',
      'menu-item-parent-id'    => 0,
      'menu-item-position'     => (int)$item->menu_order,
      'menu-item-description'  => (string)$item->description,
      'menu-item-attr-title'   => (string)$item->attr_title,
      'menu-item-target'       => (string)$item->target,
      'menu-item-classes'      => is_array($item->classes) ? implode(' ', $item->classes) : (string)$item->classes,
      'menu-item-xfn'          => (string)$item->xfn,
    ];

    if ($type === 'post_type' && $object_id && get_post($object_id)) {
      $args['menu-item-type']      = 'post_type';
      $args['menu-item-object']    = $object;
      $args['menu-item-object-id'] = $object_id;
      $args['menu-item-title']     = ($title !== '') ? $title : get_the_title($object_id);
    } elseif ($type === 'taxonomy' && $object_id) {
      $term = get_term($object_id, $object);
      if (!is_wp_error($term) && $term) {
        $args['menu-item-type']      = 'taxonomy';
        $args['menu-item-object']    = $object;
        $args['menu-item-object-id'] = $object_id;
        $args['menu-item-title']     = ($title !== '') ? $title : $term->name;
      } else {
        $args['menu-item-type']  = 'custom';
        $args['menu-item-title'] = ($title !== '') ? $title : 'Menu Item';
        $args['menu-item-url']   = ($url !== '') ? $url : '#';
      }
    } else {
      $args['menu-item-type']  = 'custom';
      $args['menu-item-title'] = ($title !== '') ? $title : 'Menu Item';
      $args['menu-item-url']   = ($url !== '') ? $url : '#';
    }

    $new_item_id = wp_update_nav_menu_item($menu_id, 0, $args);
    if (is_wp_error($new_item_id) || !$new_item_id) return 0;
    return (int)$new_item_id;
  }

  /**
   * Normalize a meta value:
   * - repeatedly maybe_unserialize (handles double-serialized)
   * - try JSON decode if it looks like JSON
   * - for “settings/config/display” keys: ensure array (fail-safe to prevent UberMenu fatal)
   */
  private function normalize_meta_value($key, $value) {
    // Repeated maybe_unserialize until stable
    $prev = null;
    $cur = $value;
    $guard = 0;
    while ($guard < 5 && $cur !== $prev) {
      $prev = $cur;
      $cur = maybe_unserialize($cur);
      $guard++;
    }

    // JSON decode if it looks like JSON
    if (is_string($cur)) {
      $trim = ltrim($cur);
      if ($trim !== '' && ($trim[0] === '{' || $trim[0] === '[')) {
        $decoded = json_decode($cur, true);
        if (json_last_error() === JSON_ERROR_NONE) {
          $cur = $decoded;
        }
      }
    }

    // If key looks like it should be an array, coerce
    $k = strtolower((string)$key);
    $expects_array = (
      strpos($k, 'settings') !== false ||
      strpos($k, 'config') !== false ||
      strpos($k, 'display') !== false ||
      strpos($k, 'item_display') !== false ||
      strpos($k, 'classes') !== false
    );

    if ($expects_array && is_string($cur)) {
      // prevent fatal: UberMenu expects array offsets
      $cur = [];
    }

    return $cur;
  }

  /**
   * Copy only UberMenu-related meta keys (contains 'ubermenu'), but normalize values before saving.
   * Store as single values via update_post_meta (UberMenu expects single).
   */
  private function copy_and_normalize_ubermenu_meta($from_post_id, $to_post_id) {
    $all_meta = get_post_meta($from_post_id);
    if (!is_array($all_meta)) return;

    foreach ($all_meta as $key => $values) {
      if (stripos($key, 'ubermenu') === false) continue;
      if ($key === '_edit_lock' || $key === '_edit_last') continue;

      $val = (is_array($values) && count($values)) ? $values[0] : null;
      $val = $this->normalize_meta_value($key, $val);

      update_post_meta($to_post_id, $key, $val);
    }
  }

  /**
   * Repair: normalize existing UberMenu meta on a single menu item.
   */
  private function normalize_ubermenu_meta_on_item($post_id) {
    $all_meta = get_post_meta($post_id);
    if (!is_array($all_meta)) return;

    foreach ($all_meta as $key => $values) {
      if (stripos($key, 'ubermenu') === false) continue;
      if ($key === '_edit_lock' || $key === '_edit_last') continue;

      $val = (is_array($values) && count($values)) ? $values[0] : null;
      $val_norm = $this->normalize_meta_value($key, $val);

      // Rewrite as a single normalized value
      update_post_meta($post_id, $key, $val_norm);
    }
  }

  private function build_menu_export_payload($menu_id) {
    $menu = wp_get_nav_menu_object($menu_id);
    if (!$menu || is_wp_error($menu)) return false;

    $items = wp_get_nav_menu_items($menu_id, ['update_post_term_cache' => false]);
    if (!is_array($items)) $items = [];

    usort($items, function($a, $b) {
      return ((int)$a->menu_order <=> (int)$b->menu_order);
    });

    $export_items = [];
    foreach ($items as $item) {
      $meta = get_post_meta((int)$item->ID);

      $um_meta = [];
      foreach ($meta as $k => $vals) {
        if (stripos($k, 'ubermenu') === false) continue;
        if ($k === '_edit_lock' || $k === '_edit_last') continue;

        $v = (is_array($vals) && count($vals)) ? $vals[0] : null;
        $um_meta[$k] = $this->normalize_meta_value($k, $v);
      }

      $export_items[] = [
        'id' => (int)$item->ID,
        'menu_item_parent' => (int)$item->menu_item_parent,
        'menu_order' => (int)$item->menu_order,
        'fields' => [
          'object_id'   => (int)$item->object_id,
          'object'      => (string)$item->object,
          'type'        => (string)$item->type,
          'title'       => (string)$item->title,
          'url'         => (string)$item->url,
          'description' => (string)$item->description,
          'attr_title'  => (string)$item->attr_title,
          'target'      => (string)$item->target,
          'classes'     => is_array($item->classes) ? $item->classes : preg_split('/\s+/', (string)$item->classes, -1, PREG_SPLIT_NO_EMPTY),
          'xfn'         => (string)$item->xfn,
        ],
        'ubermenu_meta' => $um_meta,
      ];
    }

    return [
      'exported_at' => current_time('c'),
      'site' => ['home_url' => home_url()],
      'menu' => [
        'term_id' => (int)$menu->term_id,
        'name' => (string)$menu->name,
        'slug' => (string)$menu->slug,
      ],
      'items' => $export_items,
    ];
  }

  private function import_menu_items($payload, $to_menu_id) {
    $items = $payload['items'];
    if (!is_array($items)) return false;

    usort($items, function($a, $b) {
      return ((int)($a['menu_order'] ?? 0) <=> (int)($b['menu_order'] ?? 0));
    });

    $map = [];

    foreach ($items as $it) {
      if (empty($it['id']) || empty($it['fields']) || !is_array($it['fields'])) continue;

      $f = $it['fields'];
      $obj = (object)[
        'title' => (string)($f['title'] ?? ''),
        'type' => (string)($f['type'] ?? 'custom'),
        'object' => (string)($f['object'] ?? ''),
        'object_id' => (int)($f['object_id'] ?? 0),
        'url' => (string)($f['url'] ?? ''),
        'description' => (string)($f['description'] ?? ''),
        'attr_title' => (string)($f['attr_title'] ?? ''),
        'target' => (string)($f['target'] ?? ''),
        'classes' => (array)($f['classes'] ?? []),
        'xfn' => (string)($f['xfn'] ?? ''),
        'menu_order' => (int)($it['menu_order'] ?? 0),
      ];

      $new_id = $this->create_menu_item_from_existing($to_menu_id, $obj);
      if (!$new_id) return false;

      $map[(int)$it['id']] = (int)$new_id;

      if (!empty($it['ubermenu_meta']) && is_array($it['ubermenu_meta'])) {
        foreach ($it['ubermenu_meta'] as $k => $v) {
          if (stripos($k, 'ubermenu') === false) continue;
          $v_norm = $this->normalize_meta_value($k, $v);
          update_post_meta((int)$new_id, $k, $v_norm);
        }
      }
    }

    foreach ($items as $it) {
      $old_id = (int)($it['id'] ?? 0);
      if (!$old_id || empty($map[$old_id])) continue;

      $new_id = (int)$map[$old_id];
      $old_parent = (int)($it['menu_item_parent'] ?? 0);
      $new_parent = ($old_parent && !empty($map[$old_parent])) ? (int)$map[$old_parent] : 0;

      update_post_meta($new_id, '_menu_item_menu_item_parent', $new_parent);
    }

    return true;
  }
}

new UM_Menu_Backup_Clone_JSON();