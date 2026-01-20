<?php
/*
 * Enqueues
 */

if ( ! function_exists('b4st_enqueues') ) {
	function b4st_enqueues() {

		// Styles
		wp_register_style('bootstrap', get_template_directory_uri() . '/theme/css/bootstrap.min.css', false, '4.1.3', null);
		wp_enqueue_style('bootstrap');

		//wp_register_style('fontawesome5', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css', false, '5.6.1', null);
		//wp_enqueue_style('fontawesome5');

		wp_enqueue_style( 'gutenberg-blocks', get_template_directory_uri() . '/theme/css/blocks.css' );

		wp_register_style('b4st', get_template_directory_uri() . '/theme/css/b4st.css', false, '1.4');
		wp_enqueue_style('b4st');

		wp_register_style('style-css', get_template_directory_uri() . '/style.css', false, null);
		wp_enqueue_style('style-css');

		wp_register_style('responsive-css', get_template_directory_uri() . '/responsive.css', false, null);
		wp_enqueue_style('responsive-css');

		wp_register_style('slick-css', get_template_directory_uri() . '/theme/css/slick.css', false, null);
		wp_enqueue_style('slick-css');

		wp_register_style('slicktheme-css', get_template_directory_uri() . '/theme/css/slick-theme.css', false, null);
		wp_enqueue_style('slicktheme-css');

		// Load SlickNav
		wp_enqueue_script(
			'mobilenav-slickjs',
			get_template_directory_uri() . '/theme/js/jquery.slicknav.min.js',
			array('jquery-slicknav')
		);

		wp_register_style(
			'slicknav-css',
			get_stylesheet_directory_uri() . '/theme/css/slicknav.css'
		);
		wp_enqueue_style('slicknav-css');

		// Scripts
		wp_register_script(
			'modernizr',
			'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js',
			false,
			'2.8.3',
			true
		);
		wp_enqueue_script('modernizr');

		wp_enqueue_script('jquery-slicknav');

		wp_register_script(
			'bootstrap-bundle',
			'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js',
			false,
			'4.1.3',
			true
		);
		wp_enqueue_script('bootstrap-bundle');
		// (The Bootstrap JS bundle contains Popper JS.)

		wp_register_script(
			'slick-js',
			get_template_directory_uri() . '/theme/js/slick.min.js',
			false,
			null,
			true
		);
		wp_enqueue_script('slick-js');

		wp_register_script(
			'b4st',
			get_template_directory_uri() . '/theme/js/b4st.js',
			false,
			null,
			true
		);
		wp_enqueue_script('b4st');

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'b4st_enqueues', 100);


/**
 * Add Subresource Integrity (SRI) for selected external scripts.
 * Only applied to stable, version-pinned CDN libraries.
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {

	$sri = [
		'modernizr' => 'sha384-bPV3mA2eo3edoq56VzcPBmG1N1QVUfjYMxVIJPPzyFJyFZ8GFfN7Npt06Zr23qts',
		'bootstrap-bundle' => 'sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl',
	];

	if (!isset($sri[$handle])) {
		return $tag;
	}

	// Prevent duplicate insertion
	if (strpos($tag, ' integrity=') !== false) {
		return $tag;
	}

	return str_replace(
		' src=',
		' integrity="' . esc_attr($sri[$handle]) . '" crossorigin="anonymous" src=',
		$tag
	);

}, 10, 3);
