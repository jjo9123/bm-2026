<?php
/*
 * The Default Loop (used by index.php, category.php and author.php)
 * =================================================================
 * If you require only post excerpts to be shown in index and category pages,
 * use the [---more---] block within blog posts.
 */
?>

<div id="results">
  <div class="row staff">
    <?php
      $char = $_GET['query'];

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

      $args=array(
        'post_type'=> 'people',
        'posts_per_page' => 12,
        'paged' => $paged,
        'orderby'  => 'meta_value',
        'meta_key' => 'contact_details_last_name',
        'order'    => 'asc',
        'starts_with' => $char,
        'meta_query' => array(
          array(
            'key' => 'contact_details_last_name',
            'value' => $char,
            'compare' => 'LIKE'
          )
        )
      );
      $args['search_filter_id'] = 680;

      $my_query = null;
      $my_query = new WP_Query($args);
      if( $my_query->have_posts() ) : ?>
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <?php get_template_part('loops/people-post', get_post_format()); ?>
        <?php endwhile;
      endif; ?>
  </div>

  <div class="row">
    <?php if ($my_query->max_num_pages > 1) : // custom pagination ?>
      <div class="pagination">
        <?php
          $orig_query = $wp_query; // fix for pagination to work
          $wp_query = $my_query;
          $big = 999999999;
          echo paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'next_text' => __('<i class="fas fa-angle-right"></i>'),
            'prev_text' => __('<i class="fas fa-angle-left"></i>'),
            'total' => $wp_query->max_num_pages
          ));
          $wp_query = $orig_query; // fix for pagination to work
        ?></div>
    <?php endif; ?>
  </div>
</div>
