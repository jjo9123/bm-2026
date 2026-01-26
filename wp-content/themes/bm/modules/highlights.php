<section class="highlights text-center" style="background: url('<?php the_sub_field('bg_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php the_sub_field('heading'); ?></h2>

      </div>

      <div class="col-10 mx-auto">
        <div class="slider highlights-slider">
          <?php
            if( have_rows('highlight') ):
              while ( have_rows('highlight') ) : the_row(); ?>
              <div class="highlights-slide">
                <p><?php the_sub_field('txt'); ?></p>
              </div>
              <?php endwhile;
            endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
