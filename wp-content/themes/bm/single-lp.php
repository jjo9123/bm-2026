<?php
    get_header('lp');
    b4st_main_before();
?>

<?php
/*
 * The Page Content Loop
 */
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>

  <section class="hero text-center" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') 50%/cover no-repeat; color: #FFFFFF;">
    <div class="container">
      <div class="row">
        <div class="col-12">

        </div>
      </div>
    </div>
  </section>

   <div class="container single-content lp">
      <div class="row">
        <div class="col-9">
          <header class="mb-5">


          </header>
        </div>
      </div>

          <section>


                  <div class="row">

                    <div class="col-md-12 col-lg-6">

                        <div class="lp-copy">
                          <h1><?php the_title()?></h1>

                          <hr class="blog heading green">
                         <?php the_field('landing_page_text'); ?>

                        </div>


                    </div>

                      <div class="col-lg-5 mx-auto">
                        <div style="background: url('https://www.blakemorgan.co.uk/wp-content/uploads/Images/Black-Background/F3A3485_background.jpg') 50% / cover no-repeat; background-color: #333; color: #FFFFFF; padding: 25px;">

                        <?php
                          $guide_cover = get_field('download_image');
                        ?>

                          <img class="lp-img" src="<?php echo $guide_cover['url']; ?>" alt="<?php echo $guide_cover['alt']; ?>" />

                            <h5 style="color: #fff;"><?php the_field('form_title'); ?></h5>

                            <?php if( get_field('form_txt') ): ?>
                              <p class="lp_form-txt"><?php the_field('form_txt'); ?></p>
                            <?php endif; ?>

                            <?php
                              $form_object = get_field('form');
                              gravity_form_enqueue_scripts($form_object['id'], true);
                              gravity_form($form_object['id'], false, false, false, '', true, 1);
                            ?>

                            <?php if( get_field('form_footer') ): ?>
                              <div class="form-footer">
                                <?php the_field('form_footer'); ?>
                              </div>
                            <?php endif; ?>
                        </div>
                      </div>



                  </div>


          </section>
        </div>
      </div>
    </div>







  </article>
<?php
  endwhile;
  else :
    get_template_part('loops/404');
  endif;
?>




<?php
    b4st_main_after();
    get_footer();
?>
