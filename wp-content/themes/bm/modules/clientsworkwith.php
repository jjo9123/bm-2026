<section class="clients text-center" style="background: url('/wp-content/uploads/2019/01/clients-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2><?php the_sub_field('heading'); ?></h2>

          <hr class="heading purple">
        </div>
      </div>

      <?php
        if( have_rows('section') ):
          while ( have_rows('section') ) : the_row();
            $logos = get_sub_field('logos');
            $size = 'full'; ?>

            <div class="row clients-txt">
              <div class="col-12 col-lg-10 col-xl-12">
                <h3 class="green"><?php the_sub_field('heading'); ?></h3>

                <p><?php the_sub_field('txt'); ?></p>
              </div>
            </div>

              <?php if( $logos ): ?>
                <div class="row clients-img">
                  <?php foreach( $logos as $logo ): ?>
                    <div class="col-lg-2 client-logo">
                      <img src="<?php echo $logo['url']; ?>" loading="lazy" alt="<?php echo $logo['alt']; ?>">
                      <p><?php echo $logo['caption']; ?></p>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
          <?php endwhile;
        endif;
      ?>
    </div>
  </div>
</section>
