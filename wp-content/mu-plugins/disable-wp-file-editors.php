<?php
/**
 * Plugin Name: Disable WP Theme & Plugin File Editors
 * Description: For security reasons, disable the Theme & Plugin File Editors that are built into the WordPress admin area.
 * Author: Patrick Hathway - Generate UK
 * Version: 1.2
 */

/**
 * Set the `DISALLOW_FILE_EDIT` constant to disable the WP File Editors if it was not defined already. See:
 * https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#disable-the-plugin-and-theme-file-editor
 */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/**
 * Disable the WP file editors by removing the relevant capabilities from each user role, even if
 * the above constant has already been set to FALSE (which may be the case by default on WP Engine).
 *
 * Based roughly on code at: https://wordpress.org/support/topic/how-to-delete-custom-capability/#post-13624285
 */
add_action( 'admin_init', 'remove_file_edit_capabilities_from_all_wp_roles', 1 );
function remove_file_edit_capabilities_from_all_wp_roles() {
	global $wp_roles;

	// If the above constant has already been successfully set to TRUE, we can skip the next step.
	if( defined( 'DISALLOW_FILE_EDIT' ) && DISALLOW_FILE_EDIT ) {
		return;
	}

	$remove_capabilities = ['edit_plugins', 'edit_themes'];
	foreach ( $remove_capabilities as $capability ) {
		foreach ( array_keys( $wp_roles->roles ) as $role_name ) {
			$role = get_role( $role_name );
			if ( $role && $role->has_cap( $capability ) ) {
				$role->remove_cap( $capability );
			}
		}
	}
}