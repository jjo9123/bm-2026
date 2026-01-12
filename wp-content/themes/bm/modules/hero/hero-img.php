<?php
$banner = get_field('banner_section');
if ( empty($banner) ) return;

if ( ($banner['image_or_video'] ?? 'img') !== 'img' ) return;

$bg          = $banner['background_image'] ?? '';
$title       = $banner['title'] ?? '';
$sub         = $banner['sub_title'] ?? '';
$text_colour = $banner['text_colour'] ?? 'light'; // light | dark

$has_text = ($title || $sub);
?>
<section
  class="hero hero--<?php echo esc_attr($text_colour); ?>"
  style="<?php
    if ( $bg ) {
      echo "background: url('" . esc_url($bg) . "') 50%/cover no-repeat;";
    } else {
      echo "background-color:#e7e7e7;";
    }
  ?>"
>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7">

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
    </div>
  </div>
</section>
