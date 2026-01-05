<?php
	$cat_id = get_sub_field('category');
	$category = get_category($cat_id);
	$cat_slug = $category->slug;
	$cat_name = $category->name;
	$number = get_sub_field('num');
    $tag_name = get_sub_field('tag');

	?>

<?php if( get_sub_field('events_or_blogs') == 'blogs'): ?>
  <?php
  $args = array(
              'post_type' => 'post',
              'posts_per_page' => $number,
              'tag' => $tag_name,
              'category__not_in' => array( 5 )
          );

  $query = new WP_Query( $args );
  ?>
  <?php if ( $query->have_posts() ) : ?>
	<section class="blog recent" id="blogs-section" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
		<div class="container-fluid <?php echo $cat_slug; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center"><?php the_sub_field('title'); ?></h2>

						<hr class="heading green">
					</div>

					<?php while( $query->have_posts() ) : $query->the_post(); $categories = get_the_category(); ?>
						<div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
							<?php if($categories[0]->slug == 'events'): ?>
								<div class="recent-event">
										<p><?php echo get_field('event_date'); ?></p>
								</div>
							<?php else: ?>
								<div class="title">
							    <p>
							      <?php echo $categories[0]->name; ?>
							  	</p>
							  </div>
							<?php endif; ?>

							<div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'home_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

							<div class="header">
								<a href="<?php the_permalink(); ?>">
									<h6><?php the_title(); ?></h6>
								</a>
							</div>

							<div class="excerpt">
                              
								<p><?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?></p>

								<a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
							</div>
						</div>

					<?php endwhile; ?>

                    <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                      <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                    </div>

				</div>
			</div>
		</div>
	</section>
  <?php endif; wp_reset_postdata(); ?>


<?php elseif( get_sub_field('events_or_blogs') == 'events'): ?>
  <?php
  	$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
			'tag' => $tag_name,
            'category__in' => array( 5 )
		);

	$query = new WP_Query( $args );
  ?>

  <?php if ( $query->have_posts() ) : ?>
      <section class="blog recent" id="events-section" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
          <div class="container-fluid <?php echo $cat_slug; ?>">
              <div class="container" style="padding-bottom: 40px;">
                  <div class="row">
                      <div class="col-md-12">
                          <h2 class="text-center"><?php the_sub_field('title'); ?></h2>

                          <hr class="heading green">
                      </div>

                      <?php while( $query->have_posts() ) : $query->the_post(); $categories = get_the_category(); ?>
                          <div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
                              <?php if($categories[0]->slug == 'events'): ?>
                                  <div class="recent-event">
                                          <p><?php echo get_field('event_date'); ?></p>
                                  </div>
                              <?php else: ?>
                                  <div class="title">
                                  <p>
                                    <?php echo $categories[0]->name; ?>
                                  </p>
                                </div>
                              <?php endif; ?>

                              <div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'home_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                              <div class="header">
                                  <a href="<?php the_permalink(); ?>">
                                      <h6><?php the_title(); ?></h6>
                                  </a>
                              </div>

                              <div class="excerpt">
                                <?php $getpost = get_post($arg->post->ID);
                                $excerpt = $getpost->post_content; ?>
                                <?php if ( empty($excerpt)){ $excerpt = get_field('intro_title'); } ?>
                                   <p><?php echo wp_trim_words( $excerpt, 30, '...' ); ?></p>
                                 

                                  <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                              </div>
                          </div>

                      <?php endwhile; ?>

                     <!-- <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                        <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                      </div> -->

                  </div>
              </div>
          </div>
      </section>
  <?php endif; wp_reset_postdata(); ?>

  <?php elseif( get_sub_field('events_or_blogs') == 'both'): ?>
  <?php
  	$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
			'tag' => $tag_name
		);

	$query = new WP_Query( $args );
  ?>

  <?php if ( $query->have_posts() ) : ?>
      <section class="blog recent" id="blogs-section" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
          <div class="container-fluid <?php echo $cat_slug; ?>">
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <h2 class="text-center"><?php the_sub_field('title'); ?></h2>

                          <hr class="heading green">
                      </div>

                      <?php while( $query->have_posts() ) : $query->the_post(); $categories = get_the_category(); ?>
                          <div class="col-sm-6 col-md-4 text-center item i<?php echo $categories[0]->slug; ?>">
                              <?php if($categories[0]->slug == 'events'): ?>
                                  <div class="recent-event">
                                          <p><?php echo get_field('event_date'); ?></p>
                                  </div>
                              <?php else: ?>
                                  <div class="title">
                                  <p>
                                    <?php echo $categories[0]->name; ?>
                                  </p>
                                </div>
                              <?php endif; ?>

                              <div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'home_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                              <div class="header">
                                  <a href="<?php the_permalink(); ?>">
                                      <h6><?php the_title(); ?></h6>
                                  </a>
                              </div>

                              <div class="excerpt">
                                <?php $getpost = get_post($arg->post->ID);
                                $excerpt = $getpost->post_content; ?>
                                <?php if ( empty($excerpt)){ $excerpt = get_field('intro_title'); } ?>
                                   <p><?php echo wp_trim_words( $excerpt, 30, '...' ); ?></p>
                                 

                                  <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                              </div>
                          </div>

                      <?php endwhile; ?>

                      <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                        <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                      </div>

                  </div>
              </div>
          </div>
      </section>
  <?php endif; wp_reset_postdata(); ?>





<?php endif; ?>
