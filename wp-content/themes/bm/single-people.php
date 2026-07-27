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
    <section class="hero text-center bm-white">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">
              <?php echo $person['first_name']; ?> <?php echo $person['last_name']; ?>
            </h1>
            <h2><?php echo $person['job_title']; ?></h2>
          </div>
        </div>
      </div>
    </section>

    <!-- STAFF DETAILS -->
    <section class="staff-details bm-beige" style="padding-top:0;">
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
                    <a class="staff-email" href="mailto:<?php echo $person['email_address']; ?>">
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
                      <footer><?php echo $person_intro['quote_by']; ?></footer>
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
                    <a href="mailto:<?php echo $person['email_address']; ?>">
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
        <div class="row col-md-12">
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
              <div class="col-12 col-md-12 mx-auto">
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
        <section class="txt pull-out bm-white">
          <div class="container">
            <div class="row">
              <div class="col-md-12 mx-auto">
                <h3>Significant Experience</h3>
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
          <section class="staff-expertise bm-beige">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mx-auto">
                  <h3>Additional Expertise</h3>
                  <?php echo $additionalcontent['additional_text']; ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ( $additionalcontent['add_additional_quotes'] === 'yes' ) : ?>
        <section class="highlights bm-pink people-page text-center">
          <div class="container">
            <div class="row">
              <?php if ( ! empty( $additionalcontent['additional_quotes_heading'] ) ) : ?>
                <div class="col-12">
                  <h2><?php echo htmlspecialchars( $additionalcontent['additional_quotes_heading'] ); ?></h2>
                </div>
              <?php endif; ?>

              <div class="col-12 mx-auto">
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

    <!-- RECENT POSTS (ALWAYS RUNS) - NEW DESIGN -->
<?php
$person_id   = get_the_ID(); // current person profile post
$person_name = !empty($person['first_name']) ? $person['first_name'] : get_the_title($person_id);

$the_query = new WP_Query([
  'post_type'      => 'post',
  'posts_per_page' => 3,
  'post_status'    => 'publish',
  'cat'            => '-27070',
  'meta_query'     => [
    [
      'key'     => 'author',
      'value'   => '"' . $person_id . '"',
      'compare' => 'LIKE',
    ],
  ],
]);

if ( $the_query->have_posts() ) : ?>
  <section class="latest-content py-5 bm-white">
    <div class="container">

      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h2 class="mb-0">Insights by <?php echo esc_html($person_name); ?></h2>
        </div>

        <a class="latest-content__cta" href="/blog">
          More Insights
        </a>
      </div>

      <div class="row g-4">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php
            $post_id = get_the_ID();

            // image
            $thumb = get_the_post_thumbnail_url($post_id, 'large');

            // label: first category name (fallback)
            $label = 'Insights';
            $cats  = get_the_category($post_id);
            if (!empty($cats) && !empty($cats[0]->name)) {
              $label = $cats[0]->name;
            }

            // author name from ACF relationship on the post (safe: no setup_postdata)
            $author_name = '';
            $author_rel  = get_field('author', $post_id); // relationship can be object or array

            if ($author_rel) {
              $author_post = is_array($author_rel) ? ($author_rel[0] ?? null) : $author_rel;
              if ($author_post instanceof WP_Post) {
                $details_recent = get_field('contact_details', $author_post->ID);
                $fn = $details_recent['first_name'] ?? '';
                $ln = $details_recent['last_name'] ?? '';
                $author_name = trim($fn . ' ' . $ln);
              }
            }

            $date_line = get_the_date('j F', $post_id);
            if ($author_name) $date_line .= ' - ' . $author_name;

            // excerpt (trimmed)
            $snippet = get_the_excerpt($post_id);
            if (empty($snippet)) {
              $snippet = wp_strip_all_tags(get_post_field('post_content', $post_id));
            }
            $snippet = wp_trim_words($snippet, 18, '…');
          ?>

          <div class="col-12 col-md-6 col-lg-4">
            <article class="latest-card h-100 d-flex flex-column">

              <a class="latest-card__image-wrap position-relative d-block" href="<?php the_permalink(); ?>">
                <?php if ($thumb) : ?>
                  <img
                    class="latest-card__image w-100"
                    src="<?php echo esc_url($thumb); ?>"
                    alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
                    loading="lazy"
                  >
                <?php endif; ?>

                <span class="latest-card__label position-absolute">
                  <?php echo esc_html($label); ?>
                </span>
              </a>

              <div class="latest-card__body d-flex flex-column flex-grow-1">
                <p class="latest-card__date mb-2 pt-3"><?php echo esc_html($date_line); ?></p>

                <h3 class="latest-card__title mb-2">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <?php if ($snippet) : ?>
                  <p class="latest-card__excerpt mb-4">
                    <?php echo esc_html($snippet); ?>
                  </p>
                <?php endif; ?>

                <div class="mt-auto">
                  <a class="btn btn-green" href="<?php the_permalink(); ?>">More</a>
                </div>
              </div>

            </article>
          </div>

        <?php endwhile; ?>
      </div>

    </div>
  </section>
<?php
endif;
wp_reset_postdata();
?>

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
