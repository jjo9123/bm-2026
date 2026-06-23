<?php $bg_class = get_sub_field('bg_colour') ?: 'bm-white'; ?>

<style>
  .exp-clients .slick-slide {
  display: flex !important;
  align-items: center;
  justify-content: center;
  }
  .exp-clients img, .client-logo-slider .client-logo img {
  max-width: 200px!important;
  object-fit: contain!important;
  max-height: 125px!important;
}
.exp-clients .client-logo {
  display: flex;
  flex-direction: column;
  justify-content: start;
  align-items: center;
  padding: 10px;
  text-align: center;
  height: 100%; /* Optional, useful if using fixed height slides */
}

.exp-clients .client-logo img {
  width: auto;
  max-width: 100%;
  display: block;
}
.exp-clients .client-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    text-align: center;
    height: 100%;
}

.exp-clients .client-logo img {
    height: 80px;
    width: auto;
    object-fit: contain;
}

.exp-clients .client-logo p {
    margin-top: 10px;
    min-height: 3em; /* reserve space for 2 lines */
}
</style>
<?php
  if (is_singular('expertise')) {
    $terms = get_the_terms(get_the_ID(), 'expertise');
    $terms_array = array();
    foreach ($terms as $term) {
      $terms_array[] = $term->slug;
    }
    $tag = join(", ", $terms_array);

    $myposts = get_posts(array(
      'post_type' => 'awards',
      'tax_query' => array(
        array(
          'taxonomy' => 'expertise',
          'field'    => 'slug',
          'terms'    => $tag
        )
      )
    ));
  } elseif (is_singular('service')) {
    $terms = get_the_terms(get_the_ID(), 'service');
    $terms_array = array();
    foreach ($terms as $term) {
      $terms_array[] = $term->slug;
    }
    $tag = join(", ", $terms_array);

    $myposts = get_posts(array(
      'post_type' => 'awards',
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
      'post_type'  => 'awards',
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

<?php if ($myposts): ?>
  <section class="exp-clients <?php echo $bg_class; ?>">
    <div class="container">
      <?php foreach ($myposts as $mypost): ?>
        <div class="row">
          <div class="col-12 col-lg-12 col-xl-12 mx-auto text-section">
            <h2 class="pb-4">
              <?php echo get_field('heading', $mypost->ID); ?>
              
            </h2>


            <?php the_field('text', $mypost->ID); ?>
          </div>
        </div>

        <?php
          $images = get_field('images', $mypost->ID);
          $image_count = is_array($images) ? count($images) : 0;
        ?>

        <?php if ($images): ?>
          <?php if ($image_count > 4): ?>
            <div class="client-logo-slider slider-<?php echo $mypost->ID; ?>">
              <?php foreach ($images as $image): ?>
                <div class="client-logo">
                  <img src="<?php echo $image['url']; ?>" loading="lazy" alt="<?php echo $image['alt']; ?>" />
                  <p><?php echo $image['caption']; ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="row no-gutters">
              <?php foreach ($images as $image): ?>
                <div class="col-6 col-sm-3 client-logo">
                  <img src="<?php echo $image['url']; ?>" loading="lazy" alt="<?php echo $image['alt']; ?>" />
                  <p><?php echo $image['caption']; ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($image_count > 4): ?>
          <script>
            jQuery(document).ready(function($) {
              $('.slider-<?php echo $mypost->ID; ?>').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                responsive: [
                  { breakpoint: 992, settings: { slidesToShow: 3 }},
                  { breakpoint: 768, settings: { slidesToShow: 2 }},
                  { breakpoint: 480, settings: { slidesToShow: 1 }}
                ]
              });
            });
          </script>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>