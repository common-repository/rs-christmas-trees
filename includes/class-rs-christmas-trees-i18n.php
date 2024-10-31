<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://therssoftware.com
 * @since      1.0.0
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/includes
 * @author     khorshed Alam <robelsust@gmail.com>
 */
class Rs_Christmas_Trees_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rs-christmas-trees',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
