<section class="txt" style="background: url('<?php the_sub_field('bgimg'); ?>') 50% / cover no-repeat; <?php if( get_sub_field('txt_col') == 'light'): ?>color: #FFFFFF;<?php endif; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<?php if( have_rows('section') ):
					while ( have_rows('section') ) : the_row(); ?>
						<h5 class="text-uppercase"><?php echo the_sub_field('heading'); ?></h5>

						<ul class="related-expertise pricing-docs">
						<?php if( have_rows('docs') ):
							while ( have_rows('docs') ) : the_row(); ?>
							<li>
								<a href="<?php echo the_sub_field('doc'); ?>" target="_blank"><?php echo the_sub_field('name'); ?></a>
			        </li>
							<?php endwhile;
						endif; ?>
						</ul>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
</section>

<?php if( get_sub_field('txt_col') == 'light'): ?>
<style>
	ul.related-expertise.pricing-docs { margin-bottom: 60px; }
	ul.related-expertise.pricing-docs  > li > a { color: #FFFFFF; }
</style>
<?php endif; ?>
