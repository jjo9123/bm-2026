<?php
    get_header();
    b4st_main_before();
    $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <section class="hero text-center" style="background: url('<?php echo $banner_section['background_image']; ?>') 50%/cover no-repeat; color: #FFFFFF;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <span class="header" style="font-size: 2.5rem; text-transform: uppercase;">Press Releases</h1>
        </div>
      </div>
    </div>
  </section>

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
