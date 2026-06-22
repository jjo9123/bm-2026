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
        'post_type'        => 'people',
        'posts_per_page'   => 12,
        'paged'            => $paged,
        'orderby'          => 'meta_value',
        'meta_key'         => 'contact_details_last_name',
        'order'            => 'asc',
        'search_filter_id' => 680,
      );

      if ( $char !== '' ) {
        $args['starts_with'] = $char;

        $args['meta_query'] = array(
          array(
            'key'     => 'contact_details_last_name',
            'value'   => $char,
            'compare' => 'LIKE',
          )
        );
      }

      $my_query = new WP_Query($args);

      if ( $my_query->have_posts() ) :
        while ( $my_query->have_posts() ) :
          $my_query->the_post();

          get_template_part('loops/people-post', get_post_format());

        endwhile;
      endif;

      wp_reset_postdata();
    ?>
  </div>

  <div class="row pagination-row justify-content-center">
    <?php if ( $my_query->max_num_pages > 1 ) : ?>
      <div class="pagination">
        <?php
          global $wp_query;

          $orig_query = $wp_query;
          $wp_query = $my_query;

          $big = 999999999;

          echo paginate_links(array(
            'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
            'format'    => '?paged=%#%',
            'current'   => max(1, get_query_var('paged')),
            'next_text' => __('<i class="fas fa-angle-right"></i>'),
            'prev_text' => __('<i class="fas fa-angle-left"></i>'),
            'total'     => $my_query->max_num_pages,
          ));

          $wp_query = $orig_query;
        ?>
      </div>
    <?php endif; ?>
  </div>
</div>