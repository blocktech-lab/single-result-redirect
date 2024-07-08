<?php
/**
 * Uninstaller
 *
 * Uninstall the plugin by removing any options from the database
 *
 * @package single-result-redirect
 */

// If the uninstall was not called by WordPress, exit.

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options.

delete_option( 'srr_option_single' );
delete_option( 'srr_option_exact_posts' );
delete_option( 'srr_option_exact_pages' );
