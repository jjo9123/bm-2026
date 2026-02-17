<?php
$header_choice  = get_field('header_choice');      // slider | banner | none
$banner_section = get_field('banner_section');
$slider_section = get_field('header_section');

if ( empty($header_choice) || $header_choice === 'none' ) {
  return;
}
?>

<style>
  /* Default hero text colour (fallback for old pages) */
  .hero,
  .home-slide {
    color: #fff;
  }

  .hero h1,
  .hero p,
  .home-slide h1,
  .home-slide p {
    color: #fff;
  }
</style>

<?php
if ( $header_choice === 'slider' && ! empty($slider_section) ) {
  get_template_part('modules/hero/hero-slider');
  return;
}

if ( $header_choice === 'banner' && ! empty($banner_section) ) {

  // ACF safety: default to img if missing/empty/unexpected
  $type = $banner_section['image_or_video'] ?? 'img';
  if ( ! in_array($type, ['img', 'video', 'colour'], true) ) {
    $type = 'img';
  }

  if ( $type === 'video' ) {
    get_template_part('modules/hero/hero-video');
    return;
  }

  if ( $type === 'colour' ) {
    get_template_part('modules/hero/hero-colour');
    return;
  }

  // default
  get_template_part('modules/hero/hero-img');
}
