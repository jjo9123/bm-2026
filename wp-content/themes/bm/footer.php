<?php b4st_footer_before();?>

<footer id="footer" class="pt-5 pb-4 bm-purple">
  <?php if(is_active_sidebar('footer-widget-area')): ?>
    <div class="row pt-5 pb-4" id="footer" role="navigation">
      <?php dynamic_sidebar('footer-widget-area'); ?>
    </div>
  <?php endif; ?>

  <section class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-9 footer-socials">
          <?php if( get_field('office_show', 'option') == 'yes' ): ?>
            <div class="footer-links">
              <h3>
                <?php the_field('office_heading', 'option'); ?>
              </h3>

              <?php
                $posts = get_field('offices', 'option');
                if( $posts ):
              ?>
              <ul class="footer-locations sitemap-nav">
                <?php foreach( $posts as $post): ?>
                  <?php setup_postdata($post); ?>

                  
                    <li>
                      <a href="<?php the_permalink(); ?>#contact-footer">
                        <?php the_title(); ?>
                      </a>
                    </li>
                  

                  <?php wp_reset_postdata(); ?>
                <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          

          <?php
            $posts = get_field('q_links', 'option');
            if( $posts ):
          ?>
            <div class="footer-links">
              <h3>
                Quicklinks:
              </h3>
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
            </div>
          <?php endif; ?>

          <?php
            $posts = get_field('links', 'option');
            if( $posts ):
          ?>
            <ul class="sitemap-nav privacy">
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
            <div class="col-12 col-md-3 footer-mid">
              <img 
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/BM_Logo_white.svg"
                alt="Blake Morgan Logo"
                width="160"
              >
              <!--<img src="https://www.blakemorgan.co.uk/wp-content/uploads/Unorganized/bm-pride-logo-1-scaled.png" class="footer-logo" alt="Blake Morgan Footer Logo" width="150">-->
            </div>
          </div>

          <?php if( get_field('newsletter_show', 'option') == 'yes' ): ?>
            <div class="newsletter-signup">
              <?php if( get_field('form_or_button', 'option') == 'form' ): ?>
                <h3 style="color: #32204c;">Newsletter Signup:</h3>
                <?php gravity_form(3, false, false, false, '', true, 12); ?>
              <?php else: ?>
                <a href="<?php the_field('news_button_link', 'option'); ?>" target="_blank" class="btn btn-purple header" data-name="Newsletter">Sign up to our newsletter</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

                
        
      <div class="container legal pb-4 pt-4">
      <div class="row align-items-center">
        <div class="col-12 col-md-10">
          <p>&copy; Blake Morgan <?php echo date('Y'); ?>. All Rights reserved.</p>
        </div>
          <?php if( get_field('social_show', 'option') == 'yes' ): ?>
            <div class="col-12 col-md-2">
            <div class="social-links pt-3 pt-md-0">

              <div class="social-icons ">
                <?php if( get_field('social_fb', 'option') ): ?>
                  <a href="<?php the_field('social_fb', 'option'); ?>" target="_blank" rel="noopener" aria-label="Visit Our Facebook.com Profile (opens in a new tab)">
                    
                    <img 
                      src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/fb.svg" alt="Follow Blake Morgan on Facebook"
                    >                
                  </a>
                <?php endif; ?>

                <?php if( get_field('social_li', 'option') ): ?>
                  <a href="<?php the_field('social_li', 'option'); ?>" target="_blank" rel="noopener" aria-label="Visit Our LinkedIn.com Profile (opens in a new tab)">
                      <img 
                      src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/linkedin.svg" alt="Follow Blake Morgan on LinkedIn"
                      >                  
                    </a>
                <?php endif; ?>

                <?php if( get_field('social_tw', 'option') ): ?>
                  <a href="<?php the_field('social_tw', 'option'); ?>" target="_blank" rel="noopener" aria-label="Visit Our X.com Profile (opens in a new tab)">
                    <img 
                      src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/x-icon.svg" alt="Follow Blake Morgan on X.com"
                    >
                  </a>
                <?php endif; ?>
                </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

      <div class="container pt-4">
      <div class="row text-center disclaimer" style="padding-top: 15px;">
        <div class="col-12 col-lg-3">
          <!-- Start of SRA Digital Badge code -->
          <div class="footer-sra">
            <div style="position: relative;padding-bottom: 69.1%;height: auto;overflow: hidden;"><iframe style="border: 0px;margin: 0px;padding: 0px;backgroundcolor: transparent;top: 0px;left: 0px;width: 100%;height: 100%;position: absolute;" 
            title="SRA Digital Compliance Badge for Blake Morgan"
            src="https://cdn.yoshki.com/iframe/55845r.html"
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

