<section id="pricing" class="txt">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto">

        <?php if ( have_rows('section') ) : ?>
          <?php while ( have_rows('section') ) : the_row(); ?>

            <?php $heading = get_sub_field('heading'); ?>
            <?php if ( $heading ) : ?>
              <h2><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if ( have_rows('docs') ) : ?>
              <ul class="row g-3 list-unstyled mb-4 pricing-list">
                <?php while ( have_rows('docs') ) : the_row(); ?>

                  <?php
                    $url  = get_sub_field('doc');  // url/file
                    $name = get_sub_field('name');
                    if ( empty($url) || empty($name) ) continue;
                  ?>

                  <li class="col-12 col-md-6 col-lg-4">
                    <a class="pricing-link d-block py-2" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                      <?php echo esc_html($name); ?>
                    </a>
                  </li>

                <?php endwhile; ?>
              </ul>
            <?php endif; ?>

          <?php endwhile; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>