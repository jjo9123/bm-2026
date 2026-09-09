<?php
/*
All the functions are in the PHP files in the `functions/` folder.
*/
require get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/enqueues.php';
require get_template_directory() . '/functions/hooks.php';
require get_template_directory() . '/functions/navbar.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/search-widget.php';
require get_template_directory() . '/functions/index-pagination.php';
require get_template_directory() . '/functions/single-split-pagination.php';



if( function_exists('acf_add_options_sub_page') ) {
	acf_add_options_sub_page('Header');
	acf_add_options_sub_page('Footer');
	acf_add_options_sub_page('Global');
  	acf_add_options_sub_page('Accordion Menu');
	acf_add_options_sub_page('Vacancies');
	acf_add_options_sub_page('SOS');
}
acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));


function wpse_298888_posts_where( $where, $query ) {
  global $wpdb;

  $first_char = $query->get( 'starts_with' );

  if ( $first_char ) {
    $where .= " AND $wpdb->postmeta.meta_key = 'contact_details_last_name' AND $wpdb->postmeta.meta_value LIKE '$first_char%'";
  }

  return $where;
}
add_filter( 'posts_where', 'wpse_298888_posts_where', 10, 2 );


add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
	function add_default_value_to_image_field($field) {
		acf_render_field_setting( $field, array(
			'label'			=> 'Default Image',
			'instructions'		=> 'Appears when creating a new post',
			'type'			=> 'image',
			'name'			=> 'default_value',
		));
	}



	add_filter('single_template', 'check_for_category_single_template');
function check_for_category_single_template( $t )
{
  foreach( (array) get_the_category() as $cat )
  {
    if ( file_exists(get_stylesheet_directory() . "/single-category-{$cat->slug}.php") ) return get_stylesheet_directory() . "/single-category-{$cat->slug}.php";
    if($cat->parent)
    {
      $cat = get_the_category_by_ID( $cat->parent );
      if ( file_exists(get_stylesheet_directory() . "/single-category-{$cat->slug}.php") ) return get_stylesheet_directory() . "/single-category-{$cat->slug}.php";
    }
  }
  return $t;
}

// set modal for Contact link in nav
add_filter( 'nav_menu_link_attributes', 'my_menu_atts', 10, 3 );
function my_menu_atts( $atts, $item, $args )
{
  // Provide the id of the targeted menu item
  $menu_target = 32;

  // inspect $item

  if ($item->ID == $menu_target) {
    // original post used a comma after 'modal' but this caused a 500 error as is mentioned in the OP's reply
    $atts['data-toggle'] = 'modal';
    $atts['data-target'] = '#btn-cta-modal-365';
  }
  return $atts;
}

/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

/* Hide WP version strings from scripts and styles
 * @return {string} $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function fjarrett_remove_wp_version_strings( $src ) {
    global $wp_version;
    
    // Get the query string from the URL
    $query_string = parse_url($src, PHP_URL_QUERY);
    
    // Only call parse_str if there is a query string
    if ( $query_string ) {
        parse_str($query_string, $query);
        
        if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
            $src = remove_query_arg('ver', $src);
        }
    }
    
    return $src;
}

add_filter( 'script_loader_src', 'fjarrett_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'fjarrett_remove_wp_version_strings' );
/* Hide WP version strings from generator meta tag */
function wpmudev_remove_version() {
return '';
}
add_filter('the_generator', 'wpmudev_remove_version');

add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});


function additional_admin_color_schemes() {
  //Get the theme directory
  $theme_dir = get_template_directory_uri();

  //Ocean
  wp_admin_css_color( 'test', __( 'test' ),
    $theme_dir . '/admin-colors/test/colors.min.css',
    array( '#d358c0', '#d358c0', '#d358c0', '#d358c0' )
  );
}
add_action('admin_init', 'additional_admin_color_schemes');


add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
  add_image_size( 'recent_fimg', 350, 175, true );
  add_image_size('blog-hero', 1140, 760, true);

}




