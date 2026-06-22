<?php $bg_class = get_sub_field('bg_colour') ?: 'bm-purple'; ?>

<section id="intro-content" class="py-5 four-col-row <?php echo esc_attr($bg_class); ?>">
  <div class="container">

    <?php $intro = get_sub_field('intro'); ?>
    <?php if ( $intro ) : ?>
      <div class="four-col-row__intro mb-5">
        <?php echo wpautop( wp_kses_post( $intro ) ); ?>
      </div>
    <?php endif; ?>

    <?php if ( have_rows('columns') ) : ?>
      <div class="row g-4 justify-content-center">
        <?php while ( have_rows('columns') ) : the_row();

          $image = get_sub_field('img');              // Image array
          $title = get_sub_field('heading');          // Text
          $desc  = get_sub_field('txt');              // Textarea / WYSIWYG
          $link  = get_sub_field('find_out_more');    // ACF Link field (array)

          $url    = is_array($link) && !empty($link['url']) ? $link['url'] : '';
          $label  = is_array($link) && !empty($link['title']) ? $link['title'] : '';
          $target = is_array($link) && !empty($link['target']) ? $link['target'] : '_self';
          $rel    = ($target === '_blank') ? 'noopener' : '';
        ?>
          <div class="col-6 col-md-6 col-lg-3 pb-4">
            <article class="grid-col h-100 d-flex flex-column">

              <?php if ( is_array($image) && !empty($image['url']) ) : ?>
                <div class="grid-col__image mb-3">
                  <img
                    class="img-fluid w-100"
                    src="<?php echo esc_url( $image['url'] ); ?>"
                    alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
                    loading="lazy"
                  >
                </div>
              <?php endif; ?>

              <?php if ( $title ) : ?>
                <h3 class="grid-col__title mb-2">
                  <?php echo esc_html( $title ); ?>
                </h3>
              <?php endif; ?>

              <?php if ( $desc ) : ?>
                <div class="grid-col__desc mb-3">
                  <?php echo wpautop( wp_kses_post( $desc ) ); ?>
                </div>
              <?php endif; ?>

              <?php if ( $url && $label ) : ?>
                <a
                  class="btn btn-green mt-auto mt-3"
                  href="<?php echo esc_url( $url ); ?>"
                  target="<?php echo esc_attr( $target ); ?>"
                  <?php echo $rel ? 'rel="' . esc_attr($rel) . '"' : ''; ?>
                >
                  <?php echo esc_html( $label ); ?>
                </a>
              <?php endif; ?>

            </article>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
