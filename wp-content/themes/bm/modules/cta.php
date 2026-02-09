<?php
if ( is_singular( 'expertise' ) ) {
  $terms = get_the_terms( get_the_ID(), 'expertise' );
  $terms_array = array();
  foreach ( $terms as $term ) {
    $terms_array[] = $term->slug;
  }
  $tag = join( ", ", $terms_array );

  $myposts = get_posts(array(
    'post_type' => 'cta',
    'tax_query' => array(
      array(
        'taxonomy' => 'expertise',
        'field'    => 'slug',
        'terms'    => $tag
      )
    )
  ));

} elseif ( is_singular( 'service' ) ) {
  $terms = get_the_terms( get_the_ID(), 'service' );
  $terms_array = array();
  foreach ( $terms as $term ) {
    $terms_array[] = $term->slug;
  }
  $tag = join( ", ", $terms_array );

  $myposts = get_posts(array(
    'post_type' => 'cta',
    'tax_query' => array(
      array(
        'taxonomy' => 'service',
        'field'    => 'slug',
        'terms'    => $tag
      )
    )
  ));

} else {
  $myposts = get_posts(array(
    'post_type' => 'cta',
    'meta_query' => array(
      array(
        'key'     => 'pages',
        'value'   => '"' . get_the_ID() . '"',
        'compare' => 'LIKE'
      )
    )
  ));
}
?>

<?php if ( $myposts ): ?>
<section class="cta-banner slider text-center">
  <div class="home-slider">

    <?php
    $i = 0;
    $fallbacks = array('bm-pink','bm-purple','bm-beige');
    ?>

    <?php foreach ( $myposts as $mypost ): ?>
      <?php
        $add_image     = get_field('add_image', $mypost->ID);
        $title         = get_field('title', $mypost->ID);
        $sub_title     = get_field('sub_title', $mypost->ID);
        $add_button    = get_field('add_button', $mypost->ID);
        $pageorexternal= get_field('pageorexternal', $mypost->ID);

        // ACF bg-colour OR fallback rotation
        $bg = get_field('bg-colour', $mypost->ID);
        if ( empty($bg) ) {
          $bg = $fallbacks[$i % count($fallbacks)];
        }
        $i++;
      ?>

      <div class="home-slide" data-bg="<?php echo esc_attr($bg); ?>">
        <div class="container">
          <div class="row">

            <?php if ( $add_image === 'yes' ):
              $image = get_field('image', $mypost->ID); ?>

              <div class="col-8 col-md-4 ml-auto">
                <?php if ( !empty($image) ): ?>
                  <img src="<?php echo esc_url($image['url']); ?>" loading="lazy" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>
              </div>

              <div class="col-12 w-image col-md-8" style="text-align:left;">
                <div>
                  <?php if ( $title ): ?><h2 class="header"><?php echo esc_html($title); ?></h2><?php endif; ?>
                  <p class="regular"><?php echo esc_html($sub_title); ?></p>

                  <?php if ( $add_button === 'yes' ):
                    $button_text = get_field('button_text', $mypost->ID);
                    $button_link = ($pageorexternal === 'external')
                      ? get_field('external_link', $mypost->ID)
                      : get_field('button_link', $mypost->ID); ?>

                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-green">
                      <?php echo esc_html($button_text); ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>

            <?php else: ?>

              <div class="col-12 col-md-10 mx-auto">
                <div>
                  <h2 class="header"><?php echo esc_html($title); ?></h2>
                  <p class="regular"><?php echo esc_html($sub_title); ?></p>

                  <?php if ( $add_button === 'yes' ):
                    $button_text = get_field('button_text', $mypost->ID);
                    $button_link = ($pageorexternal === 'external')
                      ? get_field('external_link', $mypost->ID)
                      : get_field('button_link', $mypost->ID); ?>

                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-green">
                      <?php echo esc_html($button_text); ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>

            <?php endif; ?>

          </div>
        </div>
      </div>

    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<script>
jQuery(function($){
  function setHomeSliderBg($s){
    var $c=$s.find(".slick-slide.slick-current"),
        k=$c.attr("data-bg"),bg="";
    "bm-pink"===k&&(bg="#A93690"),
    "bm-purple"===k&&(bg="#340F53"),
    "bm-beige"===k&&(bg="#F1EFE6"),
    bg&&($s[0].style.backgroundColor=bg),
    k&&$s.attr("data-theme",k);
  }
  $("section.cta-banner.slider .home-slider").each(function(){
    var $s=$(this);
    $s.on("init afterChange",function(){setHomeSliderBg($s)});
    $s.hasClass("slick-initialized")&&setHomeSliderBg($s)
  });
});
</script>