/**
 * Gravity Wiz // Gravity Forms // Email Domain Validator
 *
 * This snippets allows you to exclude a list of invalid domains or include a list of valid domains for your Gravity Form Email fields.
 *
 * @version   1.4
 * @link      http://gravitywiz.com/banlimit-email-domains-for-gravity-form-email-fields/
 */
class GW_Email_Domain_Validator {

		private $_args;

		function __construct($args) {

				$this->_args = wp_parse_args( $args, array(
						'form_id' => false,
						'field_id' => false,
						'domains' => false,
						'validation_message' => __( 'Sorry, <strong>%s</strong> email accounts are not eligible for this form.' ),
						'mode' => 'ban' // also accepts "limit"
				) );

				// convert field ID to an array for consistency, it can be passed as an array or a single ID
				if($this->_args['field_id'] && !is_array($this->_args['field_id']))
						$this->_args['field_id'] = array($this->_args['field_id']);

				$form_filter = $this->_args['form_id'] ? "_{$this->_args['form_id']}" : '';

				add_filter("gform_validation{$form_filter}", array($this, 'validate'));

		}

		function validate($validation_result) {

				$form = $validation_result['form'];

				foreach($form['fields'] as &$field) {

						// if this is not an email field, skip
						if(RGFormsModel::get_input_type($field) != 'email')
								continue;

						// if field ID was passed and current field is not in that array, skip
						if($this->_args['field_id'] && !in_array($field['id'], $this->_args['field_id']))
								continue;

						$page_number = GFFormDisplay::get_source_page( $form['id'] );
						if( $page_number > 0 && $field->pageNumber != $page_number ) {
								continue;
						}

						if( GFFormsModel::is_field_hidden( $form, $field, array() ) ) {
							continue;
						}

						$domain = $this->get_email_domain($field);

						// if domain is valid OR if the email field is empty, skip
						if($this->is_domain_valid($domain) || empty($domain))
								continue;

						$validation_result['is_valid'] = false;
						$field['failed_validation'] = true;
						$field['validation_message'] = sprintf($this->_args['validation_message'], $domain);

				}

				$validation_result['form'] = $form;
				return $validation_result;
		}

		function get_email_domain( $field ) {
				$email = explode( '@', rgpost( "input_{$field['id']}" ) );
				return trim( rgar( $email, 1 ) );
		}

		function is_domain_valid( $domain ) {

				$mode   = $this->_args['mode'];
			$domain = strtolower( $domain );

				foreach( $this->_args['domains'] as $_domain ) {

					$_domain = strtolower( $_domain );

						$full_match   = $domain == $_domain;
						$suffix_match = strpos( $_domain, '.' ) === 0 && $this->str_ends_with( $domain, $_domain );
						$has_match    = $full_match || $suffix_match;

						if( $mode == 'ban' && $has_match ) {
								return false;
						} else if( $mode == 'limit' && $has_match ) {
								return true;
						}

				}

				return $mode == 'limit' ? false : true;
		}

		function str_ends_with( $string, $text ) {

				$length      = strlen( $string );
				$text_length = strlen( $text );

				if( $text_length > $length ) {
						return false;
				}

				return substr_compare( $string, $text, $length - $text_length, $text_length ) === 0;
		}

}

class GWEmailDomainControl extends GW_Email_Domain_Validator { }

# Configuration

new GW_Email_Domain_Validator( array(
		'form_id' => 326,
		'field_id' => 1,
		'domains' => array( 'gmail.com', 'hotmail.com', '.co.uk' ),
		'validation_message' => __( 'Oh no! <strong>%s</strong> email accounts are not eligible for this form.' ),
		'mode' => 'limit'
) );


