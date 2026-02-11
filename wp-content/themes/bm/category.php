<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="bm-white container mt-5">
  <div class="row">

    <div class="col-sm">
      <div id="content" role="main">
        <header class="mb-4">
          <h1>
            <?php _e('Category: ', 'b4st'); echo single_cat_title(); ?>
          </h1>
        </header>
        <?php get_template_part('loops/index-loop'); ?>
      </div><!-- /#content -->
    </div>


  </div><!-- /.row -->
</main><!-- /.container -->

<?php
    b4st_main_after();
    get_footer();
?>
