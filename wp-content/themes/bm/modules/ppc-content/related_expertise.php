<section class="txt text-center" style="background-color: #E3E3E3;">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<h2 style="color: #32214c;">Related Expertise</h2>

				<hr class="heading purple">

				<?php $expertises = get_sub_field('expertise');
					if( $expertises ): ?>
						<ul class="related-expertise">
					    <?php foreach( $expertises as $post): ?>
								<?php setup_postdata($post); ?>

								<?php if ( get_post_status() == 'publish' ) :?>
					        <li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
								<?php endif; ?>
					    <?php endforeach; ?>
				    </ul>
						<?php wp_reset_postdata(); ?>
					<?php endif;
				?>
			</div>
		</div>
	</div>
</section>
