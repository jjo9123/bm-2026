<?php
/**
 * Related posts section (single) - styled like latest-content/latest-card
 */

$currentID = get_the_ID();

// Expertise terms (primary = first term)
$terms = get_the_terms($currentID, 'expertise');
$terms_array = [];

if ( ! is_wp_error($terms) && ! empty($terms) ) {
  foreach ($terms as $term) {
    $terms_array[] = $term->slug;
  }
}
$primary_expertise = $terms_array[0] ?? '';

// Counsel plus tag flag
$counsel = 0;
$tags = get_the_tags($currentID);
if ( ! empty($tags) ) {
  foreach ($tags as $tag) {
    if (strtolower($tag->name) === 'counsel plus') {
      $counsel = 1;
      break;
    }
  }
}

// Nothing to show?
if ( empty($primary_expertise) && empty($tags) ) {
  return;
}

// Build query args (preserving your original branching)
$query_args = [
  'posts_per_page' => 3,
  'post_type'      => 'post',
  'post__not_in'   => [$currentID],
];

if ($primary_expertise === 'medical-accident-and-injury') {
  $query_args['cat'] = -27070;
  $query_args['tax_query'] = [[
    'taxonomy' => 'expertise',
    'field'    => 'slug',
    'terms'    => 'medical-accident-and-injury',
  ]];
} elseif ($counsel === 1) {
  $query_args['tag'] = 'counsel-plus';
} else {
  $query_args['cat'] = -27070;
  $query_args['tax_query'] = [[
    'taxonomy' => 'expertise',
    'field'    => 'slug',
    'terms'    => $primary_expertise,
  ]];
}

$query = new WP_Query($query_args);
if (!$query->have_posts()) {
  wp_reset_postdata();
  return;
}

// Hardcoded section options
$bg_class = 'bm-white';
$intro = '<h2 class="text-center mb-0">Enjoy that? You might like these:</h2>';
?>

<section class="py-5 latest-content <?php echo esc_attr($bg_class); ?>">
  <div class="container">

    <div class="mb-5">
      <?php echo wpautop(wp_kses_post($intro)); ?>
    </div>

    <div class="row g-4">
      <?php while ($query->have_posts()) : $query->the_post(); ?>

        <?php
          $thumb   = get_the_post_thumbnail_url(get_the_ID(), 'large');
          $date    = get_the_date('d F');

          $snippet = get_the_excerpt();
          if ( empty($snippet) ) {
            $snippet = wp_strip_all_tags(get_the_content());
          }
          $snippet = wp_trim_words($snippet, 18, '…');

          // Label: primary category name (no label prefix)
          $label = '';
          $cats  = get_the_category();
          if (!empty($cats) && !empty($cats[0]->name)) {
            $label = $cats[0]->name;
          } else {
            $pt = get_post_type_object(get_post_type());
            $label = $pt && !empty($pt->labels->singular_name) ? $pt->labels->singular_name : 'Update';
          }
        ?>

        <div class="col-12 col-lg-4">
          <article class="latest-card h-100 d-flex flex-column">

            <a class="latest-card__image-wrap position-relative d-block mb-3" href="<?php the_permalink(); ?>">
              <?php if ($thumb) : ?>
                <img class="img-fluid w-100" src="<?php echo esc_url($thumb); ?>" alt="" loading="lazy" decoding="async">
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
              <?php echo esc_html($snippet); ?>
            </p>

            <div class="mt-auto">
              <a class="btn btn-green" href="<?php the_permalink(); ?>">More</a>
            </div>

          </article>
        </div>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>

    <!-- Hardcoded CTA (as requested) -->
    <div class="row mt-4">
      <div class="col-12 text-end">
        <a href="/blog" class="latest-content__cta">More insights</a>
      </div>
    </div>

  </div>
</section>
