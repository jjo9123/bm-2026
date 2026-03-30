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
            <h1 class="header">Page not found</h1>
          </div>
        </div>
      </div>
    </section>



    <section class="blog bm-white">
        <h4 class="pb-2">Unfortunately the page you are looking for no longer exists. Try going to our <a href="/">home page</a> or using the search below:</h4>

        <?php echo do_shortcode('[searchandfilter id="5671"]'); ?>
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
