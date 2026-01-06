<?php
  $slider_section = get_field('header_section');
  $banner_section = get_field('banner_section'); ?>

<?php if( $banner_section OR $slider_section ): ?>

  <?php if( get_field('header_choice') == 'slider'):
    if( have_rows('header_section') ): while ( have_rows('header_section') ) : the_row();
      if( have_rows('slides') ): ?>
          <section class="hero slider text-center">
            <div class="home-slider">
              <?php $count = 0; ?>
              <?php while ( have_rows('slides') ) : the_row(); ?>
                <div class="home-slide" style="background: url('<?php echo the_sub_field('background_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
                  <div class="container">
                    <div class="row">
                      <div class="col-12 col-lg-10 mx-auto">
                        <?php if ($count == 0): ?>
                          <h1 class="header"><?php echo the_sub_field('title'); ?></h1>
                        <?php else: ?>
                          <p><?php echo the_sub_field('title'); ?></p>
                        <?php endif; ?>

                        <p class="regular"><?php echo the_sub_field('sub_title'); ?></p>

                        <?php if( get_sub_field('add_button') == 'yes' ): ?>
                          <a href="<?php echo the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php echo the_sub_field('button_text'); ?></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $count++; ?>
              <?php endwhile; ?>
              </div>
            </section>

          <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>

  <?php elseif( get_field('header_choice') == 'none'): ?>

  <?php elseif( get_field('header_choice') == 'banner'): ?>

    <?php if( $banner_section['image_or_video'] == 'img'): ?>
    <section class="hero text-center" style="<?php if( $banner_section['background_image'] ): ?>background: url('<?php echo $banner_section['background_image']; ?>') 50%/cover no-repeat; color: #FFFFFF;<?php else: ?>background-color:#e7e7e7;<?php endif; ?>">
      <div class="container">
        <div class="row">
          <div class="col-12">
              
          <?php if( !$banner_section['title'] and !$banner_section['sub_title'] ): ?>

              <style>
                section.hero {
                  padding: 145px 0;
                }
              </style>
            <?php else: ?>

              <h1 class="header"><?php echo $banner_section['title']; ?></h1>

              <p><?php echo $banner_section['sub_title']; ?></p>



          <?php endif; ?>

            <?php if( $banner_section['add_button'] == 'yes' ):

                 if( $banner_section['jump_to_bottom'] == 'yes' ): ?>
                   <a href="#contact-footer" class="btn btn-green header test" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>


                  <?php elseif( $banner_section['btn_choice'] == 'embed' ): ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalvideo" class="btn btn-herovid btn-green header" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>


                   <?php elseif( $banner_section['btn_choice'] == 'link' ): ?>
                     <?php if ( $banner_section['btn_txt'] ): ?>
                       <a href="<?php echo $banner_section['btn_link']; ?>" class="btn btn-hero btn-green header" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>
                     <?php endif; ?>


                   <?php elseif( $banner_section['btn_choice'] == 'external' ): ?>
                    <a href="<?php echo $banner_section['external_link']; ?>" class="btn btn-hero btn-green header" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>


                  <?php endif; ?>


            <?php endif; ?>

          </div>
        </div>
      </div>
    </section>

    <?php elseif( $banner_section['image_or_video'] == 'video'): ?>

    <section class="hero text-center" style="padding: 0;">
      <div class="video-container">
        <div class="filter"></div>

        <div class="hero-video-txt container-responsive">
          <div class="row">
            <div class="col-12">
                <h1 class="header"><?php echo $banner_section['title']; ?></h1>

                <p><?php echo $banner_section['sub_title']; ?></p>

              <?php if( $banner_section['add_button'] == 'yes' ): ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalvideo" data-src="<?php echo $banner_section['video_link']; ?>" class="btn btn-herovid btn-green header" tabindex="0"><?php echo $banner_section['btn_txt']; ?></a>
              <?php endif; ?>

            </div>
          </div>
        </div>

        <?php if( $banner_section['image_or_video'] == 'video'): ?>
          <video preload="auto" autoplay loop class="fillWidth fadeIn animated" <!--poster="<?php echo $banner_section['background_image']; ?>"-->>
            <source src="<?php echo $banner_section['bg_video']; ?>" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.
          </video>
        <?php endif; ?>

        <div class="poster hidden"></div>
      </div>
    </section>

    <!-- <div id="myModalvideo1" class="modal fade in" tabindex="-1" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal">×</button>
          </div>

          <div class="modal-body">
            <iframe class="vimeo" src="" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div> -->

    <div id="myModalvideo" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
          <div class="cookieconsent-optout-marketing" style="background:#fff; text-align: center; padding-top: 15px;">
            <p>Please <a href="javascript:Cookiebot.renew()">accept marketing-cookies</a> to watch this video.</p>
          </div>
          <?php echo $banner_section['video_embed']; ?>

        </div>
      </div>
    </div>

    <script>
    var videoSrc = jQuery("#myModalvideo iframe").attr("data-src");

    jQuery('#myModalvideo').on('show.bs.modal', function () { // on opening the modal
      // set the video to autostart
      jQuery("#myModalvideo iframe").attr("data-src", videoSrc+"&amp;autoplay=1");
    });

    jQuery("#myModalvideo").on('hidden.bs.modal', function (e) { // on closing the modal
      // stop the video
      jQuery("#myModalvideo iframe").attr("data-src", null);
    });
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
				background-image: url('<?php echo $banner_section['background_image']; ?>');
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
        color: white;
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

    <?php endif; ?>


  <?php  endif; ?>
<?php endif; ?>
