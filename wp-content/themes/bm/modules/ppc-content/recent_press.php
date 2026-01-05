<?php if ( is_front_page() ): ?>
	<?php
		$terms = get_the_terms( get_the_ID(), 'expertise' );
		$terms_array = array();
		foreach ( $terms as $term ) {
			$terms_array [] = $term->slug;
		}
		$expertise = join( ", ", $terms_array );

		$myposts = get_posts(array(
			'showposts' => 3,
			'post_type' => 'press')
		);
	?>
<?php elseif ( is_singular( 'location' ) ): ?>
	<?php
		$terms = get_the_terms( get_the_ID(), 'location' );
		$terms_array = array();
		foreach ( $terms as $term ) {
			$terms_array [] = $term->slug;
		}
		$expertise = join( ", ", $terms_array );

		$myposts = get_posts(array(
			'showposts' => 3,
			'post_type' => 'press',
			'tax_query' => array(
				array(
				'taxonomy' => 'location',
				'field' => 'slug',
				'terms' => $expertise)
			))
		);
	?>
<?php else: ?>
	<?php
		$terms = get_the_terms( get_the_ID(), 'expertise' );
		$terms_array = array();
		foreach ( $terms as $term ) {
			$terms_array [] = $term->slug;
		}
		$expertise = join( ", ", $terms_array );

		$myposts = get_posts(array(
			'showposts' => 3,
			'post_type' => 'press',
			'tax_query' => array(
				array(
				'taxonomy' => 'expertise',
				'field' => 'slug',
				'terms' => $expertise)
			))
		);
	?>
<?php endif;?>

	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid">
			<div class="container news">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="text-center"><?php echo the_sub_field('heading'); ?></h2>

						<hr class="heading green">
					</div>

					<?php foreach ($myposts as $mypost): ?>
						<div class="col-sm-6 col-md-4 text-center item">
							<div class="header">
								<a href="<?php the_permalink($mypost->ID); ?>">
									<h6><?php echo $mypost->post_title; ?></h6>
								</a>
							</div>

							<div class="excerpt">
						    <div class="excerpt-top">
						      <div class="date">

						      </div>

						      <div class="tags">
						        <?php echo strip_tags(get_the_term_list( $post->ID, 'expertise', '', ' | ', '' )); ?>
						      </div>
                              <p><?php $excerpt =  $mypost->post_content;  echo wp_trim_words( $excerpt, 30, '...' ); ?></p>

						    </div>

						    <div class="excerpt-bottom">
						      <a href="<?php the_permalink($mypost->ID); ?>" class="btn btn-purple">Read More</a>
						    </div>
						  </div>
						</div>
					<?php endforeach; ?>
                    
                    <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                      <a href="/press" class="btn btn-green">Click here for more news features</a>
                    </div>
				</div>
			</div>
		</div>
	</section>
