<?php
// modules/latest-content/latest-content.php

$intro = get_sub_field('intro');
$cta   = get_sub_field('btn_link');
$bg_class = get_sub_field('bg_colour') ?: 'bm-white';

// Defaults
$post_types = ['post', 'case_study', 'guide', 'newsletter'];
$limit = 3;

// Base query args
$args = [
  'post_type'      => $post_types,
  'posts_per_page' => $limit,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
];

/**
 * EXCLUDE EVENTS (parent + children) - robust
 */
$events_term = get_category_by_slug('events');

if ( $events_term && !is_wp_error($events_term) ) {
  $events_id = (int) $events_term->term_id;

  $args['tax_query'] = [
    [
      'taxonomy'         => 'category',
      'field'            => 'term_id',
      'terms'            => [$events_id],
      'operator'         => 'NOT IN',
      'include_children' => true,
    ],
  ];
}

// NOW run the query
$query = new WP_Query($args);

include locate_template('modules/latest-content/latest-content-grid.php');

wp_reset_postdata();
