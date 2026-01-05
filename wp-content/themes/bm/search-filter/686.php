<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */
/*
 * Bootstrap pagination for index and category pages
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $query->have_posts() ) :
	echo '<div id="results" class="test12"><div class="row">';
	while ( $query->have_posts() ) :
		$query->the_post();

		$post_id = get_the_ID();
		$categories = get_the_category();
		$category = !empty($categories) ? esc_html($categories[0]->slug) : '';

		// Author via ACF Post Object (no setup_postdata!)
		$author_name = '';
		$author_object = get_field('author', $post_id);
		if ( $author_object && is_object($author_object) ) {
			$author_fields = get_fields($author_object->ID);
			if ( isset($author_fields['contact_details']['name']) ) {
				$author_name = esc_html($author_fields['contact_details']['name']);
			}
		}

		// Intro content
		$post_intro = get_field('blog_intro', $post_id);
		$excerpt = $post_intro ?: get_the_content(null, false, $post_id);

		?>

		<div class="col-md-6 col-lg-4 text-center item">
			<div class="header">
				<a href="<?php echo esc_url( get_permalink($post_id) ); ?>">
					<h6><?php echo esc_html( get_the_title($post_id) ); ?></h6>
				</a>
			</div>

			<div class="excerpt">
				<div class="excerpt-top">
					<div class="date">
						Posted on <?php echo get_the_time('j F Y', $post_id); ?>
					</div>

					<div class="tags">
						<?php echo strip_tags( get_the_term_list($post_id, 'expertise', '', ' | ', '') ); ?>
					</div>

					<?php echo wp_trim_words($excerpt, 30, '...'); ?>
				</div>

				<div class="excerpt-bottom">
					<a href="<?php echo esc_url( get_permalink($post_id) ); ?>" class="btn btn-purple">Read More</a>
				</div>
			</div>
		</div>

		<?php
	endwhile;

	echo '</div><div class="row">';

	if ( function_exists('b4st_pagination') ) {
		b4st_pagination();
	} elseif ( is_paged() ) {
		?>
		<ul class="pagination">
			<li class="page-item older"><?php next_posts_link('<i class="fas fa-arrow-left"></i> Previous'); ?></li>
			<li class="page-item newer"><?php previous_posts_link('Next <i class="fas fa-arrow-right"></i>'); ?></li>
		</ul>
		<?php
	}

	echo '</div></div>';

else :
	?>
	<h4 class="dpurple" style="padding-top:50px; padding-bottom:50px; color:#fff!important;">
		Unfortunately no results have been found. Try broadening your search to access more of our News content.
	</h4>
<?php endif; ?>
