<?php $bg_class = get_sub_field('bg_colour') ?: 'bm-purple'; ?>

<section class="quotes text-center <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row">

      <div class="col-10 mx-auto quote">
        <div class="slider quotes-slider">
          <?php
            if( have_rows('quote') ):
              while ( have_rows('quote') ) : the_row(); ?>
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