<!--<section role="region" aria-label="Cookie preferences">
  <div id="cookiebtn">
    <a id="cookiechange" role="button" tabindex="0" onclick="Cookiebot.show();" onkeydown="if(event.key === 'Enter' || event.key === ' ') { Cookiebot.show(); event.preventDefault(); }">Change your cookie consent</a>
  </div>
</section>-->

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

  /*$( "#cookiechange" ).click(function() {
    setTimeout(
      function() {
        Cookiebot.withdraw();
      },
      300);
  });

}(jQuery));*/


 /*jQuery('.home-slider').slick({
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
 });*/
})(jQuery);
</script>




<?php b4st_footer_after();?>
<?php b4st_bottomline();?>
<?php wp_footer(); ?>


 <!-- <// ?php if( is_page( array( 758 ) ) ): ?>
  <div id="careers-modal" class="modal hide fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contacting Blake Morgan</h5>

          <button type="button" class="close cookie" data-dismiss="modal">×</button>
        </div>

        <div class="modal-body">
          <p>We are currently experiencing issues with our telephone system, which we are working hard to resolve. In the meantime, please call your usual contact's mobile number or the main switchboard on 023 8090 8090 who will be able to assist.</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger cookie" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(factory){if(typeof define==='function'&&define.amd){define(['jquery'],factory);}else{factory(jQuery);}}(function($){var pluses=/\+/g;function encode(s){return config.raw?s:encodeURIComponent(s);}
    function decode(s){return config.raw?s:decodeURIComponent(s);}
    function stringifyCookieValue(value){return encode(config.json?JSON.stringify(value):String(value));}
    function parseCookieValue(s){if(s.indexOf('"')===0){s=s.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,'\\');}
    try{s=decodeURIComponent(s.replace(pluses,' '));return config.json?JSON.parse(s):s;}catch(e){}}
    function read(s,converter){var value=config.raw?s:parseCookieValue(s);return $.isFunction(converter)?converter(value):value;}
    var config=$.cookie=function(key,value,options){if(value!==undefined&&!$.isFunction(value)){options=$.extend({},config.defaults,options);if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setTime(+t+days*864e+5);}
    return(document.cookie=[encode(key),'=',stringifyCookieValue(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''));}
    var result=key?undefined:{};var cookies=document.cookie?document.cookie.split('; '):[];for(var i=0,l=cookies.length;i<l;i++){var parts=cookies[i].split('=');var name=decode(parts.shift());var cookie=parts.join('=');if(key&&key===name){result=read(cookie,value);break;}
    if(!key&&(cookie=read(cookie))!==undefined){result[name]=cookie;}}
    return result;};config.defaults={};$.removeCookie=function(key,options){if($.cookie(key)===undefined){return false;}
    $.cookie(key,'',$.extend({},options,{expires:-1}));return!$.cookie(key);};}));
  </script>

  <// ?php $bm_careers = 'bm_careers'; if (!isset($_COOKIE[$bm_careers])): ?>
    <script>
      jQuery(window).on('load',function(){
          jQuery('#careers-modal').modal('show');
          jQuery('.cookie').click(function() {
            jQuery.cookie('bm_careers', 'yes', {expires: 7, path: '/'})
          });
      });
    </script>
  <// ?php endif; ?>

<// ?php endif; ?> -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  // Remove all inline scripts that contain .textareaCount(
  document.querySelectorAll("script").forEach(function(script) {
    const code = script.textContent || script.innerText || "";
    if (code.includes(".textareaCount(")) {
      // Removed rogue textareaCount script
      script.remove();
    }
  });

  // Optional: replace with a safe fallback so calls don't throw
  if (!jQuery.fn.textareaCount) {
    jQuery.fn.textareaCount = function() {
      return this;
    };
  }
});
</script>
</body>
</html>
