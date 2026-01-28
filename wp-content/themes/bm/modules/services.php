<section class="services text-center" style="background: #352c3f; color: #FFFFFF;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto mb-4">
        <?php $heading = get_sub_field('heading'); ?>
        <?php $txt = get_sub_field('txt'); ?>

        <?php if ($heading) : ?>
          <h2 class="white"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <hr class="heading green">

        <?php if ($txt) : ?>
          <p><?php echo wp_kses_post($txt); ?></p>
        <?php endif; ?>
      </div>

      <?php
      $services = get_sub_field('services');
      if ($services) :
      ?>
        <div class="col-12 col-lg-10 col-xl-12 mx-auto text-left">
          <ul class="row g-3 list-unstyled mb-0">
            <?php foreach ($services as $post) : setup_postdata($post); ?>
              <li class="col-12 col-md-6 col-lg-4">
                <a class="d-block py-2" href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
