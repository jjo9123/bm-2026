<?php
/*
 * The Default Loop (used by index.php, category.php and author.php)
 * =================================================================
 * If you require only post excerpts to be shown in index and category pages,
 * use the [---more---] block within blog posts.
 */
?>

<div id="results">
  <div class="row staff cards experts-cards">
    <?php
$char = isset($_GET['query']) ? sanitize_text_field(wp_unslash($_GET['query'])) : '';

$paged = get_query_var('paged') ? (int) get_query_var('paged') : 1;

$args = array(
  'post_type'      => 'people',
  'posts_per_page' => 12,
  'paged'          => $paged,
  'orderby'        => 'meta_value',
  'meta_key'       => 'contact_details_last_name',
  'order'          => 'asc',
);

if ( $char !== '' ) {
  $args['meta_query'] = array(
    array(
      'key'     => 'contact_details_last_name',
      'value'   => $char,
      'compare' => 'LIKE',
    )
  );

  // if you're using Search & Filter Pro (your filter id suggests you are)
  $args['search_filter_id'] = 680;

  // only include if your setup actually supports this arg
  $args['starts_with'] = $char;
}
?>

     <?php $my_query = null;
      $my_query = new WP_Query($args);
      if( $my_query->have_posts() ) : ?>
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <?php get_template_part('loops/people-post', get_post_format()); ?>
        <?php endwhile;
      endif; ?>
  </div>

  <div class="row pagination-row justify-content-center">
      <?php if ( function_exists('b4st_pagination') ) { b4st_pagination(); } else if ( is_paged() ) { ?>
      <ul class="pagination">
        <li class="page-item older">
          <?php next_posts_link('<i class="fas fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
        <li class="page-item newer">
          <?php previous_posts_link(__('Next', 'b4st') . ' <i class="fas fa-arrow-right"></i>') ?></li>
      </ul>
      <?php } ?>
    </div>
  </div>


  </div>
</div>
