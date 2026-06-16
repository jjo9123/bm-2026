<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */

$post_id = get_the_ID();

// Categories (label + optional extra class)
$categories = get_the_category($post_id);
$category_slug  = '';
$category_slug2 = '';
$category_name  = '';

if (!empty($categories)) {
  $category_slug = $categories[0]->slug ?? '';
  $category_name = $categories[0]->name ?? '';
  if (isset($categories[1])) {
    $category_slug2 = $categories[1]->slug ?? '';
  }
}

// Author (ACF post object)
$post_object = get_field('author');
$details = null;
if ($post_object) {
  $post = $post_object;
  setup_postdata($post);
  $details = get_field('contact_details');
  wp_reset_postdata();
}

// Thumb + date
$thumb = get_the_post_thumbnail_url($post_id, 'large');
$date  = get_the_date('d F', $post_id);

// Event date (ACF)
$event_date = get_field('event_date', $post_id);

// Excerpt logic (your existing rules)
$getpost = get_post($post_id);
$excerpt_src = $getpost ? $getpost->post_content : '';

if (empty($excerpt_src) && get_field('new_blog_layout', $post_id) == 'yes') {
  $excerpt_src = get_field('blog_intro', $post_id);
} elseif ($category_slug === 'events' || $category_slug === 'training') {
  $excerpt_src = get_field('intro_title', $post_id);
}

if (!is_string($excerpt_src)) $excerpt_src = '';
$excerpt = wp_trim_words(wp_strip_all_tags($excerpt_src), 18, '…');

// Hide date line for some categories (same behaviour as before)
$hide_date = in_array($category_slug, ['guides', 'events', 'training'], true);

// Column classes: keep your old category hooks as extra classes (optional)
$extra_classes = trim(
  'i' . sanitize_html_class($category_slug) .
  (!empty($category_slug2) ? ' ' . sanitize_html_class($category_slug2) : '')
);
?>

<div class="col-md-6 col-lg-4 pb-5 <?php echo esc_attr($extra_classes); ?>">
  <a class="latest-card d-block h-100 text-decoration-none" href="<?php the_permalink(); ?>">

    <div class="latest-card__image-wrap position-relative mb-3">
      <?php if ($category_name || get_post_type($post_id) === 'press' || strpos(get_permalink($post_id), '/press/') !== false) : ?>
        <span class="latest-card__label position-absolute">
          <?php echo esc_html( bm_get_label_from_category($post_id) ); ?>
        </span>
      <?php endif; ?>

      <?php if ($thumb) : ?>
        <img
          class="latest-card__image w-100"
          src="<?php echo esc_url($thumb); ?>"
          alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
          loading="lazy"
        >
      <?php endif; ?>
    </div>

    <div class="latest-card__body">

      <?php if (!$hide_date) : ?>
        <p class="latest-card__date mb-2">
          <?php echo esc_html($date); ?>
          <?php if (!empty($details['first_name']) || !empty($details['last_name'])) : ?>
            - <?php echo esc_html(trim(($details['first_name'] ?? '') . ' ' . ($details['last_name'] ?? ''))); ?>
          <?php endif; ?>
        </p>
      <?php endif; ?>

      <h3 class="latest-card__title py-2">
        <?php if ($category_slug === 'events' && $event_date) : ?>
          <?php echo esc_html(get_the_title($post_id) . ' - ' . $event_date); ?>
        <?php else : ?>
          <?php the_title(); ?>
        <?php endif; ?>
      </h3>

      <?php if ($excerpt) : ?>
        <p class="latest-card__excerpt mb-4">
          <?php echo esc_html($excerpt); ?>
        </p>
      <?php endif; ?>

      <div class="mt-auto">
        <span class="btn btn-green">More</span>
      </div>

    </div>

  </a>
</div>
