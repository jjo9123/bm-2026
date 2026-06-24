<section class="cards experts-cards">

	<div class="container experts">
		<div class="row mb-5">
			<div class="col-lg-12 mb-4">
				<?php if( get_sub_field('heading') ): ?>
					<h2><?php echo the_sub_field('heading'); ?></h2>
				<?php endif; ?>
			</div>

			<?php
			$posts = get_sub_field('experts');
			if ( $posts ): ?>
				<?php foreach ( $posts as $post ): ?>

					<?php
					// only render published experts
					if ( get_post_status( $post ) !== 'publish' ) {
						continue;
					}

					setup_postdata( $post );
					$details = get_field('contact_details');
					$link    = get_permalink();

          // image (your field looks like it's storing a URL)
          $img_url = !empty($details['img']) ? $details['img'] : '';

          // location title (if location is a post object)
          $location_title = '';
          $post_object = $details['location'] ?? null;
          if ( $post_object ) {
            $location_title = get_the_title( $post_object->ID );
          }

          // label (optional) – using location if present, otherwise “Expert”
          $label = $location_title ? $location_title : 'Expert';
					?>

					<div class="col-sm-6 col-md-3 mb-4">
            <a class="expert-card" href="<?php echo esc_url($link); ?>">

              <div class="expert-card__image-wrap position-relative">
                

                <?php if ($img_url): ?>
                  <img
                    class="expert-card__image"
                    src="<?php echo esc_url($img_url); ?>"
                    alt="<?php echo esc_attr(trim(($details['first_name'] ?? '') . ' ' . ($details['last_name'] ?? ''))); ?>"
                    loading="lazy"
                  >
                <?php endif; ?>
              </div>

              <div class="expert-card__body">
                <h3 class="expert-card__name">
                  <?php echo esc_html($details['first_name'] ?? ''); ?>
                  <?php if (!empty($details['last_name'])): ?><?php endif; ?>
                  <?php echo esc_html($details['last_name'] ?? ''); ?>
                </h3>

                <?php if (!empty($details['job_title'])): ?>
                  <p class="expert-card__role"><?php echo esc_html($details['job_title']); ?></p>
				  <p class="expert-card__role"><?php echo esc_html($label); ?></p>
                <?php endif; ?>

                

                <div class="expert-card__cta">
                  <span class="btn btn-green">View profile</span>
                </div>
              </div>

            </a>
					</div>

				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>

		<?php if ( get_sub_field('btn_show') == 'yes' ): ?>
			<?php if ( get_sub_field('btn_type') == 'link' ): ?>
				<div class="row">
					<div class="col-lg-12">
						<a href="<?php the_sub_field('btn_link'); ?>" class="btn btn-green">
							<?php the_sub_field('btn_txt'); ?>
						</a>
					</div>
				</div>
			<?php else: ?>
				<?php $post_object = get_sub_field('modal');
				if ( $post_object ):
					$post = $post_object;
				?>
					<?php setup_postdata( $post ); ?>

					<div class="row">
						<div class="col-lg-12">
							<a href="<?php the_sub_field('btn_link'); ?>" class="btn btn-dpurple" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
								<?php the_sub_field('btn_txt'); ?>
							</a>
						</div>
					</div>

					<?php get_template_part('modules/modal'); ?>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
