<section class="cards infographic" style="background: url('/wp-content/uploads/2019/03/infographic-bg_1440x900_1360x850.jpg') 50%/cover no-repeat; color: #FFFFFF;">
	<div class="container-fluid practice">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 text-center mx-auto">
					<h2 class="text-center green">
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
						<div class="col-12 col-sm-6 col-md-5 mx-auto text-center recent-item">
							<div class="infographic-box">
								<div class="title-box">
									<?php $box_icon = get_sub_field('box_icon');
									if( !empty($box_icon) ): ?>
										<img src="<?php echo $box_icon['url']; ?>" loading="lazy" class="info-icon" alt="<?php echo $box_icon['alt']; ?>" />
									<?php endif; ?>

									<div class="info-content">
										<h5 class="purple">
											<?php the_sub_field('box_title'); ?>
										</h5>

										<?php if( have_rows('box_list') ): ?>
											<?php while ( have_rows('box_list') ) : the_row(); ?>

												<p>
													<span class="green">
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

						<span class="divider"></span>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
