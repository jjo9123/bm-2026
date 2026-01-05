<?php
/*
 * The Page Content Loop
 */
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>

    <?php get_template_part('modules/header'); ?>

    <?php get_template_part('/modules'); ?>

  </article>
<?php
  endwhile;
  else :
    get_template_part('loops/404');
  endif;
?>
