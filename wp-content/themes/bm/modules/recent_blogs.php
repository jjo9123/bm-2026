<?php
// modules/insights/recent_blogs.php
$bg_class = get_sub_field('bg_colour') ?: 'bm-white';
$cat_id   = (int) get_sub_field('category');
$category = $cat_id ? get_category($cat_id) : null;

$cat_slug = (!empty($category) && !is_wp_error($category)) ? ($category->slug ?? '') : '';
$bg       = get_sub_field('bg') ?: '';
$number   = (int) get_sub_field('num');
$tag_name = get_sub_field('tag');              // ACF text field
$mode     = get_sub_field('events_or_blogs');  // blogs | events | both
$title    = get_sub_field('title');

if ($number <= 0) $number = 3;

$section_title = $title ?: 'BM Insights';
$cta_url       = $tag_name ? home_url('/tag/' . $tag_name . '/') : '/blog';

$args = [
  'post_type'      => 'post',
  'posts_per_page' => $number,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
];

if (!empty($tag_name)) {
  $args['tag'] = $tag_name;
}

// your legacy events category id from the existing file
$events_cat_id = 5;

if ($mode === 'blogs') {
  $args['category__not_in'] = [$events_cat_id];
  $args['cat']              = '-27070';
} elseif ($mode === 'events') {
  $args['category__in'] = [$events_cat_id];
} else {
  // both: no category filter
}

$query = new WP_Query($args);

include locate_template('modules/insights/insights-grid.php');

wp_reset_postdata();
