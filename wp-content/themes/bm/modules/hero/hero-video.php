<?php
$banner = get_field('banner_section');
if ( empty($banner) ) return;

if ( ($banner['image_or_video'] ?? 'img') !== 'video' ) return;

$title       = $banner['title'] ?? '';
$sub         = $banner['sub_title'] ?? '';
$text_colour = $banner['text_colour'] ?? 'light'; // light | dark

$bg_video    = $banner['bg_video'] ?? '';
$poster      = $banner['background_image'] ?? '';
$video_embed = $banner['video_embed'] ?? '';
?>
<section class="hero hero--<?php echo esc_attr($text_colour); ?> text-center" style="padding: 0;">
  <div class="video-container">
    <div class="filter"></div>

    <div class="hero-video-txt container-responsive">
      <div class="row">
        <div class="col-12">

          <?php if ( $title ) : ?><h1 class="header"><?php echo esc_html($title); ?></h1><?php endif; ?>
          <?php if ( $sub ) : ?><p><?php echo esc_html($sub); ?></p><?php endif; ?>

          <?php get_template_part('modules/hero/hero-cta'); ?>

        </div>
      </div>
    </div>

    <?php if ( $bg_video ) : ?>
      <video preload="auto" autoplay loop muted playsinline class="fillWidth fadeIn animated">
        <source src="<?php echo esc_url($bg_video); ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    <?php endif; ?>

    <div class="poster hidden"></div>
  </div>
</section>

<div id="myModalvideo" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: transparent;">
      <div class="cookieconsent-optout-marketing" style="background:#fff; text-align: center; padding-top: 15px;">
        <p>Please <a href="javascript:Cookiebot.renew()">accept marketing-cookies</a> to watch this video.</p>
      </div>
      <?php echo $video_embed; ?>
    </div>
  </div>
</div>

<script>
  (function ($) {
    var $modal = $('#myModalvideo');
    var $iframe = $modal.find('iframe');

    var originalSrc = $iframe.attr('src') || $iframe.attr('data-src');

    $modal.on('show.bs.modal', function () {
      if (!$iframe.length || !originalSrc) return;
      var src = originalSrc;
      if (src.indexOf('autoplay=1') === -1) {
        src += (src.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1';
      }
      $iframe.attr('src', src);
    });

    $modal.on('hidden.bs.modal', function () {
      if (!$iframe.length) return;
      $iframe.attr('src', originalSrc || '');
    });
  })(jQuery);
</script>

<style>
  .homepage-hero-module {
    border-right: none;
    border-left: none;
    position: relative;
    min-height: 555px;
  }
  .no-video .video-container video,
  .touch .video-container video {
    display: none;
  }
  .no-video .video-container .poster,
  .touch .video-container .poster {
    display: block !important;
  }
  .video-container {
    display: flex;
    flex-direction: column;
    position: relative;
    bottom: 0%;
    left: 0%;
    height: 100%;
    width: 100%;
    overflow: hidden;
    background: #FFFFFF;
    background-image: url('<?php echo esc_url($poster); ?>');
    background-repeat: no-repeat;
    background-size: cover;
  }
  .video-container .poster img {
    width: 100%;
    bottom: 0;
    position: absolute;
  }
  .video-container .filter {
    background: rgba(0, 0, 0, 0.6);
    position: absolute;
    width: 100% !important;
    height: 100%;
    z-index: 100;
    min-height: 550px;
    margin-left: 0 !important;
  }
  .video-container .hero-video-txt {
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: auto;
    padding: 120px 0;
    position: relative;
    text-align: center;
    z-index: 100;
  }
  .video-container .hero-video-txt h1 {
    line-height: normal;
    margin-bottom: 40px;
  }
  .video-container .hero-video-txt p {
    font-size: 1.8rem;
    font-weight: 100;
  }
  .video-container video {
    position: absolute;
    z-index: 0;
    bottom: 0;
    top: -80px;
  }
  .video-container video.fillWidth {
    width: 100%;
  }

  @media (max-width: 768px) {
    .video-container video {
      display: none;
      top: 0;
    }
    .video-container video.fillWidth {
      width: 100% !important;
    }
  }

  @media (max-width: 425px) {
    .homepage-hero-module {
      max-height: 500px;
      min-height: 460px;
    }
  }
</style>
