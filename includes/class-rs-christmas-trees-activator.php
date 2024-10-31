<?php

/**
 * Fired during plugin activation
 *
 * @link       https://therssoftware.com
 * @since      1.0.0
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/includes
 * @author     khorshed Alam <robelsust@gmail.com>
 */
class Rs_Christmas_Trees_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();
	    $default = '';

	    // Default options
	    $options = array(
	        'rs_trees_active' => 0,
	        'rs_trees_display_type' => 'top_1.png',
	        'rs_trees_display_set' => 1,
	        'rs_trees_display_location' => 1,
	        'rs_trees_display_type_footer' => 'footer_1.png',
	        'rs_trees_sticky' => 1,
	        'rs_display_snow' => 0,
	        'rs_display_norma_snow_or_3d' => 1,
	        'rs_maximum_fall_speed' => $default,
	        'rs_flake_minimum_size' => $default,
	        'rs_flake_maximum_size' => $default,
	        'rs_show_on_page' => $default, 
	        'rs_show_z_index' => 10000,
	        'rs_show_color' => 'FFF1F0'
	    );

	    foreach ($options as $option => $value) {
	        if (!get_option($option)) {
	            update_option($option, $value);
	        }
	    } 
	}

}
