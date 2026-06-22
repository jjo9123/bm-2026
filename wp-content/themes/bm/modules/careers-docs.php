<section class="cards <?php if( get_sub_field('background_colour') == 'grey'): ?> grey<?php endif; ?>" style="background-color: #FFFFFF;">
	<div class="container supporting-documents">
		<div class="row">
			<?php if( get_sub_field('txt') ): ?>
				<div class="col-lg-10">
					<p><?php the_sub_field('txt'); ?></p>
				</div>
			<?php endif; ?>
		</div>

		<div class="row">
			<?php if( get_sub_field('docs_type') == 'docs' ): ?>
				<?php
					if( have_rows('files') ):
						while ( have_rows('files') ) : the_row(); ?>
							<div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center recent-item">
								<!--<div class="img title-box" style="background: url('/wp-content/uploads/2019/01/download-pdf.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>-->

								<div class="excerpt bm-pink">
									<h6 style="color: #fff;"><?php the_sub_field('name'); ?></h6>

									<a href="<?php the_sub_field('file'); ?>" target="_blank" class="btn btn-green">Download</a>

								</div>
							</div>
						<?php endwhile;
					endif;
				?>

			<?php else: ?>
				<?php
					if( have_rows('files') ):
						while ( have_rows('files') ) : the_row(); ?>
							<div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center recent-item">
								<div class="title">
								  <p>Case Study</p>
								</div>

								<!--<div class="img title-box" style="background: url('/wp-content/uploads/Careers/careers_docs-cs.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>-->

								<div class="excerpt bm-pink">
									<h6 style="color: #fff;"><?php the_sub_field('name'); ?></h6>
								</div>

								<div class="excerpt bm-pink">
									<p><?php the_sub_field('txt'); ?></p>

									<a href="<?php the_sub_field('file'); ?>" target="_blank" class="btn btn-green">Read More</a>

								</div>
							</div>
						<?php endwhile;
					endif;
				?>

			<?php endif; ?>
		</div>
	</div>
</section>

<style>
	section.cards .recent-item:first-of-type {
		margin-left: auto;
	}
	section.cards .recent-item:last-of-type {
		margin-right: auto;
	}
</style>
