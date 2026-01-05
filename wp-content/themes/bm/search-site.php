<?php
  get_header();
  b4st_main_before();

  $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('<?php echo $banner_section['background_image']; ?>') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">Search Results</h1>
          </div>
        </div>
      </div>
    </section>



    <section class="blog" style="background: url('/wp-content/uploads/2019/02/blog-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container news">
        <?php get_template_part('loops/search-loop'); ?>
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
