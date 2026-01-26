<?php if( get_sub_field('text') || get_sub_field('images') ): ?>
  <section class="exp-clients text-center">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 col-xl-12 mx-auto text-section">
          <h2 style="color: #32214c;">
            <?php the_sub_field('heading'); ?>
          </h2>

          <?php if( get_sub_field('add_text_section') == 'yes' ): ?>
            <?php the_sub_field('text'); ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="row no-gutters">
        <?php
          $images = get_sub_field('images');
          if( $images ): ?>
          <?php foreach( $images as $image ): ?>
            <div class="col-6 col-sm-3 client-logo">
              <img src="<?php echo $image['url']; ?>" loading="lazy" alt="<?php echo $image['alt']; ?>" />

              <p>
                <?php echo $image['caption']; ?>
              </p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
