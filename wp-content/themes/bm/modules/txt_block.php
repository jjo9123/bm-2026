<section class="txt <?php if( get_sub_field('left_or_centered') == 'center'): ?>text-center<?php endif; ?> <?php if( get_sub_field('background_colour') == 'grey'): ?> grey<?php endif; ?>" <?php if( get_sub_field('bg_choice') == 'img'): ?>style="background: #404040 url('<?php the_sub_field('bg_image'); ?>') 50% / cover no-repeat; color: #FFFFFF; "<?php endif; ?>>
  <div class="container">
    <div class="row">
      <?php if( get_sub_field('heading_show') == 'yes'): ?>
        <div class="col-12 col-lg-10 mx-auto">
          <?php if( get_sub_field('heading') ): ?>
            <h2 class="<?php if( get_sub_field('bg_choice') == 'img'): ?>green<?php else: ?>purple<?php endif; ?>">
              <?php the_sub_field('heading'); ?>
            </h2>

            <?php if( get_sub_field('bg_choice') == 'img'): ?>
              <hr class="heading purple" <?php if( get_sub_field('left_or_centered') == 'left'): ?>style="text-align: left; margin-left: 0;"<?php endif; ?>>
            <?php else: ?>
              <hr class="heading green" <?php if( get_sub_field('left_or_centered') == 'left'): ?>style="text-align: left; margin-left: 0;"<?php endif; ?>>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if( get_sub_field('quote_show') == 'yes'): ?>
        <div class="col-12 col-lg-10 col-xl-12 mx-auto quote">
          <p><?php the_sub_field('quote'); ?></p>
        </div>

        <?php if( get_sub_field('heading_show') == 'yes'): ?>
          <style>section.txt .quote { margin-top: 30px; }</style>
        <?php endif; ?>
      <?php endif; ?>

      <div class="col-12 col-lg-10 mx-auto">
        <?php the_sub_field('txt'); ?>

        <div class="btn-row">
          <?php
            // NORMAL BUTTON (link)
            if( get_sub_field('btn_show') == 'yes' && get_sub_field('btn_modal') == 'no'):
              $link = get_sub_field('btn_link');
              if( $link ):
                $link_url   = $link['url'];
                $link_title = $link['title'];
          ?>
                <a href="<?php echo esc_url($link_url); ?>" class="btn btn-green header">
                  <?php echo esc_html($link_title); ?>
                </a>
          <?php
              endif;

            // MODAL BUTTON (replaced with jump link)
            elseif( get_sub_field('btn_show') == 'yes' && get_sub_field('btn_modal') == 'yes'):
              $btn_txt = get_sub_field('btn_txt') ? get_sub_field('btn_txt') : 'Get in touch';
          ?>
              <a href="#contact-footer" class="btn btn-green header">
                <?php echo esc_html($btn_txt); ?>
              </a>

          <?php
            /*
              // OLD MODAL CODE (commented out)
              $post_object = get_sub_field('modal');
              if( $post_object ):
                $post = $post_object;
                setup_postdata($post);
          ?>
                <a href="javascript:void(0)" class="btn btn-green header" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
                  <?php the_sub_field('btn_txt'); ?>
                </a>

                <?php get_template_part('modules/modal'); ?>

                <?php wp_reset_postdata(); ?>
          <?php
              endif;
            */
            endif;
          ?>

          <?php if( get_sub_field('add_additional_buttons') == 'yes'): ?>

            <!--- Additional blogs button 1 ----->
            <?php if( get_sub_field('add_1_text') && get_sub_field('add_1_link') ): ?>
              <a href="<?php the_sub_field('add_1_link'); ?>" target="_blank" class="btn btn-green header">
                <?php the_sub_field('add_1_text'); ?>
              </a>
            <?php endif; ?>

            <!--- Additional events button 2 ----->
            <?php if( get_sub_field('add_2_text') && get_sub_field('add_2_link') ): ?>
              <a href="<?php the_sub_field('add_2_link'); ?>" target="_blank" class="btn btn-green header">
                <?php the_sub_field('add_2_text'); ?>
              </a>
            <?php endif; ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
