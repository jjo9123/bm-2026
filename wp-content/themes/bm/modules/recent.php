<?php
// modules/insights/recent.php

$cat_id   = (int) get_sub_field('category');
$category = $cat_id ? get_category($cat_id) : null;
$bg_class = get_sub_field('bg_colour') ?: 'bm-white';

$cat_slug = (!empty($category) && !is_wp_error($category)) ? ($category->slug ?? '') : '';
$bg       = get_sub_field('bg') ?: '';
$number   = (int) get_sub_field('num');
$choice   = get_sub_field('recent_choice'); // recent | expertise | service

if ($number <= 0) $number = 3;

$section_title = 'BM Insights';
$cta_url       = '/blog';

$args = [
  'post_type'      => 'post',
  'posts_per_page' => $number,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
];

$terms_to_slugs = function($taxonomy) {
  $terms = get_the_terms(get_the_ID(), $taxonomy);
  $slugs = [];

  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $t) {
      if (!empty($t->slug)) $slugs[] = $t->slug;
    }
  }
  return $slugs;
};

if ($choice === 'recent' || empty($choice)) {

  if (is_page(6033)) {
    $args['tag'] = 'brexit';
  } else {
    $args['tag__not_in'] = [25061, 27061];
    $args['cat']         = '-27070'; // keep your legacy exclusion
  }

} elseif ($choice === 'expertise') {

  $slugs = $terms_to_slugs('expertise');

  if (empty($slugs)) {
    $args['posts_per_page'] = 0;
  } else {
    $args['tax_query'] = [[
      'taxonomy' => 'expertise',
      'field'    => 'slug',
      'terms'    => $slugs,
    ]];
  }

} elseif ($choice === 'service') {

  $slugs = $terms_to_slugs('service');

  if (empty($slugs)) {
    $args['posts_per_page'] = 0;
  } else {
    $args['tax_query'] = [[
      'taxonomy' => 'service',
      'field'    => 'slug',
      'terms'    => $slugs,
    ]];
  }
}

$query = new WP_Query($args);

include locate_template('modules/insights/insights-grid.php');

wp_reset_postdata();
