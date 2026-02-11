<?php
/*
 * The Default Loop (used by index.php, category.php and author.php)
 * =================================================================
 * If you require only post excerpts to be shown in index and category pages,
 * use the [---more---] block within blog posts.
 */
?>



<?php if( have_posts() ) : ?>

  <div id="results" class="test">
    <div class="row">
      <?php while(have_posts()) : the_post(); ?>
        <?php get_template_part('loops/index-post'); ?>
      <?php endwhile; ?>
    </div>

    <div class="row">
      <?php if ( function_exists('b4st_pagination') ) { b4st_pagination(); } else if ( is_paged() ) { ?>
      <ul class="pagination">
        <li class="page-item older">
          <?php next_posts_link('<i class="fas fa-angle-left"></i> ' . __('Previous', 'b4st')) ?></li>
        <li class="page-item newer">
          <?php previous_posts_link(__('Next', 'b4st') . ' <i class="fas fa-angle-right"></i>') ?></li>
      </ul>
      <?php } ?>
    </div>
  </div>

  <?php
  else :?>

  <h4 class="dpurple" style="padding-top:50px; padding-bottom: 50px;">Unfortunately no results have been found. Try broadening your search to access more of our BM Insights.</h4>

 <?php endif; wp_reset_postdata();  ?>
