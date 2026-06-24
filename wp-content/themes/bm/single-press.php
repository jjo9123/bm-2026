<?php
    get_header();
    b4st_main_before();
    $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <?php get_template_part('/modules/parts/single-post/single-hero'); ?>

  <section class="single">
    <div id="content" role="main">
      <?php get_template_part('loops/single-press', get_post_format()); ?>
    </div><!-- /#content -->
  </section>

</main><!-- /.container -->

<?php
    b4st_main_after();
    get_footer();
?>
