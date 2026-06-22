<?php
// Top section fields (new layout)
$intro_title    = get_field('intro_title');

?>

<section class="category-events">
  <div class="container">

    <div class="row">
      <?php if ($intro_title) : ?>
        <div class="col-12 col-lg-11 intro-text">
          <p><?php echo esc_html($intro_title); ?></p>
        </div>
      <?php endif; ?>

    </div>

  </div>

  <article role="article" id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">

      <?php if (have_rows('event_modules')) : ?>
        <?php while (have_rows('event_modules')) : the_row(); ?>

          <?php if (get_row_layout() === 'text_block') : ?>
            <?php
            $bg_on  = (get_sub_field('add_bg_img') === 'yes');
            $bg_img = get_sub_field('background_image');
            $title  = get_sub_field('title');
            $text   = get_sub_field('text');
            $show_button = (get_sub_field('show_event_button') === 'yes');
            $btn_link = get_field('event_button_link');
            $btn_text = get_field('event_button_text');

            $has_bg  = ($bg_on && $bg_img);
            $classes = 'txt';

            if ($has_bg) {
            $classes .= ' bm-purple';
            }
            ?>
            <section class="<?php echo esc_attr($classes); ?>">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-lg-12 mx-auto">
                    <?php if ($title) : ?>
                      <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <div>
                      <?php echo wp_kses_post($text); ?>
                    </div>
                  </div>

                  <?php if ($show_button && $btn_link && $btn_text) : ?>
                    <div class="col-12 col-lg-7 mx-auto">
                      <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-green ga-event" style="margin-left:auto;max-width:250px;margin-right:auto;display:block;margin-bottom:20px;">
                        <?php echo esc_html($btn_text); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </section>

          <?php elseif (get_row_layout() === 'cta_row') : ?>
            <?php
              $bg_img = get_sub_field('bg_img');
              $add_image = (get_sub_field('add_image') === 'yes');
              $image = get_sub_field('image');
              $title = get_sub_field('title');
              $sub   = get_sub_field('sub_title');
              $add_button = (get_sub_field('add_button') === 'yes');
              $btn_link   = get_sub_field('button_link');
              $btn_text   = get_sub_field('button_text');
            ?>
            <section class="cta-banner text-center bm-beige">
              <div class="container">
                <div class="row">

                  <?php if ($add_image) : ?>
                    <div class="col-8 col-md-6 ml-auto">
                      <?php if (!empty($image)) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      <?php endif; ?>
                    </div>

                    <div class="col-12 w-image col-md-6" style="text-align:left;">
                      <div>
                        <?php if ($title) : ?><h2 class="header"><?php echo esc_html($title); ?></h2><?php endif; ?>
                        <?php if ($sub)   : ?><p class="regular"><?php echo esc_html($sub); ?></p><?php endif; ?>

                        <?php if ($add_button && $btn_link && $btn_text) : ?>
                          <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-green" tabindex="0"><?php echo esc_html($btn_text); ?></a>
                        <?php endif; ?>
                      </div>
                    </div>

                  <?php else : ?>
                    <div class="col-12">
                      <?php if ($title) : ?><h2 class="header"><?php echo esc_html($title); ?></h2><?php endif; ?>
                      <?php if ($sub)   : ?><p class="regular"><?php echo esc_html($sub); ?></p><?php endif; ?>

                      <?php if ($add_button && $btn_link && $btn_text) : ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-green" tabindex="0"><?php echo esc_html($btn_text); ?></a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </section>

          <?php elseif (get_row_layout() === 'speakers') : ?>
            <?php
              $title = get_sub_field('title');
            ?>
            <section class="txt hosts bm-pink">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-md-12 mx-auto">
                    <?php if ($title) : ?>
                      <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if (have_rows('speaker')) : ?>
                      <?php while (have_rows('speaker')) : the_row(); ?>

                        <?php if (get_sub_field('is_bm_staff') === 'yes') : ?>
                          <?php
                            $staff = get_sub_field('blake_morgan_staff');
                            if ($staff) :
                              $orig_post = $post;
                              $post = $staff;
                              setup_postdata($post);
                              $details_post = get_field('contact_details');
                          ?>
                            <?php if (!empty($details_post)) : ?>
                              <div class="row regional-info mx-auto">
                                <div class="col-6 col-lg-3" style="background:url('<?php echo esc_url($details_post['img']); ?>') 50%/cover no-repeat; min-height:200px; max-height:200px; margin-bottom:20px;"></div>
                                <div class="col-lg-8 mx-auto">
                                  <h4 style="margin-top:0;"><?php echo esc_html($details_post['first_name'] . ' ' . $details_post['last_name']); ?></h4>
                                  <p><?php echo esc_html($details_post['job_title']); ?></p>
                                  <?php echo wp_kses_post(get_sub_field('speaker_bio')); ?>
                                </div>
                              </div>
                            <?php endif; ?>

                          <?php
                              wp_reset_postdata();
                              $post = $orig_post;
                            endif;
                          ?>

                        <?php else : ?>
                          <div class="row regional-info mx-auto">
                            <div class="col-6 col-lg-3" style="background:url('<?php echo esc_url(get_sub_field('external_speaker_photo')); ?>') 50%/cover no-repeat; min-height:200px; max-height:200px; margin-bottom:20px;"></div>
                            <div class="col-lg-8 mx-auto">
                              <h4 style="margin-top:0;"><?php echo esc_html(get_sub_field('external_speaker_name')); ?></h4>
                              <p><?php echo esc_html(get_sub_field('external_speaker_title')); ?></p>
                              <?php echo wp_kses_post(get_sub_field('speaker_bio')); ?>
                            </div>
                          </div>
                        <?php endif; ?>

                      <?php endwhile; ?>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            </section>

          <?php endif; ?>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </article>
</section>