foreach( array( 157,131,132,158,159,116,120,162,98,100,101,97,121,102,103,160,96,104,95,94,133,105,122,123,124,126,134,136,137,106,107,138,108,109,140,72,73,74,75,76,77,141,78,79,110,142,112,113,147,148,149,150,151,114,80,152,153,92,154,88,161,86,81,82,85,115,99,156,117,83,84 ) as $form_id ) {
	new GWEmailDomainControl(array(
 'form_id' => $form_id,
 'field_id' => 6,
 'domains' => array('btinternet.com', 'btinternet.co.uk', 'gmail.com', 'gmail.co.uk', 'googlemail.com', 'googlemail.co.uk', 'hotmail.com', 'hotmail.co.uk', 'mail.com', 'outlook.com', 'virginmedia.com', 'yahoo.com', 'yahoo.co.uk')
 ));
}

add_filter('gform_field_validation', 'block_email_domains_globally', 10, 4);
function block_email_domains_globally($result, $value, $form, $field) {
    // Only apply to email fields with a value
    if ($field->type !== 'email' || empty($value)) {
        return $result;
    }

    // Normalize email domain to lowercase
    $email_domain = strtolower(substr(strrchr($value, "@"), 1));

    // List of exact and wildcard domains to block
    $blocked_domains = array(
        'yandex.com',
        'yandex.ua',
        'yandex.pl',
        '.ru', // Blocks any domain ending in .ru
    );

    foreach ($blocked_domains as $blocked) {
        // If domain matches exactly
        if ($email_domain === $blocked) {
            $result['is_valid'] = false;
            $result['message'] = 'Email addresses from this domain are not allowed.';
            break;
        }

        // If domain ends with wildcard match like .ru
        if (str_starts_with($blocked, '.')) {
            if (substr($email_domain, -strlen($blocked)) === $blocked) {
                $result['is_valid'] = false;
                $result['message'] = 'Email addresses from this domain extension are not allowed.';
                break;
            }
        }
    }

    return $result;
}



// Hide certain categories globally across the entire site
add_action('pre_get_posts', 'wpa_136017' );
function wpa_136017( $wp_query ) {

    //$wp_query is passed by reference.  we don't need to return anything. whatever changes made inside this function will automatically effect the global variable

    $excluded = array(23416);  //made it an array in case you need to exclude more than one

    // only exclude on the front end
    if( !is_admin() ) {
        $wp_query->set('category__not_in', $excluded);
    }
}

add_filter( 'wp_lazy_loading_enabled', '__return_false' );

//This will prepend your WordPress RSS feed content with the featured image
add_filter('the_content', 'smartwp_featured_image_in_rss_feed');
function smartwp_featured_image_in_rss_feed( $content ) {
  global $post;
  if( is_feed() ) {
    if ( has_post_thumbnail( $post->ID ) ){
      $prepend = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 10px;' ) ) . '</div>';
      $content = $prepend . $content;
    }
  }
  return $content;
}

/*function myfeed_request( $qv ) {
    if ( isset( $qv['feed'] ) && !isset( $qv['post_type'] ) ) {
    $qv['post_type'] = array( 'post', 'press' );
    }
    return $qv;
}
add_filter( 'request', 'myfeed_request' ); */

/**
 * Enable vCard Upload
 *
 */
function be_enable_vcard_upload( $mime_types ){
	$mime_types['vcf'] = 'text/vcard';
	return $mime_types;
  }
  add_filter('upload_mimes', 'be_enable_vcard_upload' );

  
add_action( 'wpseo_register_extra_replacements', function() {
	wpseo_register_var_replacement( '%%jobtitle%%', 'jobtitle', 'advanced', 'Some help text' );
} );

function jobtitle() {
    $jobtitle = get_field('contact_details');

    if (is_array($jobtitle)) {
        return $jobtitle['job_title'] ?? '';
    }

    return '';
}

/* Remove Yoast SEO Prev/Next URL from all pages
 * Credit: Yoast Team
 * Last Tested: Jun 10 2017 using Yoast SEO 4.9 on WordPress 4.8
 */
 add_filter( 'wpseo_next_rel_link', '__return_false' );
 add_filter( 'wpseo_prev_rel_link', '__return_false' );

 add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
    return true;
    return $allowed;
}, 10, 2);


