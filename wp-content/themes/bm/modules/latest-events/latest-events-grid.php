<?php
if (!isset($query) || !$query instanceof WP_Query || !$query->have_posts()) return;

// IMPORTANT: set this to match controller
$events_category_slug = 'events';

// Get the Events category term
$events_term = get_category_by_slug($events_category_slug);
$events_term_id = $events_term ? (int) $events_term->term_id : 0;

// Helper: get first child category name under Events
$get_event_label = function(int $post_id) use ($events_term_id) : string {
  if (!$events_term_id) return 'Event';

  $cats = get_the_category($post_id);
  if (empty($cats)) return 'Event';

  // Look for any category whose parent is the Events category
  foreach ($cats as $cat) {
    if ((int) $cat->parent === $events_term_id) {
      return $cat->name ?: 'Event';
    }
  }

  // If the post is in Events but no child category chosen, fallback
  return 'Event';
};
?>

<section class="py-5 latest-content latest-events">
  <div class="container">

    <?php if (!empty($intro)) : ?>
      <div class="mb-4">
        <?php echo wpautop(wp_kses_post($intro)); ?>
      </div>
    <?php endif; ?>

    <div class="row g-4">
      <?php while ($query->have_posts()) : $query->the_post(); ?>

        <?php
          $post_id = get_the_ID();
          $thumb   = get_the_post_thumbnail_url($post_id, 'large');

          // Label: subcategory (child of Events) or fallback "Event"
          $label = $get_event_label($post_id);

          // Date: if you have a custom event date field, use it, else post date
          // If you already use event_date meta elsewhere, keep consistent:
          $event_date = get_post_meta($post_id, 'event_date', true);
          $date = $event_date ? $event_date : get_the_date('d F', $post_id);

          // Snippet
          $excerpt = get_the_excerpt($post_id);
          if (!$excerpt) {
            $excerpt = wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $post_id)), 24, '…');
          }
        ?>

        <div class="col-12 col-lg-4">
          <article class="latest-card h-100 d-flex flex-column">

            <a class="latest-card__image-wrap position-relative d-block mb-3" href="<?php the_permalink(); ?>">
              <?php if ($thumb) : ?>
                <img class="img-fluid w-100" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
              <?php endif; ?>

              <span class="latest-card__label position-absolute">
                <?php echo esc_html($label); ?>
              </span>
            </a>

            <p class="latest-card__date mb-2"><?php echo esc_html($date); ?></p>

            <h3 class="latest-card__title mb-2">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <p class="latest-card__excerpt mb-4">
              <?php echo esc_html( wp_trim_words($excerpt, 18, '…') ); ?>
            </p>

            <div class="mt-auto">
              <a class="btn btn-green" href="<?php the_permalink(); ?>">More</a>
            </div>

          </article>
        </div>

      <?php endwhile; ?>
    </div>

    <?php if (is_array($cta) && !empty($cta['url']) && !empty($cta['title'])) : ?>
      <?php
        $target = !empty($cta['target']) ? $cta['target'] : '_self';
        $rel    = ($target === '_blank') ? 'noopener' : '';
      ?>
      <div class="row mt-4">
        <div class="col-12 text-end">
          <a
            href="<?php echo esc_url($cta['url']); ?>"
            target="<?php echo esc_attr($target); ?>"
            <?php echo $rel ? 'rel="' . esc_attr($rel) . '"' : ''; ?>
            class="latest-content__cta"
          >
            <?php echo esc_html($cta['title']); ?> <span aria-hidden="true">›</span>
          </a>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>