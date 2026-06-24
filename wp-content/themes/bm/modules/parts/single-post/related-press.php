<?php
/**
 * modules/press/press-related.php
 *
 * Latest-card styled Press teaser grid (3 items).
 * Optional vars you can pass before including:
 *  - $heading (string)
 *  - $cta (array ACF link OR string URL)
 */

$heading = $heading ?? 'Explore more insights';

// CTA defaults (supports string URL or ACF link array)
$cta_url    = '';
$cta_title  = '';
$cta_target = '_self';
$cta_rel    = '';

if (isset($cta)) {
  if (is_array($cta)) {
    $cta_url    = !empty($cta['url']) ? $cta['url'] : '';
    $cta_title  = !empty($cta['title']) ? $cta['title'] : '';
    $cta_target = !empty($cta['target']) ? $cta['target'] : '_self';
    $cta_rel    = ($cta_target === '_blank') ? 'noopener' : '';
  } elseif (is_string($cta)) {
    $cta_url   = $cta;
    $cta_title = 'More news';
  }
}

// Fallback CTA if nothing provided
if (!$cta_url) {
  $cta_url   = '/press';
  $cta_title = 'More news';
}

$query = new WP_Query([
  'post_type'      => 'press',
  'posts_per_page' => 3,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
]);

if (!$query->have_posts()) {
  wp_reset_postdata();
  return;
}
?>

<section class="latest-content py-5 bm-white">
  <div class="container">

    <div class="d-flex justify-content-between align-items-start mb-4">
      <h2 class="mb-0"><?php echo esc_html($heading); ?></h2>

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

    <div class="row g-4">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php
          $post_id = get_the_ID();

          // Thumbnail
          $thumb = get_the_post_thumbnail_url($post_id, 'large');

          // Date + author (ACF relationship field "author" -> contact_details)
          $date = get_the_date('j F', $post_id);

          $author_name = '';
          $author_post = get_field('author', $post_id);
          if ($author_post) {
            $author_id = is_object($author_post) ? $author_post->ID : (int) $author_post;
            $details   = get_field('contact_details', $author_id);
            if (!empty($details['first_name']) || !empty($details['last_name'])) {
              $author_name = trim(($details['first_name'] ?? '') . ' ' . ($details['last_name'] ?? ''));
            }
          }

          // Excerpt: blog_intro first, then content fallback
          $intro = get_field('blog_intro', $post_id);
          $src   = $intro ? $intro : get_post_field('post_content', $post_id);
          if (!is_string($src)) $src = '';
          $excerpt = wp_trim_words(wp_strip_all_tags($src), 18, '…');

          // Label locked to "News"
          $label = 'News';
        ?>

        <div class="col-12 col-md-6 col-lg-4 pb-5">
          <a class="latest-card d-block h-100 text-decoration-none" href="<?php the_permalink(); ?>">

            <div class="latest-card__image-wrap position-relative">
              <span class="latest-card__label position-absolute">
                <?php echo esc_html($label); ?>
              </span>

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
              <p class="latest-card__date mb-2">
                <?php echo esc_html($date); ?>
                <?php if ($author_name) : ?>
                  <span aria-hidden="true"> • </span><?php echo esc_html($author_name); ?>
                <?php endif; ?>
              </p>

              <h3 class="latest-card__title py-2 mb-0">
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
