<?php
    get_header();
    b4st_main_before();
?>

<main id="main" aria-label="Main content area" role="main">
  <div id="content">
    <?php get_template_part('loops/page-content'); ?>
  </div><!-- /#content -->
</main><!-- /.container -->

<?php
    b4st_main_after();
    get_footer();
?>
