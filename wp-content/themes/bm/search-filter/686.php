<?php
/**
 * Search & Filter Pro
 *
 * Results Template (uses theme template part for each card)
 *
 * Note: This is not a full page template. It’s a results loop that gets inserted via shortcode.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $query->have_posts() ) :

	echo '<div id="results" class="test12">';
	echo '<div class="row">';

	while ( $query->have_posts() ) :
		$query->the_post();

		/**
		 * Reuse your existing card partial.
		 * Make sure the file exists at:
		 * /your-theme/template-parts/press/press-post.php
		 */
		get_template_part( 'loops/press-post' );

	endwhile;

	echo '</div>'; // .row

	// Reset global $post after custom loop
	wp_reset_postdata();

	echo '<div class="row">';

	// Pagination
	if ( function_exists( 'b4st_pagination' ) ) {
		b4st_pagination();
	} elseif ( is_paged() ) {
		?>
		<ul class="pagination">
			<li class="page-item older"><?php next_posts_link( '<i class="fas fa-arrow-left"></i> Previous' ); ?></li>
			<li class="page-item newer"><?php previous_posts_link( 'Next <i class="fas fa-arrow-right"></i>' ); ?></li>
		</ul>
		<?php
	}

	echo '</div>'; // .row
	echo '</div>'; // #results

else :
	?>
	<h4 class="dpurple" style="padding-top:50px; padding-bottom:50px; color:#fff!important;">
		Unfortunately no results have been found. Try broadening your search to access more of our News content.
	</h4>
	<?php
endif;
