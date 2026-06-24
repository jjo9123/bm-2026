<?php
  get_header();
  b4st_main_before();

  $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <div id="content" role="main">

    <section class="hero bm-pink">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-7">
            <h1 class="header">Search results</h1>
          </div>
        </div>
      </div>
    </section>



    <section class="blog bm-white">
      <div class="container">
        <?php get_template_part('loops/search-loop'); ?>
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
