<?php
  get_header();
  b4st_main_before();
?>

<main id="main" class="blog">
  <?php get_template_part('/modules/parts/single-post/single-hero'); ?>



  <section class="single">
    <div id="content" role="main">
      <?php get_template_part('loops/single-post', get_post_format()); ?>
    </div>
  </section>
</main>

<?php
  b4st_main_after();
  get_footer();
?>
