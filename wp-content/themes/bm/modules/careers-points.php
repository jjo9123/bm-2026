<section class="clients bm-beige">
  <div class="container">
    <div class="col-12">
      <?php if ($intro = get_sub_field('intro')) : ?>
          <?= $intro ?>
      <?php endif; ?>
    </div>
    <div class="col-sm-12 col-md-12">
      <ul class="styled">
        <?php
        if (have_rows('points')) :
          while (have_rows('points')) : the_row(); ?>
            <li><?php the_sub_field('txt'); ?></li>
          <?php endwhile;
        endif;
        ?>
      </ul>
    </div>


<style>
/*.clients li {
  background-image: url(/wp-content/uploads/Careers/careers_benefits-icon1.png);
  background-repeat: no-repeat;
  background-position: left center;
  background-size: 20px;
  margin: 0;
  padding: 5px 15px 5px 35px;
  list-style: none;
}*/
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
