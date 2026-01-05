<section class="services text-center" style="background: url('<?php the_sub_field('bg_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-10 col-xl-12 mx-auto mb-4">
				<h2 class="green"><?php the_sub_field('heading'); ?></h2>

				<hr class="heading purple">

				<p><?php the_sub_field('txt'); ?></p>
			</div>

			<?php $services = get_sub_field('services');
				if( $services ): ?>
					<div class="col-12 col-lg-10 col-xl-12 mx-auto text-left">
						<ul class="cols">
					    <?php foreach( $services as $post): ?>
								<?php setup_postdata($post); ?>
				        <li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				        </li>
					    <?php endforeach; ?>
				    </ul>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif;
			?>
		</div>
	</div>
</section>
