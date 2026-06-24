<?php
// modules/insights/insights-category.php

$cat_id   = get_sub_field('category'); // ACF: category selector field
$category = $cat_id ? get_category($cat_id) : null;

$cat_slug = (!empty($category) && !is_wp_error($category)) ? ($category->slug ?? '') : '';
$bg       = get_sub_field('bg');
$number   = (int) get_sub_field('num');

$args = [
  'post_type'      => 'post',
  'posts_per_page' => $number ?: 3,
  'tag__not_in'    => [25061, 27061],
  'cat'            => $cat_id ? (int) $cat_id : 0,   // <-- filter by selected category
];

// Keep your special Brexit page logic if needed
if (is_page(6033)) {
  unset($args['cat']);
  $args['tag'] = 'brexit';
}

$query = new WP_Query($args);

// Render using shared grid template
include locate_template('modules/insights/insights-grid.php');

wp_reset_postdata();
