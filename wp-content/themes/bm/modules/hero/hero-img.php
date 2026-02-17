<?php
$banner = get_field('banner_section');
if ( empty($banner) ) return;

if ( ($banner['image_or_video'] ?? 'img') !== 'img' ) return;

$bg          = $banner['background_image'] ?? '';
$title       = $banner['title'] ?? '';
$sub         = $banner['sub_title'] ?? '';
$text_colour = $banner['text_colour'] ?? 'light'; // light | dark

// NEW: side image (ACF image field)
$side_img = $banner['ft_image'] ?? null;

// Normalise background if ACF returns an array
if ( is_array($bg) && !empty($bg['url']) ) {
  $bg = $bg['url'];
}

$has_text  = ($title || $sub);
$has_image = (is_array($side_img) && !empty($side_img['url']));
?>
<section
  class="hero img-banner hero--<?php echo esc_attr($text_colour); ?>"
  <?php if ( $bg ) : ?>
    style="--hero-bg: url('<?php echo esc_url($bg); ?>');"
  <?php else : ?>
    style="background-color:#e7e7e7;"
  <?php endif; ?>
>

  <div class="container">
    <div class="row align-items-center">
      
      <!-- Text column -->
      <div class="col-12 <?php echo $has_image ? 'col-md-7' : 'col-md-7'; ?>">
        <?php if ( ! $has_text ) : ?>
          <style>
            section.hero { padding: 145px 0; }
          </style>
        <?php else : ?>
          <?php if ( $title ) : ?>
            <h1 class="header"><?php echo esc_html($title); ?></h1>
          <?php endif; ?>

          <?php if ( $sub ) : ?>
            <p><?php echo esc_html($sub); ?></p>
          <?php endif; ?>
        <?php endif; ?>

        <?php get_template_part('modules/hero/hero-cta'); ?>
      </div>

      <!-- Right image column (only if set) -->
      <?php if ( $has_image ) : ?>
        <div class="col-12 col-md-5 mt-4 mt-md-0 text-center text-md-end">
          <img
            class="img-fluid hero__side-image"
            src="<?php echo esc_url($side_img['url']); ?>"
            alt="<?php echo esc_attr($side_img['alt'] ?? ''); ?>"
            loading="lazy"
          >
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
