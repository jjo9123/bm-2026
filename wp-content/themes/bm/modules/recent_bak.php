<?php
	$cat_id = get_sub_field('category');
	$category = get_category($cat_id);
	$cat_slug = $category->slug;
	$cat_name = $category->name;

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 4,
		'cat' => $cat_id
	);

	$terms = get_the_terms( get_the_ID(), 'expertise' );
	$terms_array = array();
	foreach ( $terms as $term ) {
		$terms_array [] = $term->slug;
	}
	$expertise = join( ", ", $terms_array );

	$myposts = get_posts(array(
		'showposts' => 4,
		'post_type' => 'post',
		'category_name' => 'articles',
		'tax_query' => array(
			array(
			'taxonomy' => 'expertise',
			'field' => 'slug',
			'terms' => $expertise)
		))
	);
	$query = new WP_Query( $args );
?>

<?php if( get_sub_field('recent_choice') == 'recent'): ?>
	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="text-center"><?php echo $cat_name; ?></h2>

						<hr class="heading green">
					</div>

					<?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); $categories = get_the_category(); ?>
						<div class="col-lg-3 text-center item">
							<?php if($categories[0]->name == 'Events'): ?>
								<div class="recent-event">
										<p><?php echo get_field('event_date'); ?></p>
								</div>
							<?php endif; ?>

							<div class="img" style="background: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<a href="<?php the_permalink(); ?>">
									<h6><?php the_title(); ?></h6>
								</a>
							</div>

							<div class="excerpt">
								<p>An issue which often arises in a commercial setting is where two companies agree a contract for goods or services but do not put the terms in writing, instead relying on verbal agreement or letters of intent.</p>

								<a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
							</div>
						</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</section>
<?php elseif( get_sub_field('recent_choice') == 'expertise'): ?>
	<section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="text-center"><?php echo $cat_name; ?></h2>

						<hr class="heading green">
					</div>

					<?php foreach ($myposts as $mypost): ?>
						<div class="col-lg-3 text-center item">
							<div class="img" style="background: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $mypost->ID ) ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<a href="<?php the_permalink($mypost->ID); ?>">
									<h6><?php echo $mypost->post_title; ?></h6>
								</a>
							</div>

							<div class="excerpt">
								<?php $excerpt = $mypost->post_content; echo wp_trim_words( $excerpt, 30, '...' ); ?>

								<a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
