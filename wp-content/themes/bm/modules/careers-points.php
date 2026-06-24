<section class="clients bm-beige">
  <div class="container">
    <div class="col-12">
      <?php if ($intro = get_sub_field('intro')) : ?>
          <?= $intro ?>
      <?php endif; ?>
    </div>
    <div class="col-sm-12 col-md-12">
      <ul class="clients-bullets row">
        <?php if (have_rows('points')) : ?>
          <?php while (have_rows('points')) : the_row(); ?>
            <li class="col-12 col-md-6 col-lg-4">
              <span><?php the_sub_field('txt'); ?></span>
            </li>
          <?php endwhile; ?>
        <?php endif; ?>
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
.clients-bullets {
  padding-left: 0;
  list-style: none;
}

.clients-bullets li {
  margin-bottom: 0.75rem;
}

.clients-bullets li span {
  position: relative;
  display: block;
  padding-left: 1.25rem;
}

.clients-bullets li span::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.65em;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background-color: currentColor;
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
