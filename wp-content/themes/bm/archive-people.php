<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="blog post-type-archive-people">

    <section class="hero bm-pink">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">Our people</h1>

          </div>
        </div>
      </div>
    </section>

    <section class="staff-details people-listing">

        <div class="container">
          <div class="row">
              <div class="col-12 blog-filter text-center bm-purple">
                <h2>Search the directory</h2>

                <div class="alphabet">
                  <a href="/people/?query=a">A</a>
                  <a href="/people/?query=b">B</a>
                  <a href="/people/?query=c">C</a>
                  <a href="/people/?query=d">D</a>
                  <a href="/people/?query=e">E</a>
                  <a href="/people/?query=f">F</a>
				  <a href="/people/?query=g">G</a>
                  <a href="/people/?query=h">H</a>
                  <a href="/people/?query=i">I</a>
                  <a href="/people/?query=j">J</a>
                  <a href="/people/?query=k">K</a>
                  <a href="/people/?query=l">L</a>
                  <a href="/people/?query=m">M</a>
                  <a href="/people/?query=n">N</a>
                  <a href="/people/?query=o">O</a>
                  <a href="/people/?query=p">P</a>
                  <a href="/people/?query=q">Q</a>
                  <a href="/people/?query=r">R</a>
                  <a href="/people/?query=s">S</a>
                  <a href="/people/?query=t">T</a>
                  <a href="/people/?query=u">U</a>
                  <a href="/people/?query=v">V</a>
                  <a href="/people/?query=w">W</a>
                  <a href="/people/?query=x">X</a>
                  <a href="/people/?query=y">Y</a>
                  <a href="/people/?query=z">Z</a>
                </div>
              </div>
            </div>


                <div class="row search bm-purple pb-3">
                  <div class="col-12 col-md-10 mx-auto">
                    <?php echo do_shortcode('[searchandfilter id="680"]'); ?>

                  </div>

                </div>
        </div>




      <div class="container news bm-white">
        <h2 class="mt-5">Directory</h2>

        <?php get_template_part('loops/people-loop'); ?>
      </div>
    </section>


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
  <// ?php endif; ?> -->

<?php
  b4st_main_after();
  get_footer();
?>
