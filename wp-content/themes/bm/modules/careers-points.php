<section class="clients" style="background: url('<?php the_sub_field('bgimg'); ?>') 50%/cover no-repeat;">
  <div class="container">
    <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
      <ul class="row">
          <?php
          if( have_rows('points') ):
            while ( have_rows('points') ) : the_row(); ?>
              <li class="col-sm-6" style="background-image: url('<?php the_sub_field('icon'); ?>');"><?php the_sub_field('txt'); ?></li>
            <?php endwhile;
          endif;
        ?>
      </ul>
    </div>


<style>
.clients li {
  background-image: url(/wp-content/uploads/Careers/careers_benefits-icon1.png);
  background-repeat: no-repeat;
  background-position: left center;
  background-size: 20px;
  margin: 0;
  padding: 5px 0 5px 35px;
  list-style: none;
}
</style>


    <?php
      if( have_rows('section') ):
        while ( have_rows('section') ) : the_row();
          $icon = get_sub_field('icon'); ; ?>

          <div class="row">
            <div class="col-12 col-lg-10 col-xl-12">
              <?php $icon = get_sub_field('icon');
                $size = 'full';
                echo wp_get_attachment_image( $icon, $size );
              ?>

              <p><?php the_sub_field('txt'); ?></p>
            </div>
          </div>

        <?php endwhile;
      endif;
    ?>
  </div>
</section>
