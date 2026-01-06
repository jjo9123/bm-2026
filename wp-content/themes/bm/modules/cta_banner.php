<section class="cta-banner text-center" style="background: url('<?php echo the_sub_field('background_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container">
    <div class="row">
      <?php if( get_sub_field('add_image') == 'yes' ): ?>
        <div class="col-8 col-md-6 ml-auto">
  
          <?php $image = get_sub_field('image');
  
            if( !empty($image) ): ?>
  
              <img src="<?php echo $image['url']; ?>" loading="lazy" alt="<?php echo $image['alt']; ?>" />
  
            <?php endif; ?>
  
        </div>
  
        <div class="col-12 w-image col-md-6" style="text-align: left;">
          <div>
            <h2 class="header"><?php the_sub_field('title'); ?></h2>
  
            <p class="regular"><?php the_sub_field('sub_title'); ?></p>
  
            <?php if( get_sub_field('add_button') == 'yes' ): ?>
              <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_sub_field('button_text'); ?></a>
            <?php endif; ?>
          </div>
        </div>
  
            <?php else: ?>
              <div class="col-12">
  
                <h2 class="header"><?php the_sub_field('title'); ?></h2>
  
                <p class="regular"><?php the_sub_field('sub_title'); ?></p>
  
                <?php if( get_sub_field('add_button') == 'yes' ): ?>
                  <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_sub_field('button_text'); ?></a>
                <?php endif; ?>
  
              </div>
            <?php endif; ?>
  
    </div>
  </div>
</section>
