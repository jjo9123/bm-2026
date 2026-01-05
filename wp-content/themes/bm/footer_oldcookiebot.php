<?php b4st_footer_before();?>

<footer id="footer" class="mt-5 mb-4 bg-light">
  <?php if(is_active_sidebar('footer-widget-area')): ?>
    <div class="row pt-5 pb-4" id="footer" role="navigation">
      <?php dynamic_sidebar('footer-widget-area'); ?>
    </div>
  <?php endif; ?>

  <section class="footer" style="background-color: #ffffff;">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mx-auto footer-socials">
          <?php if( get_field('social_show', 'option') == 'yes' ): ?>
            <div class="social-links">
              <h6 style="color: #32204c;">
                <?php the_field('social_heading', 'option'); ?>
              </h6>

              <div class="social-icons">
                <?php if( get_field('social_fb', 'option') ): ?>
                  <a href="<?php the_field('social_fb', 'option'); ?>">
                    <img src="/wp-content/themes/bm/theme/img/fb-icon.png" alt="facebook">
                  </a>
                <?php endif; ?>

                <?php if( get_field('social_li', 'option') ): ?>
                  <a href="<?php the_field('social_li', 'option'); ?>">
                    <img src="/wp-content/themes/bm/theme/img/linkedin-icon.png" alt="linkedin">
                  </a>
                <?php endif; ?>

                <?php if( get_field('social_tw', 'option') ): ?>
                  <a href="<?php the_field('social_tw', 'option'); ?>">
                    <img src="/wp-content/themes/bm/theme/img/x-icon.png" alt="x logo">
                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if( get_field('newsletter_show', 'option') == 'yes' ): ?>
            <div class="newsletter-signup">
              <?php if( get_field('form_or_button', 'option') == 'form' ): ?>
                <h6 style="color: #32204c;">Newsletter Signup:</h6>
                <?php gravity_form(3, false, false, false, '', true, 12); ?>
              <?php else: ?>
                <a href="<?php the_field('news_button_link', 'option'); ?>" target="_blank" class="btn btn-purple header" data-name="Newsletter">Sign up to our newsletter</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-12 col-md-4 mx-auto footer-mid">
          <?php if( get_field('middle_show', 'option') == 'yes' ): ?>
            <img src="/wp-content/themes/bm/theme/img/bmfooter-logo.png" class="footer-logo" alt="Blake Morgan Footer Logo" width="150">

            <?php the_field('middle_email', 'option'); ?>

            <?php $post_object = get_field('middle_btnmodal', 'option');
              if( $post_object ):
              $post = $post_object;
              setup_postdata( $post );
            ?>
              <div class="arrange-call">
                <a href="javascript:void(0)" class="btn btn-purple header" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>" data-name="Arrange a Call">
                  <?php the_field('middle_btntxt', 'option'); ?>
                </a>
              </div>

              <?php get_template_part('modules/modal'); ?>

              <?php wp_reset_postdata(); ?>
            <?php endif;
          endif; ?>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mx-auto footer-contact">


          <?php if( get_field('office_show', 'option') == 'yes' ): ?>
            <div class="footer-contact-locations">
              <h6 style="color: #32204c;">
                <?php the_field('office_heading', 'option'); ?>
              </h6>

              <?php
                $posts = get_field('offices', 'option');
                if( $posts ):
              ?>
                <?php foreach( $posts as $post): ?>
                  <?php setup_postdata($post); ?>

                  <ul class="footer-locations">
                    <li>
                      <a href="<?php the_permalink(); ?>#contact-footer">
                        <?php the_title(); ?>
                      </a>
                    </li>
                  </ul>

                  <?php wp_reset_postdata(); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-12 mx-auto text-center">
          <p>&copy; Blake Morgan <?php echo date('Y'); ?>. All Rights reserved.</p>

          <?php
            $posts = get_field('links', 'option');
            if( $posts ):
          ?>

            <ul class="sitemap-nav">
              <?php foreach( $posts as $post): ?>
                <?php setup_postdata($post); ?>

                <li>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </li>

                <?php wp_reset_postdata(); ?>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>

      <div class="row text-center disclaimer" style="padding-top: 15px;">
        <div class="col-12 col-lg-3">
          <!-- Start of SRA Digital Badge code -->
          <div class="footer-sra">
            <div style="position: relative;padding-bottom: 69.1%;height: auto;overflow: hidden;"><iframe style="border: 0px;margin: 0px;padding: 0px;backgroundcolor: transparent;top: 0px;left: 0px;width: 100%;height: 100%;position: absolute;" src="https://cdn.yoshki.com/iframe/55845r.html"
                frameborder="0" scrolling="no"></iframe></div>
          </div>
          <!-- End of SRA Digital Badge code -->
        </div>
        <div class="col-12 col-lg-8">
          <?php echo the_field('smallprint', 'option'); ?>
        </div>
      </div>
    </div>
  </section>
</footer>


