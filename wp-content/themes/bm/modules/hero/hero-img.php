<?php
$banner = get_field('banner_section');
if ( empty($banner) ) return;

if ( ($banner['image_or_video'] ?? 'img') !== 'img' ) return;

$bg          = $banner['background_image'] ?? '';
$title       = $banner['title'] ?? '';
$sub         = $banner['sub_title'] ?? '';
$text_colour = $banner['text_colour'] ?? 'light'; // light | dark

$side_img = $banner['ft_image'] ?? null;
$img_align = $banner['ft_image_alignment'] ?? 'center';

// Map alignment choice to Bootstrap utility classes
// Keep row align-items-center so left text stays centred.
// align image col
$img_col_align_class = match ($img_align) {
  'top'    => 'align-self-md-start',
  'bottom' => 'align-self-md-end',
  default  => '',
};
// align section
$section_align_class = match ($img_align) {
  'top'    => 'hero--align-top',
  'bottom' => 'hero--align-bottom',
  default  => '',
};

$img_col_text_class = match ($img_align) {
  'left'   => 'text-md-start',
  'center' => 'text-md-center',
  'right'  => 'text-md-end',
  default  => 'text-md-end',
};

// Normalise background if ACF returns an array
if ( is_array($bg) && !empty($bg['url']) ) {
  $bg = $bg['url'];
}

$has_text  = ($title || $sub);
$has_image = (is_array($side_img) && !empty($side_img['url']));
?>
<section
  class="hero img-banner hero--<?php echo esc_attr($text_colour); ?> <?php echo esc_attr($section_align_class); ?>"
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
        <div class="col-12 col-md-5 mt-4 mt-md-0 text-center <?php echo esc_attr(trim($img_col_text_class . ' ' . $img_col_align_class)); ?>">
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