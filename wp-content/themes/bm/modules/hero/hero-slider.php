<?php
if ( ! have_rows('header_section') ) return;

while ( have_rows('header_section') ) : the_row();

  if ( ! have_rows('slides') ) continue;
  ?>
  <section class="hero slider">
    <div class="home-slider">
      <?php
      $count = 0;

      while ( have_rows('slides') ) : the_row();
        $bg          = get_sub_field('background_image');
        $title       = get_sub_field('title');
        $sub_title   = get_sub_field('sub_title');

        $text_colour = get_sub_field('text_colour') ?: 'light'; // light | dark

        $add_btn     = (get_sub_field('add_button') === 'yes');
        $btn_link    = get_sub_field('button_link');
        $btn_text    = get_sub_field('button_text');
        ?>
        <div
          class="home-slide hero--<?php echo esc_attr($text_colour); ?>"
          style="background: url('<?php echo esc_url($bg); ?>') 50%/cover no-repeat;"
        >
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-7">

               <?php if ( is_front_page() ) : // if homepage don't show h1 here?>
                    <p class="header"><?php echo wp_kses_post( $title ); ?></p>
                <?php else : ?>

                <?php if ( $count === 0 ) : ?>
                    <h1 class="header"><?php echo wp_kses_post( $title ); ?></h1>
                <?php else : ?>
                    <p class="header"><?php echo wp_kses_post( $title ); ?></p>
                <?php endif; ?>

                <?php endif; ?>


                <?php if ( $sub_title ) : ?>
                  <p class="regular"><?php echo esc_html($sub_title); ?></p>
                <?php endif; ?>
                

                <?php if ( $add_btn && $btn_link && $btn_text ) : ?>
                  <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-green header" tabindex="0">
                    <?php echo esc_html($btn_text); ?>
                  </a>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
        <?php
        $count++;
      endwhile;
      ?>
    </div>
  </section>
  <?php
endwhile;