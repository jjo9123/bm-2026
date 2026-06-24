<section class="cards infographic bm-beige">
	<div class="container-fluid practice">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 text-center mx-auto">
					<h2 class="text-center">
						<?php the_sub_field('heading'); ?>
					</h2>
					
					<p>
						<?php the_sub_field('text'); ?>
					</p>
				</div>
			</div>

			<?php
			if( have_rows('infographic_box') ): ?>
				<div class="row infographic-row">
					<?php while ( have_rows('infographic_box') ) : the_row(); ?>
						<div class="col-12 col-md-2 mx-auto recent-item">
							<div class="infographic-box">
								<div class="title-box">
									<?php $box_icon = get_sub_field('box_icon');
									if( !empty($box_icon) ): ?>
										<img src="<?php echo $box_icon['url']; ?>" loading="lazy" class="info-icon" alt="<?php echo $box_icon['alt']; ?>" />
									<?php endif; ?>

									<div class="info-content">
										<h5>
											<?php the_sub_field('box_title'); ?>
										</h5>

										<?php if( have_rows('box_list') ): ?>
											<?php while ( have_rows('box_list') ) : the_row(); ?>

												<p>
													<span>
														<?php the_sub_field('green_title'); ?>
													</span>

													<?php the_sub_field('white_text'); ?>
												</p>
											<?php endwhile; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
