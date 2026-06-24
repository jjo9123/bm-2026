<?php
  get_header();
  b4st_main_before();

  $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <div id="content" role="main">

    <section class="hero text-center bm-pink">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header pb-5">Page not found</h1>
            <p class="pb-2">Unfortunately the page you are looking for no longer exists. Try going to our <a href="/">home page</a> or using the search below:</p>

            <?php echo do_shortcode('[searchandfilter id="5671"]'); ?>
          </div>
        </div>
      </div>
    </section>



    

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
