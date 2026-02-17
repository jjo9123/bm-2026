<?php
$bg_class = get_sub_field('bg_colour') ?: 'bm-purple';
?>
<section class="services <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto mb-4">
        <?php $heading = get_sub_field('heading'); ?>
        <?php $txt = get_sub_field('txt'); ?>

        <?php if ($heading) : ?>
          <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($txt) : ?>
          <p><?php echo wp_kses_post($txt); ?></p>
        <?php endif; ?>
      </div>

      <?php
      $services = get_sub_field('services');
      if ($services) :
      ?>
        <div class="col-12 col-lg-10 col-xl-12 mx-auto text-left">
          <ul class="services-list row g-3 list-unstyled mb-0">
            <?php foreach ($services as $post) : setup_postdata($post); ?>
              <li class="col-12 col-md-6 col-lg-4">
                <a href="<?php the_permalink(); ?>" class="services-link">
                  
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
