<?php
$banner = get_field('banner_section');
if ( empty($banner) ) return;

if ( ($banner['image_or_video'] ?? '') !== 'colour' ) return;

$title       = $banner['title'] ?? '';
$sub         = $banner['sub_title'] ?? '';
$text_colour = $banner['text_colour'] ?? 'light';

$bg_class = $banner['bg_colour'] ?? 'bm-purple';

// Optional whitelist to prevent unexpected class values
$allowed = ['bm-pink', 'bm-purple', 'bm-beige'];
if ( ! in_array($bg_class, $allowed, true) ) {
  $bg_class = 'bm-purple';
}

$has_text = ($title || $sub);
?>

<section class="hero hero--<?php echo esc_attr($text_colour); ?> <?php echo esc_attr($bg_class); ?> text-center">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7">

        <?php if ( ! $has_text ) : ?>
          <style>
            section.hero { padding: 145px 0; }
          </style>
        <?php else : ?>
          <?php if ( $title ) : ?>
            <h1 class="header"><?php echo wp_kses_post($title); ?></h1>
          <?php endif; ?>

          <?php if ( $sub ) : ?>
            <p><?php echo wp_kses_post($sub); ?></p>
          <?php endif; ?>
        <?php endif; ?>

        <?php get_template_part('modules/hero/hero-cta'); ?>

      </div>
    </div>
  </div>
</section>
