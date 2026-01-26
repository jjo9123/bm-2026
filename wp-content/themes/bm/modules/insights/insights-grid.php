<?php
/**
 * Latest-style shared grid renderer (matches latest posts/events card styling)
 *
 * Expects:
 *  - $query (WP_Query)
 *  - $intro (string|html) optional (WYSIWYG)
 *  - $cta (array ACF link) optional
 *  - $cta_text (string) optional fallback
 *  - $show_label (bool) optional (default true)
 *  - $exclude_events_label (bool) optional (default false)
 */

if ( empty($query) || ! ($query instanceof WP_Query) ) return;

$intro               = $intro ?? '';
$title = $title ?? '';
$cta                 = $cta ?? null;
$cta_text            = $cta_text ?? '';
$show_label          = isset($show_label) ? (bool)$show_label : true;
$exclude_events_label = isset($exclude_events_label) ? (bool)$exclude_events_label : false;

// Resolve CTA
if (is_array($cta) && !empty($cta['url'])) {
  $cta_url    = $cta['url'];
  $cta_title  = !empty($cta['title']) ? $cta['title'] : ($cta_text ?: 'More Insights');
  $cta_target = !empty($cta['target']) ? $cta['target'] : '_self';
} else {
  $cta_url    = '/blog';
  $cta_title  = 'More Insights';
  $cta_target = '_self';
}

$cta_rel = ($cta_target === '_blank') ? 'noopener' : '';

// Events parent term (for subcategory label fallback)
$events_term = get_category_by_slug('events');
$events_id   = ($events_term && !is_wp_error($events_term)) ? (int) $events_term->term_id : 0;

$event_label_for_post = function($post_id) use ($events_id) {
  if (!$events_id) return 'Event';

  $cats = get_the_category($post_id);
  if (empty($cats)) return 'Event';

  // Prefer child-of-events category name
  foreach ($cats as $c) {
    if ((int)$c->parent === $events_id) {
      return $c->name ?: 'Event';
    }
  }

  // Else if the post is in Events itself
  foreach ($cats as $c) {
    if ((int)$c->term_id === $events_id) {
      return $c->name ?: 'Event';
    }
  }

  return 'Event';
};

$content_label_for_post = function($post_id) use ($events_id, $exclude_events_label) {
  $pt = get_post_type($post_id);

  // If it's a standard blog post, label = category (but optionally avoid Events children)
  if ($pt === 'post') {
    $cats = get_the_category($post_id);
    if (empty($cats)) return 'Article';

    foreach ($cats as $c) {
      if ($events_id) {
        $is_events_parent = ((int)$c->term_id === $events_id);
        $is_events_child  = ((int)$c->parent === $events_id);

        if ($exclude_events_label && ($is_events_parent || $is_events_child)) {
          continue; // skip events categories for label
        }
      }
      return $c->name ?: 'Article';
    }

    // If we skipped everything, fall back
    return 'Article';
  }

  // CPTs: use post type singular label
  $obj = get_post_type_object($pt);
  return ($obj && !empty($obj->labels->singular_name)) ? $obj->labels->singular_name : 'Update';
};

?>

<section class="latest-content py-5 <?php echo esc_attr($bg_class); ?>">
  <div class="container">

  <?php
// Default heading text when no intro or title
$default_heading = 'Insights';
?>

<?php if ($intro || $title || $cta_url) : ?>
  <div class="d-flex justify-content-between align-items-center mb-4">

    <div class="latest-content__intro">
      <?php if ($intro) : ?>
        <?php echo wpautop(wp_kses_post($intro)); ?>

      <?php elseif ($title) : ?>
        <h2 class="mb-0"><?php echo esc_html($title); ?></h2>

      <?php else : ?>
        <h2 class="mb-0"><?php echo esc_html($default_heading); ?></h2>
      <?php endif; ?>
    </div>

    <?php if ($cta_url && $cta_title) : ?>
      <a
        class="latest-content__cta"
        href="<?php echo esc_url($cta_url); ?>"
        target="<?php echo esc_attr($cta_target); ?>"
        <?php echo $cta_rel ? 'rel="' . esc_attr($cta_rel) . '"' : ''; ?>
      >
        <?php echo esc_html($cta_title); ?>
      </a>
    <?php endif; ?>

  </div>

<?php else : ?>

  <div class="mb-4">
    <h2 class="mb-0"><?php echo esc_html($default_heading); ?></h2>
  </div>

<?php endif; ?>



    <div class="row g-4">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php
          $post_id = get_the_ID();
          $pt      = get_post_type($post_id);

          $thumb = get_the_post_thumbnail_url($post_id, 'large');

          // Excerpt logic (re-uses your existing ACF rules)
          $cats = get_the_category($post_id);
          $first_slug = (!empty($cats) && !empty($cats[0]->slug)) ? $cats[0]->slug : '';

          if ($first_slug === 'events' || $first_slug === 'training') {
            $excerpt_src = get_field('intro_title', $post_id);
          } elseif (get_field('new_blog_layout', $post_id) === 'yes') {
            $excerpt_src = get_field('blog_intro', $post_id);
          } else {
            $excerpt_src = get_post_field('post_content', $post_id);
          }

          if (!is_string($excerpt_src)) $excerpt_src = '';
          $excerpt = wp_trim_words(wp_strip_all_tags($excerpt_src), 22, '…');

          // Label: for events module we want subcategory; for content module we want type/category
          $is_event_post = ($pt === 'post' && $events_id) ? has_category($events_id, $post_id) : false;
          $label = $is_event_post ? $event_label_for_post($post_id) : $content_label_for_post($post_id);
        ?>

        <div class="col-12 col-md-6 col-lg-4 pb-5">
          <a class="latest-card d-block h-100 text-decoration-none" href="<?php the_permalink(); ?>">

            <div class="latest-card__image-wrap position-relative">
              <?php if ($show_label) : ?>
                <span class="latest-card__label position-absolute">
                  <?php echo esc_html($label); ?>
                </span>
              <?php endif; ?>

              <?php if ($thumb) : ?>
                <img class="latest-card__image w-100" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" loading="lazy">
              <?php endif; ?>
            </div>

            <div class="latest-card__body">
              <h3 class="latest-card__title py-3">
                <?php the_title(); ?>
              </h3>

              <?php if ($excerpt) : ?>
                <p class="latest-card__excerpt mb-0">
                  <?php echo esc_html($excerpt); ?>
                </p>
              <?php endif; ?>
            </div>

          </a>
        </div>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>

  </div>
</section>
