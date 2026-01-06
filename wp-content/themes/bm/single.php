<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="blog">
  <section class="hero text-center" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') 50%/cover no-repeat; color: #FFFFFF;">
    <div class="container">
      <div class="row">
        <div class="col-12"></div>
      </div>
    </div>
  </section>

  <section class="single">
    <div id="content" role="main">
      <?php get_template_part('loops/single-post', get_post_format()); ?>
    </div><!-- /#content -->
  </section>

</main><!-- /.container -->

<?php
    b4st_main_after();
    get_footer();
?>