add_filter('wp_title','search_form_title');

function search_form_title($title){
 
 global $searchandfilter;
 
 if ( $searchandfilter->active_sfid() == 32422)
 {
 return 'Search Results';
 }
 else
 {
 return $title;
 }
 
}

add_action('gform_after_submission', function($entry, $form) {
    // Ensure you replace 'your_form_id' with your specific Gravity Form ID
    $form_id_to_target = 181; // Replace with the form ID you want to target

    // Check if the entry belongs to the desired form
    if ((int)$form['id'] === $form_id_to_target) {
        // Delete the entry using its ID
        GFAPI::delete_entry($entry['id']);
    }
}, 10, 2);

function add_expertise_to_ga4() {
    if (is_singular(array('post', 'press', 'people')) && has_term('', 'expertise')) {
        $expertise_terms = wp_get_post_terms(get_the_ID(), 'expertise', array("fields" => "names"));
        $post_type = get_post_type(); // Get the current post type
        ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'content_view',
                'post_type': '<?php echo esc_js($post_type); ?>',
                'expertise': '<?php echo esc_js(implode(", ", $expertise_terms)); ?>'
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'add_expertise_to_ga4', 99);


remove_filter('template_redirect','redirect_canonical');

// fix GF length error on textarea
// 1. Stop GF from enqueueing the textareaCounter script
add_filter('gform_textarea_counter_script_output', '__return_false');

// 2. Stop inline textareaCount() calls
add_filter('gform_textarea_counter_init_script', '__return_false');

// 3. Force-remove the script even if it was enqueued
add_action('wp_enqueue_scripts', 'remove_gf_textarea_counter', 100);
function remove_gf_textarea_counter() {
    wp_dequeue_script('gform_textarea_counter');
    wp_deregister_script('gform_textarea_counter');
}
add_action('template_redirect', 'remove_inline_textareaCount_init');
function remove_inline_textareaCount_init() {
    ob_start(function($buffer) {
        // Remove any inline textareaCount() call — adjust if needed
        return preg_replace('/\$\(.*?\)\.textareaCount\([^;]*\);/', '', $buffer);
    });
}

// Output combined FAQPage schema only once in the footer
function output_combined_faq_jsonld() {
  // Check if global exists and is a non-empty array
  global $global_faq_schema_data;

  if ( isset($global_faq_schema_data) && is_array($global_faq_schema_data) && !empty($global_faq_schema_data) ) {

      // Build the JSON-LD array
      $schema = [
          '@context' => 'https://schema.org',
          '@type' => 'FAQPage',
          'mainEntity' => $global_faq_schema_data
      ];

      // Encode JSON safely
      $json_ld = wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

      // Final safety check: don't output if encoding failed
      if ( !empty($json_ld) ) {
          echo '<script type="application/ld+json">' . $json_ld . '</script>';
      }
  }
}

// Hook into wp_footer with a low priority (runs late)
add_action('wp_footer', 'output_combined_faq_jsonld', 100);

//delete old form fills
/*add_action('init', 'delete_old_gravity_forms_entries');
function delete_old_gravity_forms_entries() {
    if (!is_admin()) return;

    $search_criteria = [
        'start_date' => '2000-01-01',
        'end_date'   => date('Y-m-d', strtotime('-12 months'))
    ];
    $paging = ['offset' => 0, 'page_size' => 50];

    $entries = GFAPI::get_entries(0, $search_criteria, null, $paging);

    foreach ($entries as $entry) {
        GFAPI::delete_entry($entry['id']);
    }
}*/

function add_blake_morgan_schema_to_homepage() {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "LegalService",
          "@id": "https://www.blakemorgan.co.uk/#organization",
          "name": "Blake Morgan",
          "legalName": "Blake Morgan LLP",
          "alternateName": [
            "Morgan Cole LLP",
            "Blake Lapthorn LLP"
          ],
          "url": "https://www.blakemorgan.co.uk/",
          "logo": "https://www.blakemorgan.co.uk/wp-content/uploads/Unorganized/logo.png",
          "description": "Blake Morgan LLP is a large full-service commercial law firm with offices in Cardiff, London, Manchester, Oxford, Reading and Southampton in the United Kingdom. It was formed in 2014 following a merger between the Cardiff-based Morgan Cole and the Portsmouth-based Blake Lapthorn.",
          "foundingDate": "2014",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "New Kings Court, Tollgate, Chandlers Ford",
            "addressLocality": "Eastleigh",
            "addressRegion": "Hampshire",
            "postalCode": "SO53 3LG",
            "addressCountry": "GB"
          },
          "hasCredential": [
            {
              "@type": "EducationalOccupationalCredential",
              "@id": "https://www.blakemorgan.co.uk/#credential-top-tier-2025",
              "credentialCategory": "Top Tier Firm 2025",
              "recognizedBy": {
                "@type": "Organization",
                "name": "The Legal 500"
              }
            },
            {
              "@type": "EducationalOccupationalCredential",
              "@id": "https://www.blakemorgan.co.uk/#credential-family-mediation",
              "credentialCategory": "Family Mediation",
              "recognizedBy": {
                "@type": "Organization",
                "name": "The Law Society"
              }
            },
            {
              "@type": "EducationalOccupationalCredential",
              "@id": "https://www.blakemorgan.co.uk/#credential-high-net-worth-2024",
              "credentialCategory": "High Net Worth 2024",
              "recognizedBy": {
                "@type": "Organization",
                "name": "Chambers and Partners"
              }
            },
            {
              "@type": "EducationalOccupationalCredential",
              "@id": "https://www.blakemorgan.co.uk/#credential-top-tier-2023",
              "credentialCategory": "Top Tier Firm 2023",
              "recognizedBy": {
                "@type": "Organization",
                "name": "The Legal 500"
              }
            }
          ],
          "contactPoint": {
            "@type": "ContactPoint",
            "@id": "https://www.blakemorgan.co.uk/#contact",
            "telephone": "+44 207 405 2000",
            "contactType": "Customer Service",
            "areaServed": [
              "Cardiff",
              "London",
              "Manchester",
              "Oxford",
              "Reading",
              "Southampton"
            ],
            "availableLanguage": ["English"]
          },
          "areaServed": [
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#cardiff",
              "name": "Cardiff"
            },
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#london",
              "name": "London"
            },
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#manchester",
              "name": "Manchester"
            },
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#oxford",
              "name": "Oxford"
            },
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#reading",
              "name": "Reading"
            },
            {
              "@type": "City",
              "@id": "https://www.blakemorgan.co.uk/#southampton",
              "name": "Southampton"
            }
          ],
          "sameAs": [
            "https://www.facebook.com/blakemorganllp",
            "https://www.linkedin.com/company/blake-morgan-llp/",
            "https://x.com/BlakeMorganLLP",
            "https://en.wikipedia.org/wiki/Blake_Morgan_LLP"
          ]
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'add_blake_morgan_schema_to_homepage');