<?php if( is_page( array( 776, 4395, 4400, 4406, 4424, 4426, 5804 ) ) ): ?>
  <div id="careers-modal" class="modal hide fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Applicant Privacy Notice</h5>
          <button type="button" class="close cookie" data-dismiss="modal">×</button>
        </div>

        <div class="modal-body">
          <p>Blake Morgan takes data protection and privacy very seriously and we ask that you read our <a href="/wp-content/uploads/Downloads/Applicant-Privacy-Notice-01.07.20.pdf" target="_blank">privacy notice</a> to understand how we will treat, the information you give us in connection with your application.</p>
        </div>

        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger cookie" data-dismiss="modal">Accept</button>-->
        </div>
      </div>
    </div>
  </div>

  <script>
    jQuery(document).ready(function() {
      if (jQuery.cookie('bm_careers') == 'yes') {

      } else {
        jQuery('body').addClass('scroll-bg');
        jQuery('#careers-modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        jQuery('.cookie').click(function() {
          jQuery.cookie('bm_careers', 'yes', {expires: 1, path: '/' });
        });
      };
    });
  </script>
<?php endif; ?>


<div class="modal fade text-left" id="btn-cta-modal-365" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="modal-copy">
          <h4 class="white">HOW CAN WE HELP?</h4>

          <p>To get in touch with one of our legal experts please fill in your details.</p>

          <img src="/wp-content/uploads/2019/02/logo-white.png" alt="Blake Morgan Logo" style="bottom: 20px; max-width: 180px; position: absolute;">
        </div>

        <div class="modal-form">
          <?php
            gravity_form_enqueue_scripts('2', true);
            gravity_form('2', false, false, false, '', true, 1);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>



<?php if( get_field('sos_enable', 'option') == 'yes' ): ?>
  <div id="sos-modal" class="modal hide fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <h5 class="modal-title" style="font-size: 1.5rem;"><?php the_field('sos_header', 'option'); ?></h5>
          <p style="padding-top: 30px; font-size: 1.1rem;"><?php the_field('sos_copy', 'option'); ?></p>

          <?php if( get_field('sos_btn-show', 'option') == 'yes' ): ?>
            <a href="<?php the_field('sos_btn-link', 'option'); ?>" class="btn btn-purple header cookie"><?php the_field('sos_btn-txt', 'option'); ?></a>
          <?php endif; ?>
        </div>

        <div class="modal-footer">
        <!--  <button type="button" class="btn btn-danger cookie" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>

  <style>
    #sos-modal .modal-body {
      flex-direction: column;
    }
  </style>

  <script>
    jQuery(document).ready(function() {
      jQuery('#sos-modal').modal({
        backdrop: 'static',
        keyboard: false
      });
    });
  </script>
<?php endif; ?>


<div id="cookiebtn">
  <a id="cookiechange" onclick="Cookiebot.show();">Change your cookie consent</a>
</div>

<style>
#cookiebtn {
  background-color: rgb(255, 255, 255);
  color: rgb(50, 33, 76);
  position: fixed;
  font-family: inherit;
  width: auto;
  bottom: 0px;
  right: 100px;
  font-size: 10pt;
  margin: 0;
  padding: 5px 10px;
  text-align: center;
  z-index: 9999;
  cursor: pointer;
  box-shadow: #161616 2px 2px 5px 2px;
}
#cookiebtn a {
      color: rgb(50, 33, 76);
}

#CybotCookiebotDialogBodyContentTitle {
  float: left;
  max-width: 300px;
}
#CookiebotClose {
  float: right;
  max-width: 50px;
}
#CookiebotClose a {
  text-decoration: none;
}
#CybotCookiebotDialogBodyContentText {
  clear: both;
}
</style>

<script>
(function ($) {

  'use strict';

  setTimeout(
    function() {
      jQuery('#CybotCookiebotDialogBodyContentTitle').after('<div id="CookiebotClose"><a id="CookiebotClosebtn" onclick="Cookiebot.hide();Cookiebot.withdraw();">X</a></div>');
    },
    3000);

  $( "#cookiechange" ).click(function() {
    setTimeout(
      function() {
        $('#CybotCookiebotDialogBodyContentTitle').after('<div id="CookiebotClose"><a id="CookiebotClosebtn" onclick="Cookiebot.hide();Cookiebot.withdraw();">X</a></div>');
      },
      350);
  });

  $( "#cookiechange" ).click(function() {
    setTimeout(
      function() {
        Cookiebot.withdraw();
      },
      350);
  });

  $( "#CookiebotClosebtn" ).click(function() {
    setTimeout(
      function() {
        Cookiebot.withdraw();
      },
      350);
  });

}(jQuery));


 jQuery('.home-slider').slick({
	 arrows: true,
	 dots: true,
	 infinite: true,
	 autoplay: true,
	 autoplaySpeed: 4000
 });

 jQuery('.quotes-slider').slick({
	 arrows: true,
	 dots: false,
	 infinite: true
 });

 jQuery('.highlights-slider').slick({
	 arrows: true,
	 dots: true,
	 infinite: true
 });
</script>




<?php b4st_footer_after();?>
<?php b4st_bottomline();?>
<?php wp_footer(); ?>

</body>
</html>
