<?php
/**
 * Template Name: Individual Office
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>

<style>
 .img-txt-row .row.regional-info {
  padding: 25px 0;
 }
 .img-txt-row .row.regional-info h3 {
  font-size: 1.2rem;
  margin-bottom: 20px;
 }
 section.img-txt-row {
  padding: 40px 0 60px;
 }
 section.img-txt-row .regional-info .col-lg-7 {
  padding-left: 30px;
 }


</style>

<main id="main">
  <div id="content" role="main">

  <?php get_template_part('modules/header'); ?>

  <?php get_template_part('modules'); ?>

  </div><!-- /#content -->
</main><!-- /.container -->

<!-- <div id="careers-modal" class="modal hide fade">
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
  </div> -->


<!-- <script>
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
  </script> -->



<!--   <// ?php $bm_careers = 'bm_careers'; if (!isset($_COOKIE[$bm_careers])): ?>
    <script>
      jQuery(window).on('load',function(){
          jQuery('#careers-modal').modal('show');
          jQuery('.cookie').click(function() {
            jQuery.cookie('bm_careers', 'yes', {expires: 7, path: '/'})
          });
      });
    </script> -->
  <!-- <// ?php endif; ?> -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
  const anchor = window.location.hash;

  if (anchor && anchor.startsWith("#")) {
    let attempts = 0;
    const maxAttempts = 50; // try for 5 seconds (50 × 100ms)

    const scrollToAnchor = () => {
      const target = document.querySelector(anchor);

      if (target) {
        target.scrollIntoView({ behavior: "smooth" });
      } else if (attempts < maxAttempts) {
        attempts++;
        setTimeout(scrollToAnchor, 100);
      } else {
        console.warn("Anchor not found after waiting:", anchor);
      }
    };

    scrollToAnchor();
  }
});
</script>


<?php
  b4st_main_after();
  get_footer();
?>
