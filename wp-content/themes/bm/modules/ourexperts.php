<section class="cards" style="background-color: #E3E3E3;">
	<div class="container experts">
		<div class="row mb-5">
			<div class="col-lg-12 mb-4 text-center">
				<?php if( get_sub_field('heading') ): ?>
					<h2 class="text-center dpurple"><?php echo the_sub_field('heading'); ?></h2>

					<hr class="heading purple">
				<?php endif; ?>
			</div>

			<?php
			$posts = get_sub_field('experts');
			if ( $posts ): ?>
				<?php foreach ( $posts as $post ): ?>

					<?php
					// NEW: only render published experts
					if ( get_post_status( $post ) !== 'publish' ) {
						continue;
					}

					setup_postdata( $post );
					$details = get_field('contact_details');
					$link    = get_permalink();
					?>
					<div class="col-sm-6 col-md-3 mx-auto mb-4 text-center item">
						<div class="img title-box" style="background: url('<?php echo $details['img']; ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

						<div class="excerpt purple-bg">
							<h5 style="color: #FFFFFF;">
								<?php echo $details['first_name']; ?><br/><?php echo $details['last_name']; ?>
							</h5>

							<h6>
								<?php echo $details['job_title']; ?>
							</h6>

							<?php
							$post_object = $details['location'];
							if ( $post_object ):
								$post = $post_object;
								setup_postdata( $post );
							?>
								<p>
									<?php echo get_the_title( $post_object->ID ); ?>
								</p>

								<?php wp_reset_postdata(); ?>
							<?php else: ?>
								<p style="visibility: hidden;"></p>
							<?php endif; ?>

							<a href="<?php echo $link; ?>" class="btn btn-green">View Profile</a>
						</div>
					</div>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<?php if ( get_sub_field('btn_show') == 'yes' ): ?>
			<?php if ( get_sub_field('btn_type') == 'link' ): ?>
				<div class="row justify-content-center">
					<a href="<?php the_sub_field('btn_link'); ?>" class="btn btn-green header">
						<?php the_sub_field('btn_txt'); ?>
					</a>
				</div>
			<?php else: ?>
				<?php $post_object = get_sub_field('modal');
				if ( $post_object ):
					$post = $post_object;
				?>
					<?php setup_postdata( $post ); ?>

					<div class="row justify-content-center">
						<a href="<?php the_sub_field('btn_link'); ?>" class="btn btn-dpurple header" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
							<?php the_sub_field('btn_txt'); ?>
						</a>
					</div>

					<?php get_template_part('modules/modal'); ?>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>