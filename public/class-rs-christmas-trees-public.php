<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://therssoftware.com
 * @since      1.0.0
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/public
 * @author     khorshed Alam <robelsust@gmail.com>
 */
class Rs_Christmas_Trees_Public { 

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    //Show tress design on front-end. 

    public function rs_christmas_trees_show() {
        
        $christmas_schedule_before_date = esc_attr(get_option('christmas_schedule_before_date'));
        $christmas_schedule_active = esc_attr(get_option('christmas_schedule_active'));

        if ($christmas_schedule_active == 1) {
            // Split the schedule time into date and time parts
            $schedule_time = explode(" ", $christmas_schedule_before_date);
            $schedule_time_first_index = intval($schedule_time[0]);
            $schedule_time_last_index = $schedule_time[1];

            // Get current time in GMT
            $now_date = time();
            $year = gmdate('Y');

            // Calculate Christmas date in GMT
            if ($schedule_time_last_index == 'day') {
                $christmas_date = strtotime($year . '-12-25', $now_date);
                $upcoming_christmas_date = $christmas_date - $now_date;
                $upcoming_date = round($schedule_time_first_index * (60 * 60 * 24));
            } else {
                $christmas_date = strtotime($year . '-12-25 00:00:00', $now_date);
                $upcoming_christmas_date = $christmas_date - $now_date;
                $upcoming_date = round($schedule_time_first_index * (60 * 60));
            }

            if ($upcoming_christmas_date <= $upcoming_date) {
                $this->rs_christmas_trees_activities();
            }
        } else {
            $this->rs_christmas_trees_activities();
        }
    }


    // Show tress design on front-end. 
    public function rs_christmas_trees_activities() {
        $trees_active = esc_attr(get_option('rs_christmas_trees_active_tree')); 

        if ($trees_active == 1) {
            $trees_sticky = '';
            $trees_top = 'rs_tree-top';
            $trees_bottom = 'rs_tree-bottom';
            $trees_display_type = esc_attr(get_option('rs_christmas_trees_display_type'));
            $trees_hide_click_activation = esc_attr(get_option('rs_christmas_trees_hide_click_activation'));
            $trees_display_type_footer = esc_attr(get_option('rs_christmas_trees_display_type_footer'));
            $trees_display_set = esc_attr(get_option('rs_christmas_trees_display_set'));
            $trees_display_location = esc_attr(get_option('rs_christmas_trees_display_location'));
            $trees_sticky = esc_attr(get_option('rs_christmas_trees_sticky'));

            $top_url = esc_url(plugin_dir_url(__FILE__) . 'images/trees-decoration/header');
            $bottom_url = esc_url(plugin_dir_url(__FILE__) . 'images/trees-decoration/footer');
            
            $top_trees_hide = 'rs_top-trees-hide';
            $bottom_trees_hide = 'rs_bottom-trees-hide';

            $trees_sticky_class = $trees_sticky == 1 ? 'rs_trees-sticky' : 'rs_trees-non-sticky';

            if ($trees_hide_click_activation == 1) {
                $inline_script = 'var clickActive = "' . esc_js($trees_hide_click_activation) . '";';
                wp_add_inline_script('shown-custom', $inline_script);
            }

            if ($trees_display_set == 1) {

                $image_url = $trees_display_location == 1 ? $top_url . '/' . esc_attr($trees_display_type) : $top_url . '/' . esc_attr($trees_display_type);
                $tree_class = $trees_display_location == 1 ? $trees_top . ' ' . $top_trees_hide : $trees_bottom . ' ' . $bottom_trees_hide;
            
                echo '<div id="rs_sticky" class="' . esc_attr($trees_sticky_class) . ' ' . esc_attr($tree_class) . '">';
                echo '<img src="' . esc_url($image_url) . '">';
                echo '</div>';
            } elseif ($trees_display_set == 2) {
                $image_url = $trees_display_location == 1 ? $bottom_url . '/' . esc_attr($trees_display_type_footer) : $bottom_url . '/' . esc_attr($trees_display_type_footer);
                $tree_class = $trees_display_location == 1 ? $trees_top . ' ' . $top_trees_hide : $trees_bottom . ' ' . $bottom_trees_hide;

                echo '<div id="rs_sticky" class="' . esc_attr($trees_sticky_class) . ' ' . esc_attr($tree_class) . '">';
                echo '<img src="' . esc_url($image_url) . '">';
                echo '</div>';
            } elseif ($trees_display_set == 3) {
                echo '<div id="rs_sticky" class="' . esc_attr($trees_sticky_class) . ' ' . esc_attr($trees_top) . ' ' . esc_attr($top_trees_hide) . '">';
                echo '<img src="' . esc_url($top_url . '/' . esc_attr($trees_display_type)) . '">';
                echo '</div>';

                echo '<div id="rs_sticky" class="' . esc_attr($trees_sticky_class) . ' ' . esc_attr($trees_bottom) . ' ' . esc_attr($bottom_trees_hide) . '">';
                echo '<img src="' . esc_url($bottom_url . '/' . esc_attr($trees_display_type_footer)) . '">';
                echo '</div>';
            }
        }
    }


    //Show pop-up santa design on front-end.
      
