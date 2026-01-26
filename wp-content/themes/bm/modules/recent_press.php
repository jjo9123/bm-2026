<?php
// Safely get term slugs for the current post
$get_term_slugs = function ($post_id, $taxonomy) {
  $terms = get_the_terms($post_id, $taxonomy);
  $slugs = [];

  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      if (!empty($term->slug)) {
        $slugs[] = $term->slug;
      }
    }
  }

  return $slugs;
};

$heading     = get_sub_field('heading');
$tag_name    = get_sub_field('tag_name');
$list_count   = 6;
$total_needed = 1 + $list_count;
$bg_class = get_sub_field('bg_colour') ?: 'bm-white';

$current_id      = get_the_ID();
$expertise_slugs = $get_term_slugs($current_id, 'expertise');
$location_slugs  = $get_term_slugs($current_id, 'location');

// Base args (convert from get_posts -> WP_Query so ordering + splitting is consistent)
$args = [
  'post_type'      => 'press',
  'post_status'    => 'publish',
  'posts_per_page' => $total_needed,
  'orderby'        => 'date',
  'order'          => 'DESC',
];

// Apply your existing logic
if (is_front_page()) {
  // just latest press
} elseif (is_singular('location') && get_sub_field('filter_by_tag') === 'no') {

  if (!empty($location_slugs)) {
    $args['tax_query'] = [[
      'taxonomy' => 'location',
      'field'    => 'slug',
      'terms'    => $location_slugs,
    ]];
  } else {
    $args['posts_per_page'] = 0;
  }

} elseif (is_page() && get_sub_field('filter_by_tag') === 'no') {
  // no filter: just press posts

} elseif (get_sub_field('filter_by_tag') === 'yes') {

  if (!empty($tag_name)) {
    $args['tag'] = $tag_name;
  } else {
    $args['posts_per_page'] = 0;
  }

} else {

  if (!empty($expertise_slugs)) {
    $args['tax_query'] = [[
      'taxonomy' => 'expertise',
      'field'    => 'slug',
      'terms'    => $expertise_slugs,
    ]];
  } else {
    $args['posts_per_page'] = 0;
  }
}

$q = new WP_Query($args);

if (!$q->have_posts()) {
  wp_reset_postdata();
  return;
}

$posts    = $q->posts;
$featured = array_shift($posts);
$list     = array_slice($posts, 0, $list_count);

wp_reset_postdata();
?>

<section class="press-module <?php echo esc_attr($bg_class); ?>">
  <div class="container">

    <!-- Header row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <?php if ($heading) : ?>
          <h2 class="mb-0"><?php echo esc_html($heading); ?></h2>
        <?php else : ?>
          <h2 class="mb-0">Press</h2>
        <?php endif; ?>
      </div>

      <a class="press-module__all" href="/press">
        More news features
      </a>
    </div>

    <div class="row align-items-stretch">

      <!-- LEFT: list -->
      <div class="col-12 col-lg-6 d-flex">
        <div class="press-module__list flex-fill d-flex flex-column justify-content-between">

          <?php foreach ($list as $p) : ?>
            <a
              class="press-module__item d-flex justify-content-between align-items-center"
              href="<?php echo esc_url(get_permalink($p)); ?>"
            >
              <span class="press-module__item-title">
                <?php echo esc_html(get_the_title($p)); ?>
              </span>
              
            </a>
          <?php endforeach; ?>

        </div>
      </div>

      <!-- RIGHT: featured -->
      <div class="col-12 col-lg-6 mt-4 mt-lg-0 d-flex">
        <?php
          $featured_id    = $featured->ID;
          $featured_url   = get_permalink($featured_id);
          $featured_title = get_the_title($featured_id);
          $featured_date  = get_the_date('d F', $featured_id);

          // Expertise tags display (safe)
          $expertise_terms = get_the_term_list($featured_id, 'expertise', '', ' | ', '');
          $expertise_terms = $expertise_terms ? strip_tags($expertise_terms) : '';

          // Excerpt logic (your original approach)
          $excerpt = get_post_field('post_content', $featured_id);

          if (empty($excerpt)) {
            $acf_intro = get_field('blog_intro', $featured_id);
            if (!empty($acf_intro)) $excerpt = $acf_intro;
          }

          if (!is_string($excerpt)) $excerpt = '';

          $excerpt = wp_trim_words(wp_strip_all_tags($excerpt), 26, '…');
        ?>

        <div class="press-module__featured flex-fill d-flex flex-column justify-content-center py-4">
          <p class="press-module__date mb-2"><?php echo esc_html($featured_date); ?></p>

          <?php if ($expertise_terms) : ?>
            <p class="press-module__tags mb-3"><?php echo esc_html($expertise_terms); ?></p>
          <?php endif; ?>

          <h3 class="press-module__featured-title mb-3">
            <a href="<?php echo esc_url($featured_url); ?>">
              <?php echo esc_html($featured_title); ?>
            </a>
          </h3>

          <?php if ($excerpt) : ?>
            <p class="press-module__featured-excerpt mb-4">
              <?php echo esc_html($excerpt); ?>
            </p>
          <?php endif; ?>

          <a class="btn btn-green" href="<?php echo esc_url($featured_url); ?>">Read More</a>
        </div>
      </div>

    </div>
  </div>
</section>
