
    <?php $cta_section = get_sub_field('banner_section'); ?>

    <?php if( get_sub_field('cta_choice') == 'slider'):
      if( have_rows('slider_section') ): while ( have_rows('slider_section') ) : the_row();
        if( have_rows('slides') ): ?>
            <section class="cta-banner slider text-center">
              <div class="home-slider">

                <?php while ( have_rows('slides') ) : the_row(); ?>
                  <div class="home-slide" style="background: url('<?php echo the_sub_field('background_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
                    <div class="container">
                      <div class="row">

                    <?php if( get_sub_field('add_image') == 'yes'): ?>
                        <div class="col-8 col-md-6 ml-auto">
                          <?php $image = get_sub_field('image');

                            if( !empty($image) ): ?>

                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

                            <?php endif; ?>
                        </div>

                        <div class="col-12 w-image col-md-6" style="text-align: left;">
                          <div>
                            <h2 class="header"><?php echo the_sub_field('title'); ?></h2>

                            <p class="regular"><?php echo the_sub_field('sub_title'); ?></p>

                            <?php if( get_sub_field('add_button') == 'yes' ): ?>
                              <a href="<?php echo the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php echo the_sub_field('button_text'); ?></a>
                            <?php endif; ?>
                          </div>
                        </div>


                    <?php else: ?>

                    <div class="col-12 col-md-10 mx-auto">
                      <div>
                      <h2 class="header"><?php echo the_sub_field('title'); ?></h2>

                      <p class="regular"><?php echo the_sub_field('sub_title'); ?></p>

                      <?php if( get_sub_field('add_button') == 'yes' ): ?>
                        <a href="<?php echo the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php echo the_sub_field('button_text'); ?></a>
                      <?php endif; ?>

                      </div>
                    </div>

                    <?php endif; ?>


                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>

                </div>
              </section>

            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
    <?php elseif( get_sub_field('cta_choice') == 'banner'): ?>

      <section class="cta-banner text-center" style="background: url('<?php echo $cta_section['background_image']; ?>') 50%/cover no-repeat; color: #FFFFFF;">
          <div class="container">
            <div class="row">
              <?php if( $cta_section['add_image'] == 'yes' ): ?>
                    <div class="col-8 col-md-6 ml-auto">

                       <?php $image = $cta_section['image'];

                         if( !empty($image) ): ?>

                           <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

                         <?php endif; ?>

                    </div>

                    <div class="col-12 w-image col-md-6" style="text-align: left;">
                       <div>
                         <h2 class="header"><?php echo $cta_section['title']; ?></h2>

                         <p class="regular"><?php echo $cta_section['sub_title']; ?></p>

                         <?php if( $cta_section['add_button'] == 'yes' ): ?>
                           <a href="<?php echo $cta_section['button_link']; ?>" class="btn btn-green header" tabindex="0"><?php echo $cta_section['button_text']; ?></a>
                         <?php endif; ?>
                       </div>
                   </div>

              <?php else: ?>
                <div class="col-12">

                  <h2 class="header"><?php echo $cta_section['title']; ?></h2>

                  <p class="regular"><?php echo $cta_section['sub_title']; ?></p>

                  <?php if( $cta_section['add_button'] == 'yes' ): ?>
                    <a href="<?php echo $cta_section['button_link']; ?>" class="btn btn-green header" tabindex="0"><?php echo $cta_section['button_text']; ?></a>
                  <?php endif; ?>

                </div>
              <?php endif; ?>

          </div>
        </div>
      </section>


    <?php  endif; ?>
