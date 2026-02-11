<?php
  get_header();
  b4st_main_before();
?>

<main id="main" class="blog">
  <div id="content" class="bm-white" role="main">

    
  <?php get_template_part('modules/parts/blog-index/blog-hero'); ?>

    
    <section class="blog">
      <div class="container-fluid bm-pink">

        <div class="row search">
          <div class="col-12 col-md-10">
            <div class="text-center pb-4">
              <h2>Search Insights</h2>
            </div>
            <div class="blog-filter__form">
              <?php echo do_shortcode('[searchandfilter id="455"]'); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="container news bm-white">
        <?php get_template_part('loops/index-loop'); ?>
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