// Match expertise taxonomy to taxonomy pages
add_filter('term_link', 'link_expertise_term_to_exact_page', 10, 3);

function link_expertise_term_to_exact_page($url, $term, $taxonomy) {
    if ($taxonomy !== 'expertise') {
        return $url;
    }

    $term_slug = $term->slug;

    $post = get_page_by_path($term_slug, OBJECT, 'expertise');

    if ($post) {
        return get_permalink($post->ID);
    }

    return $url;
}


// Match service taxonomy to service pages 
add_filter('term_link', 'link_service_term_to_service_post', 10, 3);

function link_service_term_to_service_post($url, $term, $taxonomy) {
    if ($taxonomy !== 'services') return $url;

    $term_slug = $term->slug;

    $query = new WP_Query([
        'post_type' => 'service',
        'tax_query' => [
            [
                'taxonomy' => 'services',
                'field'    => 'slug',
                'terms'    => $term_slug,
            ]
        ],
        'posts_per_page' => -1,
    ]);

    $best_match = null;

    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            $post_slug = basename(get_permalink($post));
            if ($post_slug === $term_slug) {
                $best_match = $post;
                break;
            }
            if (!$best_match) {
                $best_match = $post;
            }
        }
        wp_reset_postdata();
        if ($best_match) return get_permalink($best_match);
    }

    return $url;
}

