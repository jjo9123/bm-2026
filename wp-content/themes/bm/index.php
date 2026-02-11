<?php
  get_header();
  b4st_main_before();
  $slider_section = get_field('header_section', 'option');
  $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog">
  <div id="content test" role="main">

    <?php if( $banner_section OR $slider_section ): ?>
      <?php if( get_field('header_choice', 'option') == 'slider'):
        if( have_rows('header_section', 'option') ): while ( have_rows('header_section', 'option') ) : the_row();
          if( have_rows('slides') ): ?>
              <section class="hero slider">
                <div class="home-slider">
                  <?php $count = 0; ?>
                  <?php while ( have_rows('slides', 'option') ) : the_row(); ?>
                    <div class="home-slide" style="background: url('<?php echo the_sub_field('background_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
                      <div class="container">
                        <div class="row">
                          <div class="col-12 col-md-7">
                            <?php if ($count == 0): ?>
                              <h1 class="header"><?php echo the_sub_field('title'); ?></h1>
                            <?php else: ?>
                              <p><?php echo the_sub_field('title'); ?></p>
                            <?php endif; ?>

                            <p class="regular"><?php echo the_sub_field('sub_title'); ?></p>

                            <?php if( get_sub_field('add_button') == 'yes' ): ?>
                              <a href="<?php echo the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php echo the_sub_field('button_text'); ?></a>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $count++; ?>
                  <?php endwhile; ?>
                  </div>
                </section>

          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>

    <?php elseif( get_field('header_choice', 'option') == 'none'): ?>

    <?php elseif( get_field('header_choice', 'option') == 'banner'): ?>

      <?php if( $banner_section['image_or_video'] == 'img'): ?>
        <section class="hero" style="<?php if( $banner_section['background_image'] ): ?>background: url('<?php echo $banner_section['background_image']; ?>') 50%/cover no-repeat; color: #FFFFFF;<?php else: ?>background-color:#e7e7e7;<?php endif; ?>">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-7">
                  <h1 class="header"><?php echo $banner_section['title']; ?></h1>

                  <p><?php echo $banner_section['sub_title']; ?></p>

                  <?php if( $banner_section['add_button'] == 'yes' ):
                    if( $banner_section['btn_link'] ): ?>
                      <a href="<?php echo $banner_section['btn_link']; ?>" class="btn btn-green header" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>

        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>

    <section class="blog">
      <div class="container-fluid bm-pink">

        <div class="row search">
          <div class="col-12 col-md-10">
            <div class="text-center pb-4">
              <h2>Search Insights</h2>
            </div>
            <?php echo do_shortcode('[searchandfilter id="455"]'); ?>
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
