<section class="img-txt-row" style="background-color: #E3E3E3;">
  <div class="container">
    <?php if( the_sub_field('title') ): ?>
      <div class="row">
        <div class="col-12">
          <h2 class="text-center green"><?php the_sub_field('title'); ?></h2>

          <hr class="heading purple">
        </div>
      </div>
    <?php endif; ?>

    <?php
    if( have_rows('content_row') ):
      while ( have_rows('content_row') ) : the_row(); ?>
        <div class="row regional-info mx-auto">

          <div class="col-lg-3 client-logo" style="background: url('<?php the_sub_field('image'); ?>') 50%/contain no-repeat; color: #FFFFFF;"></div>

          <div class="col-lg-7">
            <h3><?php the_sub_field('title'); ?></h3>
            <?php the_sub_field('content'); ?>
            
            <!-- BUTTON --->
             <?php
              if( get_sub_field('btn_show') == 'yes' && get_sub_field('btn_modal') == 'no'):
                $link = get_sub_field('btn_link');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                  ?>
                  
                    <a href="<?php echo esc_url($link_url); ?>" class="btn btn-green header">
                      <?php echo $link_title; ?>
                    </a>
                <?php endif;
    
              elseif( get_sub_field('btn_show') == 'yes' && get_sub_field('btn_modal') == 'yes'):
                $post_object = get_sub_field('modal');
                if( $post_object ):
                  $post = $post_object;
                ?>
                  <?php setup_postdata($post); ?>
                 
                    <a href="javascript:void(0)" class="btn btn-green header" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
                      <?php the_sub_field('btn_text'); ?>
                    </a>
    
                  <?php get_template_part('modules/modal'); ?>
    
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                
                
                
            <?php  endif; ?>
          <!-- BUTTON END -->
          </div>
        </div>
      <?php endwhile;
    endif;?>
  </div>
</section>