add_action( 'wp_footer', function () {
  ?>
  <script>
    window.addEventListener('error', function (e) {
      if (
        e.message &&
        e.message.indexOf('reCAPTCHA has already been rendered') !== -1
      ) {
        e.preventDefault();
        return false;
      }
    });
  </script>
  <?php
});

add_filter( 'gform_form_tag', function( $form_tag, $form ) {

    $target_id = isset($GLOBALS['bm_contact_footer_form_id']) ? (int) $GLOBALS['bm_contact_footer_form_id'] : 0;
    if ( ! $target_id || (int) $form['id'] !== $target_id ) {
        return $form_tag;
    }

    // Add gf-contact-split to existing class attribute
    $form_tag = preg_replace(
        '/\bclass=("|\')([^"\']*)\1/',
        'class=$1gf-contact-split $2$1',
        $form_tag,
        1
    );

    return $form_tag;

}, 10, 2 );

add_filter( 'gform_field_container', function( $field_container, $field, $form ) {

    $target_id = isset($GLOBALS['bm_contact_footer_form_id']) ? (int) $GLOBALS['bm_contact_footer_form_id'] : 0;
    if ( ! $target_id || (int) $form['id'] !== $target_id ) {
        return $field_container;
    }

    static $marked = false;

    if ( ! $marked && isset($field->type) && $field->type === 'textarea' ) {
        $marked = true;

        $field_container = str_replace( "class='gfield ", "class='gfield gf-split-message ", $field_container );
        $field_container = str_replace( 'class="gfield ', 'class="gfield gf-split-message ', $field_container );
    }

    return $field_container;

}, 10, 3 );

function inc_sentence_case($text) {
    $text = mb_strtolower($text);
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}
/**
 * Image bank: ACF Options Gallery field name "blog_image_bank"
 * Lock meta: _bm_bank_image_id
 * Applies to: post + press
 * Excludes (posts only): events, pastevents
 */

function bm_get_image_bank_ids(): array {
  static $ids = null;
  if ($ids !== null) return $ids;

  $cached = get_transient('bm_blog_image_bank_ids');
  if (is_array($cached)) {
    $ids = $cached;
    return $ids;
  }

  if (!function_exists('get_field')) {
    $ids = [];
    return $ids;
  }

  $bank = get_field('blog_image_bank', 'option');
  if (empty($bank) || !is_array($bank)) {
    $ids = [];
    set_transient('bm_blog_image_bank_ids', $ids, HOUR_IN_SECONDS);
    return $ids;
  }

  $tmp = [];
  foreach ($bank as $item) {
    if (is_numeric($item)) $tmp[] = (int)$item;
    elseif (is_array($item) && !empty($item['ID'])) $tmp[] = (int)$item['ID'];
  }

  $ids = array_values(array_unique(array_filter($tmp)));
  set_transient('bm_blog_image_bank_ids', $ids, 12 * HOUR_IN_SECONDS);

  return $ids;
}

add_action('acf/save_post', function ($post_id) {
  if ($post_id === 'options') {
    delete_transient('bm_blog_image_bank_ids');
  }
}, 20);

function bm_post_has_excluded_category(int $post_id, array $excluded = ['events', 'pastevents']): bool {
  foreach ($excluded as $slug) {
    if (has_category($slug, $post_id)) return true;
  }
  return false;
}

/**
 * Get locked bank image for this post, or pick+lock one.
 */
