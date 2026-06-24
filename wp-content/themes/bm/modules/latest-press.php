<?php
// modules/press/press.php
$bg_class = get_sub_field('bg_colour') ?: 'bm-purple';

$intro = get_sub_field('intro');
$cta   = get_sub_field('btn_link');

$press_post_type = 'press';
$list_count      = 5;
$total_needed    = 1 + $list_count;

$args = [
  'post_type'      => $press_post_type,
  'post_status'    => 'publish',
  'posts_per_page' => $total_needed,
  'orderby'        => 'date',
  'order'          => 'DESC',
];

$q = new WP_Query($args);

if (!$q->have_posts()) {
  wp_reset_postdata();
  return;
}

$posts    = $q->posts;
$featured = array_shift($posts);
$list     = array_slice($posts, 0, $list_count);

wp_reset_postdata();

// CTA safety
$cta_url    = (is_array($cta) && !empty($cta['url'])) ? $cta['url'] : '';
$cta_title  = (is_array($cta) && !empty($cta['title'])) ? $cta['title'] : '';
$cta_target = (is_array($cta) && !empty($cta['target'])) ? $cta['target'] : '_self';
$cta_rel    = ($cta_target === '_blank') ? 'noopener' : '';
?>

<section class="press-module <?php echo esc_attr($bg_class); ?>">
  <div class="container">

    <!-- Header row: intro left, CTA right -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center">

        <?php if ($intro) : ?>
          <div class="press-module__intro">
            <?php echo wpautop(wp_kses_post($intro)); ?>
          </div>
        <?php endif; ?>

        <?php if ($cta_url && $cta_title) : ?>
          <a
            class="press-module__all"
            href="<?php echo esc_url($cta_url); ?>"
            target="<?php echo esc_attr($cta_target); ?>"
            <?php echo $cta_rel ? 'rel="' . esc_attr($cta_rel) . '"' : ''; ?>
          >
            <?php echo esc_html($cta_title); ?>
          </a>
        <?php endif; ?>

      </div>
    </div>

    <div class="row align-items-stretch">

  <!-- Left list -->
  <div class="col-12 col-lg-6 d-flex">
    <div class="press-module__list flex-fill d-flex flex-column justify-content-between">
      <?php foreach ($list as $p) : ?>
        <a class="press-module__item d-flex justify-content-between align-items-center"
           href="<?php echo esc_url(get_permalink($p)); ?>">
          <span class="press-module__item-title"><?php echo esc_html(get_the_title($p)); ?></span>
          <span class="press-module__arrow" aria-hidden="true">›</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Right featured -->
  <div class="col-12 col-lg-6 mt-4 mt-lg-0 d-flex">
    <?php
      $featured_id    = $featured->ID;
      $featured_url   = get_permalink($featured_id);
      $featured_title = get_the_title($featured_id);
      $featured_date  = get_the_date('d F', $featured_id);

      $featured_excerpt = get_the_excerpt($featured_id);
      if (!$featured_excerpt) {
        $featured_excerpt = wp_trim_words(
          wp_strip_all_tags(get_post_field('post_content', $featured_id)),
          26,
          '…'
        );
      }
    ?>

    <div class="press-module__featured flex-fill d-flex flex-column justify-content-center py-4">
      <p class="press-module__date mb-2"><?php echo esc_html($featured_date); ?></p>

      <h3 class="press-module__featured-title mb-3">
        <a href="<?php echo esc_url($featured_url); ?>"><?php echo esc_html($featured_title); ?></a>
      </h3>

      <p class="press-module__featured-excerpt mb-4">
        <?php echo esc_html($featured_excerpt); ?>
      </p>

      <a class="btn btn-green" href="<?php echo esc_url($featured_url); ?>">More</a>
    </div>
  </div>

</div>

  </div>
</section>
