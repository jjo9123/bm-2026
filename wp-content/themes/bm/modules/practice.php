<section class="cards" style="background: url('<?php the_sub_field('bg_image'); ?>') 50%/cover no-repeat; color: #FFFFFF; background-color: #352c3f;">
	<div class="container-fluid practice">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 text-center">
					<h2 class="text-center green"><?php the_sub_field('heading'); ?></h2>

					<hr class="heading purple">
					<p><?php the_sub_field('txt'); ?></p>
				</div>
			</div>

			<?php
			if( have_rows('areas') ): ?>
				<div class="row">
	    	<?php while ( have_rows('areas') ) : the_row(); ?>
					<div class="col-lg-4 mx-auto text-center recent-item">
						<div class="img title-box" style="background: url('<?php the_sub_field('bg_img'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
							<h6><?php the_sub_field('heading'); ?></h6>
						</div>

						<div class="excerpt">
							<p><?php the_sub_field('txt'); ?></p>
							<?php 
							$link = get_sub_field('find_out_more');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
							?>
								<a href="<?php echo esc_url($link_url); ?>" class="fmore" target="<?php echo esc_attr($link_target); ?>">
									<?php echo esc_html($link_title); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
		    <?php endwhile; ?>
				</div>
			<?php endif;
			?>

			<?php if( get_sub_field('btn_show') == 'yes' ): ?>
				<div class="row">
					<div class="col-12" style="text-align: center;">
						<a href="<?php echo the_sub_field('btn_link'); ?>" class="btn btn-green"><?php echo the_sub_field('btn_txt'); ?></a>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
