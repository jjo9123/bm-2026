<?php
  get_header();
  b4st_main_before();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article role="article" id="post_<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
  // ACF vars
  $person            = get_field('contact_details');
  $person_intro      = get_field('intro_section');
  $additionalcontent = get_field('additional_content');
?>

<?php if ( $person ) : ?>
  <main id="main" class="blog">
    <!-- HERO -->
    <section class="hero text-center" style="background-color:#FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header green">
              <?php echo $person['first_name']; ?> <?php echo $person['last_name']; ?>
            </h1>
            <h2><?php echo $person['job_title']; ?></h2>
          </div>
        </div>
      </div>
    </section>

    <!-- STAFF DETAILS -->
    <section class="staff-details" style="background-color:#e7e7e7; padding-top:0;">
      <div class="container">
        <div class="row">
          <!-- LEFT/CENTER COLUMN -->
          <div class="col-md-7 intro-col">

            <!-- MOBILE CONTACT CARD -->
            <div class="staff-contact details mobile">
              <div class="img" style="background:url('<?php echo $person['img']; ?>') 50%/cover no-repeat; color:#FFFFFF;"></div>

              <?php if ( $person['mobile_number'] || $person['landline_number'] || $person['email_address'] || $person['twitter_link'] || $person['linkedin_link'] ) : ?>
                <div class="header"><h6>Contact details</h6></div>

                <div class="excerpt">
                  <?php if ( $person['mobile_number'] ) : ?>
                    <p class="mobile"><?php echo $person['mobile_number']; ?></p>
                  <?php endif; ?>

                  <?php if ( $person['landline_number'] ) : ?>
                    <p class="phone"><?php echo $person['landline_number']; ?></p>
                  <?php endif; ?>

                  <?php if ( $person['email_address'] ) : ?>
                    <a class="staff-email" href="mailto:<?php echo $person['email_address']; ?>?bcc=BD@blakemorgan.co.uk">
                      <p class="email">Email <?php echo $person['first_name']; ?></p>
                    </a>
                  <?php endif; ?>

                  <?php $vcard = $person['vcard']; if ( $vcard ) : ?>
                    <a href="<?php echo $vcard; ?>"><p class="vcard">Download vCard</p></a>
                  <?php endif; ?>

                  <?php if ( $person['twitter_link'] ) : ?>
                    <a href="<?php echo $person['twitter_link']; ?>"><p class="twitter">Twitter</p></a>
                  <?php endif; ?>

                  <?php if ( $person['linkedin_link'] ) : ?>
                    <a href="<?php echo $person['linkedin_link']; ?>"><p class="linkedin">LinkedIn</p></a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- INTRO -->
            <?php if ( $person_intro ) : ?>
              <div class="intro-content">
                <?php echo $person_intro['intro_text']; ?>

                <?php
                $expertise_links = $additionalcontent['expertise_links'] ?? [];

                if ( ! empty( $expertise_links ) ) :
                ?>
                  <h3>Expertise & Services</h3>
                  <ul class="styled">
                    <?php foreach ( $expertise_links as $post_ref ) :
                      // Get the post object
                      $post_obj = get_post( $post_ref );

                      // Only proceed if the post exists and is published
                      if ( $post_obj && $post_obj->post_status === 'publish' ) :
                    ?>
                      <li>
                        <a href="<?php echo esc_url( get_permalink( $post_obj ) ); ?>">
                          <?php echo esc_html( get_the_title( $post_obj ) ); ?>
                        </a>
                      </li>
                    <?php endif; endforeach; ?>
                  </ul>
                <?php endif; ?>

                <?php if ( $person_intro['add_quote'] == 'yes' ) : ?>
                  <?php if ( $person_intro['quote'] ) : ?>
                    <blockquote class="pt-5">
                      <?php echo $person_intro['quote']; ?>
                      <footer class="purple"><?php echo $person_intro['quote_by']; ?></footer>
                    </blockquote>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if ( $person_intro['career_box'] ) : ?>
                  <h3>Career</h3>
                  <?php echo $person_intro['career_box']; ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div><!-- /.intro-col -->

          <!-- RIGHT SIDEBAR -->
          <div class="col-md-4 col-xl-3 mx-auto">
            <div class="staff-contact details desktop">
              <div class="img" style="background:url('<?php echo $person['img']; ?>') 50%/cover no-repeat; color:#FFFFFF;"></div>

              <?php if ( $person['mobile_number'] || $person['landline_number'] || $person['email_address'] || $person['twitter_link'] || $person['linkedin_link'] ) : ?>
                <div class="header"><h6>Contact details</h6></div>

                <div class="excerpt">
                  <?php if ( $person['mobile_number'] ) : ?>
                    <p class="mobile"><?php echo $person['mobile_number']; ?></p>
                  <?php endif; ?>

                  <?php if ( $person['landline_number'] ) : ?>
                    <p class="phone"><?php echo $person['landline_number']; ?></p>
                  <?php endif; ?>

                  <?php if ( $person['email_address'] ) : ?>
                    <a href="mailto:<?php echo $person['email_address']; ?>?bcc=BD@blakemorgan.co.uk">
                      <p class="email">Email <?php echo $person['first_name']; ?></p>
                    </a>
                  <?php endif; ?>

                  <?php $vcard = $person['vcard']; if ( $vcard ) : ?>
                    <a href="<?php echo $vcard; ?>"><p class="vcard">Download vCard</p></a>
                  <?php endif; ?>

                  <?php if ( $person['twitter_link'] ) : ?>
                    <a href="<?php echo $person['twitter_link']; ?>"><p class="twitter">Twitter</p></a>
                  <?php endif; ?>

                  <?php if ( $person['linkedin_link'] ) : ?>
                    <a href="<?php echo $person['linkedin_link']; ?>"><p class="linkedin">LinkedIn</p></a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div><!-- /.sidebar -->
        </div><!-- /.row -->

        <!-- ACCREDITATIONS / MEMBERSHIPS -->
        <div class="row col-md-10">
          <?php if ( $person_intro['add_accreditations'] == 'yes' ) : ?>
            <?php if ( ! empty( $person_intro['accreditations'] ) ) : ?>
              <div class="col-md-5">
                <div class="staff-contact awards">
                  <div class="header"><h6>Accreditations</h6></div>
                  <div class="excerpt">
                    <div class="awards-container">
                      <?php foreach ( $person_intro['accreditations'] as $award ) : ?>
                        <img src="<?php echo $award['url']; ?>" alt="<?php echo $award['alt']; ?>" />
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ( $person_intro['add_memberships'] == 'yes' ) : ?>
            <?php if ( ! empty( $person_intro['membership_list'] ) ) : ?>
              <div class="col-md-5">
                <div class="staff-contact memberships">
                  <div class="header"><h6>Memberships</h6></div>
                  <div class="excerpt">
                    <ul>
                      <?php foreach ( $person_intro['membership_list'] as $membership ) : ?>
                        <li><?php echo esc_html( $membership['membership'] ); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.staff-details -->

    <!-- ADDITIONAL CONTENT -->
    <?php if ( $additionalcontent ) : ?>

      <?php if ( $additionalcontent['add_video'] == 'yes' ) : ?>
        <section class="video text-center pb-5" style="background-color:#e7e7e7;">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-10 mx-auto">
                <?php if ( $additionalcontent['video_title'] ) : ?>
                  <h3><?php echo $additionalcontent['video_title']; ?></h3>
                <?php endif; ?>

                <?php if ( $additionalcontent['video_description'] ) : ?>
                  <?php echo $additionalcontent['video_description']; ?>
                <?php endif; ?>

                <?php echo $additionalcontent['video_embed_code']; ?>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if ( $additionalcontent['add_list'] == 'yes' && ! empty( $additionalcontent['pull_out_list'] ) ) : ?>
        <section class="txt pull-out">
          <div class="container">
            <div class="row">
              <div class="col-md-10 mx-auto">
                <h3 class="purple">Significant Experience</h3>
                <ul class="styled">
                  <?php foreach ( $additionalcontent['pull_out_list'] as $item ) : ?>
                    <li><?php echo htmlspecialchars( $item['list_item'] ); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if ( $additionalcontent['add_expertise'] == 'yes' ) : ?>
        <?php
          $has_text  = ! empty( $additionalcontent['additional_text'] );
          $has_links = ! empty( $additionalcontent['expertise_links'] );
          if ( $has_text ) :
        ?>
          <section class="staff-expertise" style="background-color:#e7e7e7;">
            <div class="container">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <h3>Additional Expertise</h3>
                  <?php echo $additionalcontent['additional_text']; ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ( $additionalcontent['add_additional_quotes'] === 'yes' ) : ?>
        <section class="highlights people-page text-center" style="background:url('<?php echo esc_url( $additionalcontent['add_quotes_bg_image'] ); ?>') 50%/cover no-repeat; color:#FFFFFF;">
          <div class="container">
            <div class="row">
              <?php if ( ! empty( $additionalcontent['additional_quotes_heading'] ) ) : ?>
                <div class="col-12">
                  <h2><?php echo htmlspecialchars( $additionalcontent['additional_quotes_heading'] ); ?></h2>
                  <hr class="heading dpurple">
                </div>
              <?php endif; ?>

              <div class="col-10 mx-auto">
                <div class="slider highlights-slider">
                  <?php if ( ! empty( $additionalcontent['additional_quotes'] ) && is_array( $additionalcontent['additional_quotes'] ) ) : ?>
                    <?php foreach ( $additionalcontent['additional_quotes'] as $quote ) : ?>
                      <div class="highlights-slide">
                        <blockquote>
                          <?php echo wp_kses_post( $quote['quote'] ); ?>
                          <footer class="purple"><?php echo htmlspecialchars( $quote['quote_by'] ); ?></footer>
                        </blockquote>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

    <?php endif; ?><!-- /$additionalcontent -->

    <!-- RECENT POSTS (ALWAYS RUNS) -->
    <?php
      $the_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'cat'            => '-27070',
        'meta_query'     => array(
          array(
            'key'     => 'author',                          // ACF field on post that references person
            'value'   => '"' . get_the_ID() . '"',          // works for relationship fields (serialized array)
            'compare' => 'LIKE'
          )
        )
      ) );
    ?>

    <?php if ( $the_query->have_posts() ) : ?>
      <section class="blog recent" style="background:url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color:#FFFFFF;">
        <div class="container-fluid news">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="text-center">Insights by <?php echo $person['first_name']; ?></h2>
                <hr class="heading green">
              </div>

              <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php
                  $post_orig  = get_the_ID();
                  $categories = get_the_category();
                  $category   = ! empty( $categories ) ? esc_html( $categories[0]->slug ) : '';
                ?>
                <div class="col-sm-6 col-md-4 text-center item i<?php echo $category; ?>">
                  <div class="title">
                    <p><?php echo $category ? mb_strtolower( $category, 'utf8' ) : ''; ?></p>
                  </div>

                  <div class="img" style="background:url('<?php echo the_post_thumbnail_url( 'recent_fimg' ); ?>') 50%/cover no-repeat; color:#FFFFFF;"></div>

                  <div class="header">
                    <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
                  </div>

                  <div class="excerpt">
                    <?php
                      // temporarily load linked person to show their name
                      $post_object    = get_field('author');
                      $tmp_post       = $post; // backup
                      $post           = $post_object;
                      $details_recent = get_field('contact_details');
                      $post           = $tmp_post; // restore
                      setup_postdata( $post );
                    ?>
                    <div class="date">
                      <?php the_time('j F'); ?>
                      <?php if ( $post_object ) : ?> - <?php echo $details_recent['first_name']; ?> <?php echo $details_recent['last_name']; ?><?php endif; ?>
                    </div>

                    <p><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="row justify-content-center" style="padding-top:20px; padding-bottom:40px;">
              <a href="/blog" class="btn btn-green">Click here for more Insights</a>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

  </main><!-- /#main -->
<?php endif; ?><!-- /$person -->

</article>
<?php endwhile; endif; wp_reset_postdata(); ?>


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
