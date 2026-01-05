<?php
/*
 * The Default Loop (used by index.php, category.php and author.php)
 * =================================================================
 * If you require only post excerpts to be shown in index and category pages,
 * use the [---more---] block within blog posts.
 */
?>

<?php

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  if(1 == $paged):
    $args = array(
    	'category_name' => 'articles',
      'posts_per_page' => '1'
    );
    $arg = new WP_Query( $args ); ?>

  <div id="firstposts" class="row">
    <?php if( $arg->have_posts() ) : ?>
        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

    <?php
      $args = array(
        'category_name' => 'case-studies',
        'posts_per_page' => '1'
      );
      $arg = new WP_Query( $args );
      if( $arg->have_posts() ) : ?>

        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

    <?php
      $args = array(
        'category_name' => 'events',
        'posts_per_page' => '1'
      );
      $arg = new WP_Query( $args );
      if( $arg->have_posts() ) : ?>

        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

    <?php
      $args = array(
        'category_name' => 'guides',
        'posts_per_page' => '1'
      );
      $arg = new WP_Query( $args );
      if( $arg->have_posts() ) : ?>

        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

    <?php
      $args = array(
        'category_name' => 'newsletters',
        'posts_per_page' => '1'
      );
      $arg = new WP_Query( $args );
      if( $arg->have_posts() ) : ?>

        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

    <?php
      $args = array(
        'category_name' => 'training',
        'posts_per_page' => '1'
      );
      $arg = new WP_Query( $args );
      if( $arg->have_posts() ) : ?>

        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>
  </div>

  <script>
    $(document).on("sf:ajaxstart", ".searchandfilter", function(){
      console.log("ajax start");
      $('#firstposts').hide();
    });
  </script>
<?php endif; ?>


<?php
  $args = array(
    'post_type' => 'post'
  );
  $args['search_filter_id'] = 455;

  $arg = new WP_Query( $args );

  if( $arg->have_posts() ) : ?>
    <div id="results" class="test">
      <div class="row">
        <?php while($arg->have_posts()) : $arg->the_post(); ?>
          <?php include( locate_template( 'loops/index-post.php', false, false ) ); ?>
        <?php endwhile; ?>
      </div>

      <div class="row">
        <?php if ($arg->max_num_pages > 1) : // custom pagination ?>
          <div class="pagination">
            <?php
              $orig_query = $wp_query; // fix for pagination to work
              $wp_query = $arg;
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


  <?php else :?>
    <h4 class="dpurple" style="padding-top:50px; padding-bottom: 50px;">Unfortunately no results have been found. Try broadening your search too access more of our BM Insights.</h4>

<?php wp_reset_postdata(); endif; ?>
