<?php
	$cat_id = get_sub_field('category');
	$category = get_category($cat_id);
	$cat_slug = $category->slug;
	$cat_name = $category->name;
	$number = get_sub_field('num');

	if( is_page( 6033 ) ) {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
			'tag' => 'brexit'
		);}
	else {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number
		);}
	$query = new WP_Query( $args );
?>

<?php if( get_sub_field('recent_choice') == 'recent'): ?>
	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">BM Insights</h2>

						<hr class="heading green">
					</div>

					<?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); $categories = get_the_category(); ?>
						<div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
							<?php if($categories[0]->slug == 'events'): ?>
								<div class="recent-event">
									<?php echo $categories[0]->name; ?>
								</div>
							<?php else: ?>
								<div class="title">
							    <p>
							      <?php echo $categories[0]->name; ?>
							  	</p>
							  </div>
							<?php endif; ?>

							<div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'recent_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<?php if($categories[0]->slug == 'events'): ?>
									<div class="recent-event">
										<a href="<?php the_permalink($mypost->ID); ?>">
											<h6><?php echo $mypost->post_title; ?> - <?php echo get_post_meta($mypost->ID, 'event_date', TRUE); ?></h6>
										</a>
									</div>
								<?php else: ?>
									<a href="<?php the_permalink($mypost->ID); ?>">
										<h6><?php the_title(); ?></h6>
									</a>
								<?php endif; ?>
							</div>

							<div class="excerpt">
								<p><?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?></p>

								<a href="<?php the_permalink(); ?>" class="btn btn-purple" data-name="<?php the_title(); ?>">Read More</a>
							</div>
						</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>
            <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
              <a href="/blog" class="btn btn-green">Click here for more Insights</a>
            </div>
				</div>
			</div>
		</div>
	</section>

<?php elseif( get_sub_field('recent_choice') == 'expertise'): ?>
	<?php
		$terms = get_the_terms( get_the_ID(), 'expertise' );
		$terms_array = array();
		foreach ( $terms as $term ) {
			$terms_array [] = $term->slug;
		}
		$expertise = join( ", ", $terms_array );

		$myposts = get_posts(array(
			'showposts' => $number,
			'post_type' => 'post',
			'tax_query' => array(
				array(
				'taxonomy' => 'expertise',
				'field' => 'slug',
				'terms' => $expertise)
			))
		); ?>
	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">BM Insights</h2>

						<hr class="heading green">
					</div>

					<?php foreach ($myposts as $mypost): $categories = get_the_category($mypost->ID); ?>
						<div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
							<?php if($categories[0]->slug == 'events'): ?>
								<div class="recent-event">
									<?php echo $categories[0]->name; ?>
								</div>
							<?php else: ?>
								<div class="title">
							    <p>
							      <?php echo $categories[0]->name; ?>
							  	</p>
							  </div>
							<?php endif; ?>

							<div class="img" style="background: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $mypost->ID ) ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<?php if($categories[0]->slug == 'events'): ?>
									<div class="recent-event">
										<a href="<?php the_permalink($mypost->ID); ?>">
											<h6><?php echo $mypost->post_title; ?> - <?php echo get_post_meta($mypost->ID, 'event_date', TRUE); ?></h6>
										</a>
									</div>
								<?php else: ?>
									<a href="<?php the_permalink($mypost->ID); ?>">
										<h6><?php echo $mypost->post_title; ?></h6>
									</a>
								<?php endif; ?>
							</div>

							<div class="excerpt">
								<p><?php $excerpt = $mypost->post_content; echo wp_trim_words( $excerpt, 30, '...' ); ?></p>

								<a href="<?php the_permalink($mypost->ID); ?>" class="btn btn-purple">Read More</a>
							</div>
						</div>
					<?php endforeach; ?>
                    </div>
                    <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                      <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                    </div>
				</div>
			</div>
		</div>
	</section>

<?php elseif( get_sub_field('recent_choice') == 'service'): ?>
	<?php
		$terms = get_the_terms( get_the_ID(), 'service' );
		$terms_array = array();
		foreach ( $terms as $term ) {
			$terms_array [] = $term->slug;
		}
		$service = join( ", ", $terms_array );

		$myposts = get_posts(array(
			'showposts' => $number,
			'post_type' => 'post',
			'tax_query' => array(
				array(
				'taxonomy' => 'service',
				'field' => 'slug',
				'terms' => $service)
			))
		); ?>
	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">BM Insights</h2>

						<hr class="heading green">
					</div>

					<?php foreach ($myposts as $mypost): $categories = get_the_category($mypost->ID); ?>
						<div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
							<?php if($categories[0]->slug == 'events'): ?>
								<div class="recent-event">
									<?php echo $categories[0]->name; ?>
								</div>
							<?php else: ?>
								<div class="title">
							    <p>
							      <?php echo $categories[0]->name; ?>
							  	</p>
							  </div>
							<?php endif; ?>

							<div class="img" style="background: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $mypost->ID ) ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<?php if($categories[0]->slug == 'events'): ?>
									<div class="recent-event">
										<a href="<?php the_permalink($mypost->ID); ?>">
											<h6><?php echo $mypost->post_title; ?> - <?php echo get_post_meta($mypost->ID, 'event_date', TRUE); ?></h6>
										</a>
									</div>
								<?php else: ?>
									<a href="<?php the_permalink($mypost->ID); ?>">
										<h6><?php echo $mypost->post_title; ?></h6>
									</a>
								<?php endif; ?>
							</div>

							<div class="excerpt">
								<p><?php $excerpt = $mypost->post_content; echo wp_trim_words( $excerpt, 30, '...' ); ?></p>

								<a href="<?php the_permalink($mypost->ID); ?>" class="btn btn-purple">Read More</a>
							</div>
						</div>

					<?php endforeach; ?>
        </div>
            <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
              <a href="/blog" class="btn btn-green">Click here for more Insights</a>
            </div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
