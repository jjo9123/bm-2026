<?php
/**
 * Blog Index Hero (uses Options page fields)
 */

$slider_section = get_field('header_section', 'option');
$banner_section = get_field('banner_section', 'option');
$header_choice  = get_field('header_choice', 'option'); // slider | banner | none

if ( empty($header_choice) || $header_choice === 'none' ) {
  return;
}

if ( empty($slider_section) && empty($banner_section) ) {
  return;
}

// SLIDER
if ( $header_choice === 'slider' && have_rows('header_section', 'option') ) :

  while ( have_rows('header_section', 'option') ) : the_row();

    if ( have_rows('slides') ) : ?>
      <section class="hero slider">
        <div class="home-slider">
          <?php $count = 0; ?>

          <?php while ( have_rows('slides') ) : the_row();

            $bg    = get_sub_field('background_image');
            $title = get_sub_field('title');
            $sub   = get_sub_field('sub_title');
            $bg_class = get_sub_field('bg_colour') ?: 'bm-purple';


            $btn_on   = (get_sub_field('add_button') === 'yes');
            $btn_url  = get_sub_field('button_link');
            $btn_text = get_sub_field('button_text');
          ?>
            <div class="home-slide <?php echo esc_attr($bg_class); ?>">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-md-7">

                    <?php if ( $count === 0 ) : ?>
                      <h1 class="header"><?php echo wp_kses_post($title); ?></h1>
                    <?php else : ?>
                      <p class="header"><?php echo wp_kses_post($title); ?></p>
                    <?php endif; ?>

                    <?php if ( $sub ) : ?>
                      <p class="regular"><?php echo wp_kses_post($sub); ?></p>
                    <?php endif; ?>

                    <?php if ( $btn_on && $btn_url && $btn_text ) : ?>
                      <a
                        href="<?php echo esc_url($btn_url); ?>"
                        class="btn btn-green"
                        tabindex="0"
                        data-name="<?php echo esc_attr(wp_strip_all_tags($title)); ?>"
                      >
                        <?php echo esc_html($btn_text); ?>
                      </a>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            </div>

            <?php $count++; ?>
          <?php endwhile; ?>

        </div>
      </section>
    <?php endif;

  endwhile;

  return;
endif;

// BANNER (image only)
if ( $header_choice === 'banner' && is_array($banner_section) ) :

  $type  = $banner_section['image_or_video'] ?? 'img';
  if ( $type !== 'img' ) return;

  $bg    = $banner_section['background_image'] ?? '';
  $bg_class = $banner_section['bg_colour'] ?? 'bm-purple';
  $title = $banner_section['title'] ?? '';
  $sub   = $banner_section['sub_title'] ?? '';

  $btn_on   = (($banner_section['add_button'] ?? '') === 'yes');
  $btn_url  = $banner_section['btn_link'] ?? '';
  $btn_text = $banner_section['btn_txt'] ?? '';
  ?>
  <section class="hero <?php echo esc_attr($bg_class); ?>">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">

          <?php if ( $title ) : ?>
            <h1 class="header"><?php echo wp_kses_post($title); ?></h1>
          <?php endif; ?>

          <?php if ( $sub ) : ?>
            <p><?php echo wp_kses_post($sub); ?></p>
          <?php endif; ?>

          <?php if ( $btn_on && $btn_url && $btn_text ) : ?>
            <a href="<?php echo esc_url($btn_url); ?>" class="btn btn-green header" tabindex="0">
              <?php echo esc_html($btn_text); ?>
            </a>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
