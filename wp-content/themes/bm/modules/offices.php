<section class="map-section infographic text-center" style="background: url('/wp-content/uploads/2019/02/offices-img-bg.jpg') 50% / cover no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #32214c;"><?php the_sub_field('heading'); ?></h2>
            <?php the_sub_field('text'); ?>
          </div>

          <div class="col-12">
            <div class="row mt-5">
              <div class="col">
                  <img src="/wp-content/uploads/Office-images/Blake-Morgan-LLP-map-of-offices.png" alt="Blake Morgan LLP Offices">
              </div>
            </div>
          </div>

          <?php

          // check if the repeater field has rows of data
          if( have_rows('info_box') ): ?>
          <div class="col-md-12 mx-auto infographic-boxes">
            <div class="row">
             <?php // loop through the rows of data
                 while ( have_rows('info_box') ) : the_row();
                  $location = get_sub_field('location');
                  $post = $location;
                  setup_postdata( $post );?>

                <div class="col-md-5 col-lg-4 mx-auto">
                  <div class="info-box-content" style="background: url('<?php the_sub_field('box_background'); ?>') 50% / cover no-repeat; color: #FFFFFF;">
                    <a href="<?php the_permalink(); ?>"></a>
                    <p><span><?php the_title(); ?></span></p>
                  </div>
                </div>

              <?php wp_reset_postdata(); ?>

              <?php endwhile; ?>

            </div>
          </div>
          <?php else : ?>

        <?php endif;?>

          </div>
        </div>
    </section>
