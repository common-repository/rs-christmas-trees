<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://therssoftware.com
 * @since             1.0.0
 * @package           Rs_Christmas_Trees
 *
 * @wordpress-plugin
 * Plugin Name:       Rs Christmas Trees
 * Plugin URI:        https://therssoftware.com
 * Description:       RS Christmas Trees is a festive plugin designed for websites to add Christmas-themed decorations. It features various animated and static Christmas trees, snow effects, and holiday lights to enhance the seasonal ambiance of your site, providing a joyful and engaging experience for visitors during the holiday season.
 * Version:           1.0.0
 * Author:            khorshed Alam
 * Author URI:        https://therssoftware.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rs-christmas-trees
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RS_CHRISTMAS_TREES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rs-christmas-trees-activator.php
 */
function rs_christmas_trees_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-christmas-trees-activator.php';
	Rs_Christmas_Trees_Activator::activate();
}
 
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rs-christmas-trees-deactivator.php
 */
function rs_christmas_trees_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-christmas-trees-deactivator.php';
	Rs_Christmas_Trees_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'rs_christmas_trees_activate' );
register_deactivation_hook( __FILE__, 'rs_christmas_trees_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rs-christmas-trees.php';

// settings link in plugin -------------------------------------------------------
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'rs_christmas_trees_settings_links' );
function rs_christmas_trees_settings_links ( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'admin.php?page=rs-christmas-trees' ) .'">Settings</a>',
	);
	return array_merge( $links, $mylinks );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function rs_christmas_trees_active_goes() {

	$plugin = new Rs_Christmas_Trees();
	$plugin->run();

}
rs_christmas_trees_active_goes();
