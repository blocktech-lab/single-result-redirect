<?php
/**
 * SingleResult Redirect
 *
 * @package           single-result-redirect
 * @author            Blocktech Lab
 *
 * Plugin Name:       SingleResult Redirect
 * Description:       WordPress plugin that instantly displays a single search result.
 * Version:           0.9
 * Requires at least: 4.6
 * Requires PHP:      7.4
 * Author:            Blocktech Lab
 * Author URI:        https://blocktech.dev
 * Text Domain:       single-result-redirect
 */

// Define global to hold the plugin base file name.

if ( ! defined( 'SOLO_SEARCH_PLUGIN_BASE' ) ) {
	define( 'SOLO_SEARCH_PLUGIN_BASE', plugin_basename( __FILE__ ) );
}

// Include the shared functions.

require_once plugin_dir_path(__FILE__) . 'inc/common.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/settings.php';

require_once plugin_dir_path(__FILE__) . 'inc/search.php';
