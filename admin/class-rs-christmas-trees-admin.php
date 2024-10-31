<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://therssoftware.com
 * @since      1.0.0
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Christmas_Trees
 * @subpackage Rs_Christmas_Trees/admin
 * @author     khorshed Alam <robelsust@gmail.com>
 */
class Rs_Christmas_Trees_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		 
	}

	 /**
     * This is setting section fields
     *
     * @since    1.0.0
     * @access   public
     * @var      array
     */
    public $treesSettings = array();
    public $treesSections = array();
    public $treesFields = array();
    public $snowSettings = array();
    public $snowSections = array();
    public $snowFields = array();
    



    //Create theme and menu page. 

 
    public function rs_christmas_trees() { 

        add_menu_page(
            'Rs Christmas Trees',                    // The value used to populate the browser's title bar when the menu page is active
            esc_html__('Rs Christmas Trees','rs-christmas-trees'),                    // The text of the menu in the administrator's sidebar
            'administrator',                    // What roles are able to access the menu
            'rs-christmas-trees',               // The ID used to bind submenu items to this menu
            array($this,'rs_christmas_trees_display') ,   // The callback function used to render this menu
            'dashicons-buddicons-groups',
            80
        );
    }

    // Display nav bar.
  
	public function rs_christmas_trees_display($active_tab = '')
	{
	    ?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">
		    <div id="icon-themes" class="icon32"></div>
		    <h2 style="color:#226c5e; font-weight: bold;">Rs Christmas <span style="color:#bc1d2b">Trees</span></h2>
		    <?php settings_errors(); ?>

		    <?php
			        $rs_christmas_trees_tabs = [
			            'rs_christmas_trees' => esc_html__("Christmas Trees", "rs-christmas-trees"),
			            'rs_falling_snow' => esc_html__("Falling Snow", "rs-christmas-trees"),
			            
			        ];

			    
			        $active_tab = filter_input(INPUT_GET, 'tab', FILTER_SANITIZE_STRING) ?: 'rs_christmas_trees';
			        ?>



		    <h2 class="nav-tab-wrapper">
		        <?php foreach ($rs_christmas_trees_tabs as $rs_christmas_trees_tab => $rs_christmas_trees_label): ?>
		        <a href="<?php echo esc_url(add_query_arg('tab', esc_attr($rs_christmas_trees_tab), admin_url('admin.php?page=rs-christmas-trees'))); ?>"
		            class="nav-tab <?php echo $active_tab == $rs_christmas_trees_tab ? 'nav-tab-active' : ''; ?>">
		            <?php echo esc_html($rs_christmas_trees_label); ?>
		        </a>
		        <?php endforeach; ?>
		    </h2>
		    <form method="post" action="options.php">
		        <div class="ss_col">
		            <div class="ss_left_col">
		                <?php
			                    $rs_christmas_trees_settings_groups = [
			                        'rs_christmas_trees' => 'rs_christmas_trees_options_group',
			                        'rs_falling_snow' => 'rs_christmas_snow_options_group', 
			                    ];

			                    $rs_christmas_trees_sections = [
			                        'rs_christmas_trees' => 'rs_christmas_trees',
			                        'rs_falling_snow' => 'rs_falling_snow_option', 
			                    ];

			                    settings_fields($rs_christmas_trees_settings_groups[$active_tab]);
			                    do_settings_sections($rs_christmas_trees_sections[$active_tab]);
			                    submit_button();
			                    ?>
		            </div>
		            <div class="ss_right_col">
		                <div class="ss_right_content">
		                    <div class="logo_top"><img src="<?php echo esc_url(plugins_url('logo.png', __FILE__)); ?>"></div>

		                    <div class="ss_extracontent">
		                        <h3>Need Help?</h3>
		                        <a class="underline" target="_blank" href="#">Support forum</a><br>
		                        <a class="underline" target="_blank" href="#">Contact us for customization</a><br>
		                        <a class="underline" target="_blank" href="#">WordPress Plugins by Rssoftware</a><br>
		                        <a class="underline" target="_blank" href="#">WordPress Themes by Rssoftware</a><br>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </form>
		</div><!-- /.wrap -->
		<?php
	}

    // end sandbox_theme_display
    
    function rs_christmas_trees_set_trees_settings()
	{
	    $options = [
	        'rs_christmas_trees_active_tree',
	        'rs_christmas_trees_display_type',
	        'rs_christmas_trees_display_type_footer',
	        'rs_christmas_trees_display_location',
	        'rs_christmas_trees_sticky',
	        'rs_christmas_trees_display_set',
	        'rs_christmas_trees_hide_click_activation',
	    ];

	    $args = array_map(function($option) {
	        return [
	            'option_group' => 'rs_christmas_trees_options_group',
	            'option_name' => $option,
	        ];
	    }, $options);

	    $this->rs_christmas_trees_trees_settings($args);
	}

    // Create option section for tress.
 
    function rs_christmas_trees_set_trees_sections()
    {
        $args = array(
            array(
                'id' => 'rs_christmas_trees_index',
                'page' => 'rs_christmas_trees'
            )
        );
        $this->rs_christmas_trees_tree_sections( $args );
    }
    // Create option fields for tress.
 
	function rs_christmas_trees_set_trees_fields() {
	    $fields = [
	        'rs_christmas_trees_active_tree',
	        'rs_christmas_trees_hide_click_activation',
	        'rs_christmas_trees_display_set',
	        'rs_christmas_trees_display_location',
	        'rs_christmas_trees_sticky',
	        'rs_christmas_trees_display_type',
	        'rs_christmas_trees_display_type_footer',
	    ];

	    $args = array_map(function($field) {
	        return [
	            'id' => $field,
	            'title' => '',
	            'callback' => [$this, $field],
	            'page' => 'rs_christmas_trees',
	            'section' => 'rs_christmas_trees_index',
	            'args' => [
	                'label_for' => $field,
	                'class' => 'rs_christmas_trees_label_list',
	            ],
	        ];
	    }, $fields);

	    $this->rs_christmas_trees_treesfields($args);
	}

    // Create option  settings for snow.
   
	function rs_christmas_trees_set_snow_settings() {
	    $option_names = [
	        'rs_display_snow',
	        'rs_display_norma_snow_or_3d',
	        'rs_maximum_fall_speed',
	        'rs_flake_minimum_size',
	        'rs_flake_maximum_size',
	        'rs_show_flake_type',
	        'rs_show_z_index',
	        'rs_show_color',
	        'rs_show_on_page',
	    ];

	    $args = array_map(function($name) {
	        return [
	            'option_group' => 'rs_christmas_snow_options_group',
	            'option_name' => $name,
	        ];
	    }, $option_names);

	    $this->rs_christmas_trees_snow_settings($args);
	}

    //reate option  section for snow.

    function rs_christmas_trees_set_snow_sections(){
        $args = array(
            array(
                'id' => 'rs_christmas_snow_index',
                'page' => 'rs_falling_snow_option'
            )
        );
        $this->rs_christmas_trees_snow_sections( $args );
    }
    // Create option  fields for snow.
  
    function rs_christmas_trees_set_snow_fields() {
        $fields = [
            'rs_display_snow' => 'rs_display_snow',
            'rs_display_norma_snow_or_3d' => 'rs_display_norma_snow_or_3d',
            'rs_maximum_fall_speed' => 'rs_maximum_fall_speed',
            'rs_flake_minimum_size' => 'rs_flake_minimum_size',
            'rs_flake_maximum_size' => 'rs_flake_maximum_size',
            'rs_show_flake_type' => 'rs_show_flake_type',
            'rs_show_z_index' => 'rs_show_z_index',
            'rs_show_color' => 'rs_show_color',
            'rs_show_on_page' => 'rs_show_on_page',
        ];

        $args = array_map(function($id, $callback) {
            return [
                'id' => $id,
                'title' => '',
                'callback' => [$this, $callback],
                'page' => 'rs_falling_snow_option',
                'section' => 'rs_christmas_snow_index',
                'args' => [
                    'label_for' => $id,
                    'class' => 'rs_christmas_trees_label_list'
                ]
            ];
        }, array_keys($fields), $fields);

        $this->rs_christmas_trees_snow_fields($args);
    } 

    
    // reserved settings array of tress.
    
    public function rs_christmas_trees_trees_settings( array $treesSettings )
    {
        $this->treesSettings = $treesSettings;
        return $this;
    }
    
    // reserved section array of tress.
   
    public function rs_christmas_trees_tree_sections( array $treesSections )
    {
        $this->treesSections = $treesSections;
        return $this;
    }

    
    //  reserved fields array of tress.
    
    public function rs_christmas_trees_treesfields( array $treesFields )
    {
        $this->treesFields = $treesFields;
        return $this;
    }
    
    // reserved settings array of snow.
  
    public function rs_christmas_trees_snow_settings( array $snowSettings )
    {
        $this->snowSettings = $snowSettings;
        return $this;
    }


    // reserved section array of snow. 

    public function rs_christmas_trees_snow_sections( array $snowSections )
    {
        $this->snowSections = $snowSections;
        return $this;
    }
 
    //      reserved fields array of snow. 

    public function rs_christmas_trees_snow_fields( array $snowFields )
    {
        $this->snowFields = $snowFields;
        return $this;
    }

     
	// register all custom settings sections and fields.
 
	 public function registerCustomFields() {
	    // Set settings, sections, and fields
	    $this->rs_christmas_trees_set_settings_sections_fields([
	        'rs_trees' => ['rs_christmas_trees_set_trees_settings', 'rs_christmas_trees_set_trees_sections', 'rs_christmas_trees_set_trees_fields'],
	        'rs_snow' => ['rs_christmas_trees_set_snow_settings', 'rs_christmas_trees_set_snow_sections', 'rs_christmas_trees_set_snow_fields'],
	         
	    ]);

	    // Register settings
	    $this->rs_christmas_trees_register_settings($this->treesSettings);
	    $this->rs_christmas_trees_register_settings($this->snowSettings);
	   

	    // Add sections
	    $this->rs_christmas_trees_add_sections($this->treesSections);
	    $this->rs_christmas_trees_add_sections($this->snowSections);
	 

	    // Add fields
	    $this->rs_christmas_trees_add_fields($this->treesFields);
	    $this->rs_christmas_trees_add_fields($this->snowFields);
	  
	}

	private function rs_christmas_trees_set_settings_sections_fields($sections) {
	    foreach ($sections as $prefix => $methods) {
	        foreach ($methods as $method) {
	            $this->{$method}();
	            $this->{$prefix . 'Settings'} = isset($this->{$prefix . 'Settings'}) ? $this->{$prefix . 'Settings'} : [];
	            $this->{$prefix . 'Sections'} = isset($this->{$prefix . 'Sections'}) ? $this->{$prefix . 'Sections'} : [];
	            $this->{$prefix . 'Fields'} = isset($this->{$prefix . 'Fields'}) ? $this->{$prefix . 'Fields'} : [];
	        }
	    }
	}

	private function rs_christmas_trees_register_settings($settings) {
	    foreach ($settings as $setting) {
	        register_setting($setting["option_group"], $setting["option_name"], $setting["callback"] ?? '');
	    }
	}

	private function rs_christmas_trees_add_sections($sections) {
	    foreach ($sections as $section) {
	        if (!array_key_exists('title', $section)) $section['title'] = '';
	        add_settings_section($section["id"], $section["title"], $section["callback"] ?? '', $section["page"]);
	    }
	}
 
	private function rs_christmas_trees_add_fields($fields) {
	    foreach ($fields as $field) {
	        add_settings_field($field["id"], $field["title"], $field["callback"] ?? '', $field["page"], $field["section"], $field["args"] ?? '');
	    }
	}

	//      call back of trees_display_set.
 
    public function rs_christmas_trees_display_set(){
        $value = esc_attr(get_option( 'rs_christmas_trees_display_set' ));
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Trees display set", "rs-christmas-trees").' :</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo '<label><input type="radio" id="rs_christmas_trees_display_set_top_btn" class="regular-text" name="rs_christmas_trees_display_set" value="1" '.($value ==1 ? 'checked' : '').'>'.esc_html__("Top trees", "rs-christmas-trees").' </label>';
        echo '<label><input type="radio" id="rs_christmas_trees_display_set_bottom_btn" class="regular-text" name="rs_christmas_trees_display_set" value="2" '.($value ==2 ? 'checked' : '').'>'.esc_html__("Bottom trees", "rs-christmas-trees").'</label>';
        echo '<label><input type="radio" id="rs_christmas_trees_display_set_both_btn" class="regular-text" name="rs_christmas_trees_display_set" value="3" '.($value ==3 ? 'checked' : '').'>'.esc_html__("Both trees", "rs-christmas-trees").'</label>';
        echo '</div>';
        echo '</div>';
    }
    //      call back of trees_hide_click_activation.
 
    public function rs_christmas_trees_hide_click_activation(){
        $value = esc_attr(get_option( 'rs_christmas_trees_hide_click_activation' ));
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Trees hide by click is active", "rs-christmas-trees").'? :</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo "<input type=\"checkbox\" id=\"trees_hide_click_activation\" class=\"regular-text\" name=\"rs_christmas_trees_hide_click_activation\" value=\"1\" ".($value == 1? "checked" : "").">";
        echo '</div>';
        echo '</div>';
    }
	//      call back of trees_active.
 
    public function rs_christmas_trees_active_tree(){
        $value = esc_attr(get_option('rs_christmas_trees_active_tree'));
       
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Active tree", "rs-christmas-trees").' :</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo '<label><input type="radio" class="regular-text" name="rs_christmas_trees_active_tree" value="1" '.($value ==1 ? 'checked' : '').'>'.esc_html__("Yes", "rs-christmas-trees").'</label>';
        echo '<label><input type="radio" class="regular-text" name="rs_christmas_trees_active_tree" value="0" '.($value == 0 ? 'checked' : '').'>'.esc_html__("No", "rs-christmas-trees").'</label>';
        echo '</div>';
        echo '</div>';
    }
	//      call back of trees_display_type.
 
    public function rs_christmas_trees_display_type() {
	    $value = esc_attr(get_option('rs_christmas_trees_display_type'));
	    $path = dirname(__FILE__);
	    $path = str_replace("admin", "public", $path) . '/images/trees-decoration/header';
	    $url = plugin_dir_url(__FILE__);
	    $url = str_replace("admin", "public", $url) . 'images/trees-decoration/header';
	    $images = scandir($path);
	    $j = 1;

	    echo '<div class="rs_trees-overflow" id="rs_christmas_trees_display_set_top">';
	    echo '<div class="c-label">';
	    echo '<h3 valign="top">' . esc_html__("Display type top", "rs-christmas-trees") . ' :</h3>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    
	    for ($i = 0; $i < count($images); $i++) {
	        if ($images[$i] != '.' && $images[$i] != '..') {
	            echo '<p><label><input type="radio" class="regular-text" name="rs_christmas_trees_display_type" value="' . esc_attr($images[$i]) . '" ' . checked($value, $images[$i], false) . '><span>' . esc_html__("Top Decoration", "rs-christmas-trees") . ' ' . esc_html($j) . '</span><img src="' . esc_url($url . "/" . esc_attr($images[$i])) . '"></label></p>';
	            $j++;
	        }
	    }

	    echo '</div>';
	    echo '</div>';
	}

	//      call back of trees_display_type_footer.
 
	public function rs_christmas_trees_display_type_footer() {
	    $value = esc_attr(get_option('rs_christmas_trees_display_type_footer'));
	    $path = dirname(__FILE__);
	    $path = str_replace("admin", "public", $path) . '/images/trees-decoration/footer';
	    $url = plugin_dir_url(__FILE__);
	    $url = str_replace("admin", "public", $url) . 'images/trees-decoration/footer';
	    $images = scandir($path);
	    $j = 1;
	    echo '<div class="rs_trees-bottom-overflow" id="rs_christmas_trees_display_set_bottom">';
	    echo '<div class="c-label">';
	    echo '<h3 valign="top">' . esc_html__("Display type footer", "rs-christmas-trees") . ':</h3>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    for ($i = 0; $i < count($images); $i++) {
	        if ($images[$i] != '.' && $images[$i] != '..') {
	            echo '<p><label><input type="radio" class="regular-text" name="rs_christmas_trees_display_type_footer" value="' . esc_attr($images[$i]) . '" ' . checked($value, $images[$i], false) . '><span>' . esc_html__("Footer Decoration", "rs-christmas-trees") . ' ' . esc_html($j) . '</span><img src="' . esc_url($url . "/" . $images[$i]) . '"></label></p>';
	            $j++;
	        }
	    }
	    echo '</div>';
	    echo '</div>';
	}

	//      call back of trees_display_location.
 
    public function rs_christmas_trees_display_location(){
        $value = esc_attr( get_option( 'rs_christmas_trees_display_location' ) );
        echo '<div id="trees_display_location">';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Display location", "rs-christmas-trees").':</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo "<label><input type=\"radio\" class=\"regular-text\" name=\"rs_christmas_trees_display_location\" value=\"2\" ".($value == 2? "checked" : "").">".esc_html__("Bottom", "rs-christmas-trees")." </label>";
        echo "<label><input type=\"radio\" class=\"regular-text\" name=\"rs_christmas_trees_display_location\" value=\"1\" ".($value == 1? "checked" : "").">".esc_html__("Top", "rs-christmas-trees")."</label>";
        echo '</div>';
        echo '</div>';
    }
	//      call back of trees_sticky.
 
    public function rs_christmas_trees_sticky(){
        $value = esc_attr( get_option( 'rs_christmas_trees_sticky' ) );
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3> '.esc_html__("It is sticky", "rs-christmas-trees").' :</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo "<label><input type=\"radio\" class=\"regular-text\" name=\"rs_christmas_trees_sticky\" value=\"1\" ".($value == 1? "checked" : "").">".esc_html__("Yes", "rs-christmas-trees")."</label>";
        echo "<label><input type=\"radio\" class=\"regular-text\" name=\"rs_christmas_trees_sticky\" value=\"0\" ".($value == 0? "checked" : "").">".esc_html__("No", "rs-christmas-trees")."</label>";
        echo '</div>';
        echo '</div>';
    }
	//      call back of display_snow.
 
    public function rs_display_snow(){
        $value = esc_attr( get_option( 'rs_display_snow' ) );
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Display snow", "rs-christmas-trees").':</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo "<input type=\"checkbox\" id=\"rs_display_snow\" class=\"regular-text\" name=\"rs_display_snow\" value=\"1\" ".($value == 1? "checked" : "").">";
        echo '</div>';
        echo '</div>';
    }
	//      call back of maximum_fall_speed.
 
    public function rs_display_norma_snow_or_3d(){
        $value = esc_attr( get_option( 'rs_display_norma_snow_or_3d' ) );
        echo '<div>';
        echo '<div class="c-label">';
        echo '<h3>'.esc_html__("Snow options", "rs-christmas-trees").':</h3>';
        echo '</div>';
        echo '<div class="rs_christmas_trees_label_value">';
        echo '<select name="rs_display_norma_snow_or_3d" class="fall-input">';
            echo "<option value='1' ".($value == 1 ? "selected" : "")."  > Normal Snow </option>";
            echo "<option value='2' ".($value == 2 ? "selected" : "")."  > 3D Snow </option>";       
        echo '</select>';
        echo '</div>';
        echo '</div>';
    }


	//      call back of maximum_fall_speed.
 
    public function rs_maximum_fall_speed() {
	    $value = esc_attr(get_option('rs_maximum_fall_speed'));
	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_maximum_fall_speed" class="fall-label">' . esc_html__("Maximum falling speed", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<input class="fall-input" type="text" id="rs_maximum_fall_speed" name="rs_maximum_fall_speed" value="' . esc_attr($value) . '">';
	    echo '</div>';
	    echo '</div>';
	}

	//      call back of flake_minimum_size.
 
    public function rs_flake_minimum_size() {
	    $value = esc_attr(get_option('rs_flake_minimum_size'));
	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_flake_minimum_size" class="fall-label">' . esc_html__("Flake minimal size", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<input type="text" class="fall-input" id="rs_flake_minimum_size" name="rs_flake_minimum_size" value="' . esc_attr($value) . '">';
	    echo '</div>';
	    echo '</div>';
	}

	//      call back of flake_maximum_size.
 
    public function rs_flake_maximum_size() {
	    $value = esc_attr(get_option('rs_flake_maximum_size'));

	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_flake_maximum_size" class="fall-label">' . esc_html__("Flake maximal size", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<input class="fall-input" type="text" id="rs_flake_maximum_size" name="rs_flake_maximum_size" value="' . esc_attr($value) . '">';
	    echo '</div>';
	    echo '</div>';
	}

	//      call back of show_on_page.
 
    public function rs_show_on_page() {
	    $args = array(
	        'post_type' => 'page',
	        'post_status' => 'publish'
	    );
	    $pages = get_pages($args);
	    $values = get_option('rs_show_on_page', array());
	    
	    echo '<div class="d-block">';
	    echo '<div class="c-label">';
	    echo '<label for="rs_show_on_page" class="fall-label">' . esc_html__("Show on page", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<ul>';
	    
	    foreach ($pages as $page) {
            if ($values != '') {
                $checked = "";
                if(in_array($page->ID,$values)){
                    $checked = "checked";
                }
                echo "<li><input type=\"checkbox\" id=\"number\" ". esc_attr($checked) ." name=\"rs_show_on_page[]\" value=".esc_attr($page->ID).">". esc_attr($page->post_name)."</li>";
            }else {
                echo "<li><input type=\"checkbox\" id=\"number\"  name=\"rs_show_on_page[]\" value=".esc_attr($page->ID).">".esc_attr($page->post_name)."</li>";
            }
        }
	    
	    echo '</ul>';
	    echo '</div>';
	    echo '</div>';
	}

	//      call back of show_flake_type.
 
 	public function rs_show_flake_type() {
	    $value = esc_attr(get_option('rs_show_flake_type'));

	    $flake_types = [
	        '&#10034;', '&#10035;', '&#10042;', '&#10043;', '&#10044;', '&#10045;', '&#10051;', '&#10057;',
	        '&#10058;', '&#10059;', '&#10046;', '&#10047;', '&#10048;', '&#10049;', '&#10052;', '&#10053;',
	        '&#1645;', '&#9733;', '&#9734;', '&#10017;', '&#10022;', '&#10023;', '&#10025;', '&#10026;',
	        '&#10027;', '&#10028;', '&#10029;', '&#10030;', '&#10031;', '&#10032;', '&#10036;', '&#10037;',
	        '&#10038;', '&#10039;', '&#10040;', '&#10041;'
	    ];

	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_show_flake_type" class="fall-label">' . esc_html__("Show flake type", "rs-christmas-trees") . ' :</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<select name="rs_show_flake_type" class="fall-input">';
	    echo '<option value="' . esc_attr($value) . '" ' . selected($value, $value, false) . '>' . esc_html($value) . '</option>';

	    foreach ($flake_types as $flake) {
	        echo '<option value="' . esc_attr($flake) . '">' . esc_html(html_entity_decode($flake, ENT_QUOTES, 'UTF-8')) . '</option>';
	    }

	    echo '</select>';
	    echo '</div>';
	    echo '</div>';
	}



	//      call back of show_z_index. 

    public function rs_show_z_index() {
	    $value = esc_attr(get_option('rs_show_z_index'));

	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_show_z_index" class="fall-label">' . esc_html__("Show z index", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<input class="fall-input" type="text" id="rs_show_z_index" name="rs_show_z_index" value="' . esc_attr($value) . '">';
	    echo '</div>';
	    echo '</div>';
	}


	//      call back of show_color.
 
    public function rs_show_color() {
	    $value = esc_attr(get_option('rs_show_color')); 
	    echo '<div>';
	    echo '<div class="c-label">';
	    echo '<label for="rs_show_color" class="fall-label">' . esc_html__("Show color", "rs-christmas-trees") . ':</label>';
	    echo '</div>';
	    echo '<div class="rs_christmas_trees_label_value">';
	    echo '<input class="fall-input jscolor" type="text" id="rs_show_color" name="rs_show_color" value="' . esc_attr($value) . '">';
	    echo '</div>';
	    echo '</div>';
	}

 
 
 
	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-christmas-trees-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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
		wp_enqueue_script( $this->plugin_name.'color-jquery-plugin', plugin_dir_url( __FILE__ ) . 'js/jscolor.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-christmas-trees-admin.js', array( 'jquery' ), $this->version, false );

	}

}