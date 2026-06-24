<?php
$thumb      = get_the_post_thumbnail_url(get_the_ID(), 'blog-hero');

$event_date = get_field('event_date2');      // if you still want this line
$date_time  = get_field('date_time');
$location   = get_field('event_location');
$cost       = get_field('cost');

$show_btn = (get_field('add_event_button') === 'yes');
$btn_link = get_field('event_button_link');
$btn_text = get_field('event_button_text');
?>

<section class="hero hero--event bm-beige py-5">
  <div class="container">
    <div class="row align-items-center g-4">

      <!-- LEFT COLUMN -->
      <div class="col-12 col-lg-6">
        <h1 class="mb-3"><?php the_title(); ?></h1>

        <!-- Event details row -->
        <?php if ($date_time || $location || $cost) : ?>
          <dl class="hero__details mb-4">
            <?php if ($date_time) : ?>
              <div class="hero__detail">
                <dt>DATE &amp; TIME</dt>
                <dd><?php echo esc_html($date_time); ?></dd>
              </div>
            <?php endif; ?>

            <?php if ($location) : ?>
              <div class="hero__detail">
                <dt>Location</dt>
                <dd><?php echo esc_html($location); ?></dd>
              </div>
            <?php endif; ?>

            <?php if ($cost) : ?>
              <div class="hero__detail">
                <dt>Cost</dt>
                <dd><?php echo esc_html($cost); ?></dd>
              </div>
            <?php endif; ?>
          </dl>
        <?php endif; ?>

        <?php if ($show_btn && $btn_link && $btn_text) : ?>
          <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-green ga-event">
            <?php echo esc_html($btn_text); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-12 col-lg-6">
        <?php if ($thumb) : ?>
          <div class="hero__image-wrap">
            <?php echo wp_get_attachment_image(
                get_post_thumbnail_id(),
                'blog-hero',
                false,
                [
                    'class' => 'img-fluid w-100',
                    'loading' => 'eager',
                    'decoding' => 'async'
                ]
            ); ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
