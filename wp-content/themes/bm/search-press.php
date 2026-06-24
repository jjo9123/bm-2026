<?php
    get_header();
    b4st_main_before();

    $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog press">
  <div id="content" role="main">

    <section class="hero bm-pink">
        <div class="row">
          <div class="col-12 col-md-7">
            <h1 class="header">Press releases</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="press-intro">
      <div class="container text-center">
        <div class="row">
          <div class="col-12 mx-auto">
            <p>Welcome to the Blake Morgan news room where you will find the latest updates on what is happening across the firm. If you have a media enquiry please contact our PR team on <strong>blakemorgan@camargue.uk</strong> or call 020 7636 7366</p>
          </div>
        </div>
      </div>
    </section>


    <section class="blog bm-white">
      <div class="container">
        <div class="row">
          <div class="col-12 blog-filter">
            <div class="text-center">
              <h2 class="dpurple">Search press</h2>

              <hr class="heading green">
            </div>
          </div>
        </div>

        <div class="row search">
          <div class="col-12 col-md-10">
            <?php echo do_shortcode('[searchandfilter id="686"]'); ?>
            
          </div>
        </div>
      </div>

      <div class="container news">
        <?php echo do_shortcode('[searchandfilter id="686" show="results"]'); ?>
        
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
