<section class="clients equality text-center" style="background: url('<?php the_sub_field('bgimg'); ?>') 50%/cover no-repeat;">
  <div class="container">
    <?php
      if( have_rows('section') ): ?>
      <div class="row">
        <?php while ( have_rows('section') ) : the_row();
          $icon = get_sub_field('icon'); ; ?>

          
            <div class="col-6 col-md-4 pb-4">
              <?php $icon = get_sub_field('icon');
                $size = 'full';
                echo wp_get_attachment_image( $icon, $size );
              ?>

              <p><?php the_sub_field('txt'); ?></p>
            </div>
          

        <?php endwhile; ?>
      </div>
      <?php endif;
    ?>
  </div>
</section>

<style>
.equality img {
  margin-bottom: 30px;
}
.equality p {
  font-size: 1.2rem;
}
</style>
