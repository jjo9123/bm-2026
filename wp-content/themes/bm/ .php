<?php
    get_header();
    b4st_main_before();
?>

<?php
/*
 * The Page Content Loop
 */
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>

    <?php get_template_part('modules/header'); ?>

    <?php get_template_part('modules'); ?>

  </article>
<?php
  endwhile;
  else:
    get_template_part('loops/404');
  endif;
?>

<?php
  b4st_main_after();
  get_footer();
?>