    public function rs_christmas_show_pop_up(){
      
        $this->rs_christmas_santa_activities();
    }
    // Show pop-up santa design on front-end.
     
    public function rs_christmas_santa_activities() {
        
    $display_snow = esc_attr(get_option('rs_display_snow'));
    $snow_options = esc_attr(get_option('rs_display_norma_snow_or_3d'));
    $show_on_page = get_option('rs_show_on_page');
    $show_flake_type = esc_attr(get_option('rs_show_flake_type'));
    $show_z_index = esc_attr(get_option('rs_show_z_index'));
    $show_color = esc_attr(get_option('rs_show_color'));
    $page_id = $this->wp_get_inspect_page_id();

    if ($display_snow == 1) {
        // Enqueue your main snow script
        if ($snow_options == 1) {
            // Enqueue the script
            wp_enqueue_script('rs-christmas-snow', plugin_dir_url(__FILE__) . 'js/shown-custom.js', array('jquery'), $this->version, true);
             
            // Prepare inline script
            if ($show_on_page == '' || in_array($page_id, $show_on_page)) {
                $maximum_fall_speed = esc_attr(get_option('rs_maximum_fall_speed', 4000));
                $flake_minimum_size = esc_attr(get_option('rs_flake_minimum_size', 8));
                $flake_maximum_size = esc_attr(get_option('rs_flake_maximum_size', 100));

                // Create inline script
                $inline_script = sprintf(
                    'var show_snow = 1; 
                    var max_speed = %d; 
                    var mini_size = %d; 
                    var max_size = %d; 
                    var flake_color = "%s"; 
                    var flake_type = "%s"; 
                    var z_index = %d;',
                    $maximum_fall_speed,
                    $flake_minimum_size,
                    $flake_maximum_size,
                    esc_js($show_color),
                    esc_js($show_flake_type),
                    $show_z_index
                );

                // Add inline script
                wp_add_inline_script('rs-christmas-snow', $inline_script);
            }
        } elseif ($snow_options == 2) {
            // Enqueue the 3D snow script if applicable
            wp_enqueue_script('rs-christmas-snow-3d', plugin_dir_url(__FILE__) . 'js/build_snow3d.js', array('jquery'), $this->version, true);
        }
    }
}

    
    /**
     * Get current page.
     * Return the current page id.
     * @since    1.0.0
     * @access   public
     */
    public function wp_get_inspect_page_id() {
        $page_id = get_queried_object_id();
        return $page_id;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rs_Christmas_Trees_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rs_Christmas_Trees_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // Enqueue the animate.min.css only on specific pages or conditions
        if (is_front_page() || is_page()) {
            wp_enqueue_style(
                $this->plugin_name . '-animate',
                plugin_dir_url(__FILE__) . 'css/snow_animate.min.css',
                array(), 
                $this->version, 
                'all'
            );
        }

        // Enqueue rs-christmas-trees-public.css only on the front-end
        if (is_front_page() || is_page()) {
            wp_enqueue_style(
                $this->plugin_name . '-public',
                plugin_dir_url(__FILE__) . 'css/rs-christmas-trees-public.css',
                array(), 
                $this->version, 
                'all'
            );
        }

        // Enqueue snowfall.css only on the front-end and on specific conditions (e.g., specific pages)
        if (is_front_page() || is_page()) {
            wp_enqueue_style(
                $this->plugin_name . '-snowfall',
                plugin_dir_url(__FILE__) . 'css/snowfall.css',
                array(), 
                $this->version, 
                'all'
            );
        }


    }
 
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
    
            // Check if it's the front end
            if (is_front_page() || is_page()) {
                
                wp_enqueue_script($this->plugin_name . 'jquery_flurry', plugin_dir_url(__FILE__) . 'js/jquery.flurry.js', array('jquery'), $this->version, true);

                $show_on_page = get_option('show_on_page');
                $page_id = $this->wp_get_inspect_page_id();


                if ($show_on_page != '') {
                    if (in_array($page_id, $show_on_page)) {
                        wp_enqueue_script($this->plugin_name . 'jquery_flurry_custom', plugin_dir_url(__FILE__) . 'js/jquery-flurry-custom.js', array('jquery'), $this->version, true);
                    } 
                } else {
                    wp_enqueue_script($this->plugin_name . 'jquery_flurry_custom', plugin_dir_url(__FILE__) . 'js/jquery-flurry-custom.js', array('jquery'), $this->version, true);
                }
                 

                wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rs-christmas-trees-public.js', array('jquery'), $this->version, true);

            }
       

       
    }
  

     function add_async_attribute( $tag, $handle ) {
    
            if ( 'rs-christmas-snow-3d' === $handle ) {
                return str_replace( '<script ', '<script async ', $tag );
            }

            if ( $this->plugin_name.'jquery_flurry' === $handle ) {
                return str_replace( '<script ', '<script async ', $tag );
            }

            if ( $this->plugin_name.'jquery_flurry_custom' === $handle ) {
                return str_replace( '<script ', '<script async ', $tag );
            }

            if ( $this->plugin_name === $handle ) {
                return str_replace( '<script ', '<script async ', $tag );
            }

           return $tag;
       } 
}