function bm_get_locked_bank_image_id(int $post_id): int {
  $locked = (int) get_post_meta($post_id, '_bm_bank_image_id', true);
  if ($locked) return $locked;

  $ids = bm_get_image_bank_ids();
  if (empty($ids)) return 0;

  $picked = (int) $ids[$post_id % count($ids)];
  update_post_meta($post_id, '_bm_bank_image_id', $picked);

  return $picked;
}

add_action('save_post', function ($post_id, $post, $update) {

  if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!$post || empty($post->post_type) || empty($post->post_status)) return;

  if ($post->post_status !== 'publish') return;

  // Apply to posts + press
  if (!in_array($post->post_type, ['post', 'press'], true)) return;

  // Exclude events/pastevents only for posts
  if ($post->post_type === 'post' && bm_post_has_excluded_category((int)$post_id)) return;

  // Manual override
  if (has_post_thumbnail($post_id)) return;

  $thumb_id = bm_get_locked_bank_image_id((int)$post_id);
  if (!$thumb_id) return;

  set_post_thumbnail($post_id, $thumb_id);

}, 20, 3);

// Remove s from category label
function bm_get_label_from_category($post_id) {

  // Press CPT always shows News
  if (
      get_post_type($post_id) === 'press' ||
      strpos(get_permalink($post_id), '/press/') !== false
  ) {
      return 'News';
  }

  $cats = get_the_category($post_id);

  if (empty($cats)) {
      return 'Insights';
  }

  // If this post is in the Events category or any child of Events,
  // use the dedicated event label function.
  $events = get_category_by_slug('events');

  if ($events) {
      foreach ($cats as $cat) {
          if (
              $cat->term_id === $events->term_id ||
              cat_is_ancestor_of($events->term_id, $cat->term_id)
          ) {
              return bm_get_event_label($post_id);
          }
      }
  }

  $slug = $cats[0]->slug;

  $map = [
    'articles'       => 'Article',
    'case-studies'   => 'Case Study',
    'events'         => 'Event',
    'guides'         => 'Guide',
    'newsletters'    => 'Newsletter',
    'press'          => 'Press Release',
    'pastevents'     => 'Past Event',
    'past-events'    => 'Past Event',
    'personal-profiles' => 'Personal profile',
  ];

  return $map[$slug] ?? $cats[0]->name;
}

function bm_get_event_label($post_id) {
    $cats = get_the_category($post_id);

    if (empty($cats)) return 'Event';

    $map = [
        'in-person-events'   => 'In-person event',
        'past-events'        => 'Past event',
        'pastevents'         => 'Past event',
        'webinar-recordings' => 'Webinar recording',
        'webinars'           => 'Webinar',
        'training'           => 'Training',
    ];

    foreach ($map as $slug => $label) {
        if (has_category($slug, $post_id)) {
            return $label;
        }
    }

    return 'Event';
}

add_action( 'gf_cleanup_old_entries', function () {

    if ( ! class_exists( 'GFAPI' ) ) {
        return;
    }

    $cutoff = gmdate( 'Y-m-d H:i:s', strtotime( '-6 months' ) );
    $deleted_count = 0;

    $forms = GFAPI::get_forms();

    foreach ( $forms as $form ) {

        $search_criteria = [
            'end_date' => $cutoff,
        ];

        do {
            $entries = GFAPI::get_entries(
                $form['id'],
                $search_criteria,
                null,
                [
                    'offset'    => 0,
                    'page_size' => 100,
                ]
            );

            if ( is_wp_error( $entries ) || empty( $entries ) ) {
                break;
            }

            foreach ( $entries as $entry ) {
                $result = GFAPI::delete_entry( $entry['id'] );

                if ( ! is_wp_error( $result ) ) {
                    $deleted_count++;
                }
            }

        } while ( count( $entries ) === 100 );
    }

    error_log(
        'GF retention cleanup completed. Deleted ' .
        $deleted_count .
        ' entries older than ' .
        $cutoff
    );
} );