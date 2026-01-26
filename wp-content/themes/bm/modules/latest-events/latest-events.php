<?php
// modules/latest-events/latest-events.php
$bg_class = get_sub_field('bg_colour') ?: 'bm-white';
$intro = get_sub_field('intro');     // optional WYSIWYG
$cta   = get_sub_field('btn_link');  // optional ACF link

$limit = 3; // code default

// IMPORTANT: set this to your actual Events category slug (or ID)
$events_category_slug = 'events';

$args = [
  'post_type'      => 'post',
  'posts_per_page' => $limit,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'category_name'  => $events_category_slug,
];

// If you want to exclude those same tag IDs here too, uncomment:
// $args['tag__not_in'] = [25061, 27061];

$query = new WP_Query($args);

include locate_template('modules/latest-events/latest-events-grid.php');

wp_reset_postdata();
