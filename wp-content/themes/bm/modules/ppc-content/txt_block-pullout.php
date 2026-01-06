<section class="txt grey" style="<?php if( get_sub_field('bg_choice')=='img' ): ?>background: url('<?php the_sub_field('bg_image'); ?>') 50% / cover no-repeat;<?php endif; ?> <?php if( get_sub_field('txt_col')=='light'): ?>color: #FFFFFF;<?php endif; ?>">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto">
        <?php if( the_sub_field('heading') ): ?>
          <h2 style="<?php if( get_sub_field('bg_choice') == 'img'): ?>color: #a2c754;<?php else: ?>color: #a395b7;<?php endif; ?> text-align: center;">
            <?php the_sub_field('heading'); ?>
          </h2>
        <?php endif; ?>

        <?php
          if( have_rows('bullet_points') ): ?>
            <ul class="styled">
              <?php  while ( have_rows('bullet_points') ) : the_row(); ?>
                <li>
                  <?php the_sub_field('bullet_point'); ?>
                </li>
              <?php endwhile; ?>
            </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
