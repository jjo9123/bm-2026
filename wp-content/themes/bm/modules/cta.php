<?php
  if( is_singular( 'expertise' )) {
    $terms = get_the_terms( get_the_ID(), 'expertise' );
    $terms_array = array();
    foreach ( $terms as $term ) {
      $terms_array [] = $term->slug;
    }
    $tag = join( ", ", $terms_array );

    $myposts = get_posts(array(
      'post_type' => 'cta',
      'tax_query' => array(
        array(
        'taxonomy' => 'expertise',
        'field' => 'slug',
        'terms' => $tag)
      ))
    );
  } elseif( is_singular( 'service' )) {
    $terms = get_the_terms( get_the_ID(), 'service' );
    $terms_array = array();
    foreach ( $terms as $term ) {
      $terms_array [] = $term->slug;
    }
    $tag = join( ", ", $terms_array );

    $myposts = get_posts(array(
      'post_type' => 'cta',
      'tax_query' => array(
        array(
        'taxonomy' => 'service',
        'field' => 'slug',
        'terms' => $tag)
      ))
    );
  } else {
    $myposts = get_posts(array(
			'post_type' => 'cta',
			'meta_query' => array(
				array(
					'key' => 'pages', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));
  };
?>

<?php if( $myposts ): ?>
  <section class="cta-banner slider text-center">
    <div class="home-slider">
      <?php foreach ($myposts as $mypost): ?>
        <?php
          $background_image = get_field('background_image', $mypost->ID);
          $add_image = get_field('add_image', $mypost->ID);
          $title = get_field('title', $mypost->ID);
          $sub_title = get_field('sub_title', $mypost->ID);
          $add_button = get_field('add_button', $mypost->ID);
          $pageorexternal = get_field('pageorexternal', $mypost->ID); ?>

        <div class="home-slide" style="background: url('<?php echo $background_image; ?>') 50%/cover no-repeat; color: #FFFFFF;">
          <div class="container">
            <div class="row">
              <?php if( $add_image == 'yes'):
                $image = get_field('image', $mypost->ID); ?>
                <div class="col-8 col-md-6 ml-auto">
                  <?php
                    if( !empty($image) ): ?>
                      <img src="<?php echo $image['url']; ?>" loading="lazy" alt="<?php echo $image['alt']; ?>" />
                  <?php endif; ?>
                </div>

                <div class="col-12 w-image col-md-6" style="text-align: left;">
                  <div>
                    <?php if (!empty($title)): ?>
                      <h2 class="header"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <p class="regular"><?php echo $sub_title; ?></p>

                    <?php if( $add_button == 'yes' ): ?>
                      <?php if( $pageorexternal == 'pagelink' ): ?>
                      <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('button_link', $mypost->ID); ?>

                      <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>

                      <?php elseif( (empty($pageorexternal)) ): ?>
                        <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('button_link', $mypost->ID); ?>

                      <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>

                      <?php elseif( $pageorexternal == 'external' ): ?>
                        <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('external_link', $mypost->ID); ?>

                        <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>
                      <?php endif; ?>    
                    <?php endif; ?>
                  </div>
                </div>

              <?php else: ?>
                <div class="col-12 col-md-10 mx-auto">
                  <div>
                    <h2 class="header"><?php echo $title; ?></h2>

                    <p class="regular"><?php echo $sub_title; ?></p>

                    <?php if( $add_button == 'yes' ): ?>
                      <?php if( $pageorexternal == 'pagelink' ): ?>
                        <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('button_link', $mypost->ID); ?>

                        <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>

                      <?php elseif( (empty($pageorexternal)) ): ?>
                        <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('button_link', $mypost->ID); ?>

                      <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>

                      <?php elseif( $pageorexternal == 'external' ): ?>
                        <?php
                        $button_text = get_field('button_text', $mypost->ID);
                        $button_link = get_field('external_link', $mypost->ID); ?>

                        <a href="<?php echo $button_link; ?>" class="btn btn-green header" tabindex="0" data-name="<?php echo $mypost->post_title; ?>"><?php echo $button_text; ?></a>
                      <?php endif; ?>
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
