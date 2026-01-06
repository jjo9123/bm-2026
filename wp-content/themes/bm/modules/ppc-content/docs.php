<section class="cards <?php if( get_sub_field('background_colour') == 'grey'): ?> grey<?php endif; ?>" style="background-color: #FFFFFF;">
	<div class="container supporting-documents">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="text-center purple"><?php the_sub_field('heading'); ?></h2>

				<hr class="heading green">
			</div>


			<?php
				if( have_rows('files') ):
					while ( have_rows('files') ) : the_row(); ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 mx-auto text-center recent-item">
                          
                          <?php if( get_sub_field('add_document_image') == 'yes'): ?>
							<div class="img title-box" style="background: url('<?php the_sub_field('document_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>
                          <?php else: ?>
                          	<div class="img title-box" style="background: url('/wp-content/uploads/2019/01/download-pdf.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>
                          <?php endif; ?>

							<div class="excerpt">
								<h6 style="color: #fff;"><?php the_sub_field('name'); ?></h6>

								<a href="<?php the_sub_field('file'); ?>" target="_blank" class="btn btn-dpurple">Download</a>

							</div>
						</div>
					<?php endwhile;
				else: ?>
					<script>
						
					</script>
				<?php endif;
			?>
		</div>
	</div>
</section>
