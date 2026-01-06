<section <?php if( get_sub_field('id') ): ?>id="<?php echo get_sub_field('id'); ?>" <?php endif; ?> class="txt">
  <div class="container">
    <div class="row">
        <div class="col-12 col-lg-12 mx-auto">
           <?php if( get_sub_field('heading') ): ?>
                <h2 class="purple" style="margin-bottom: 20px;">
                  <?php the_sub_field('heading'); ?>
                </h2>
            <?php endif; ?>
            <?php the_sub_field('intro_text'); ?>
        </div>

      <div class="col-12 col-lg-6 mx-auto left-col">
        <?php the_sub_field('txt'); ?>
        
        <div class="btn-row">
          <?php
          
            if( get_sub_field('btn_show') == 'yes'):
              $link = get_sub_field('btn_link');
              if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                ?>
                
                  <a href="<?php echo esc_url($link_url); ?>" class="btn btn-green header">
                    <?php echo $link_title; ?>
                  </a>
              <?php endif;

            endif; ?>
        
        </div>

      </div>

      <div class="col-12 col-lg-6 mx-auto right-col" style="align-content: center;">
        <?php the_sub_field('right_text'); ?>

      </div>
      
    </div>
  </div>
</section>