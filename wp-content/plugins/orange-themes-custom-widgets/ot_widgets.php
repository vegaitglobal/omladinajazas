<?php
	/*
	Plugin Name: 	Orange Themes Custom Widgets
	Plugin URI: 	http://www.orange-themes.com/
	Description: 	Orange Themes Custom Widget Plugin
	Version: 		1.0.4
	Author: 		Orange Themes
	Author URI: 	http://www.orange-themes.com/
	Domain Path:    /languages
	Text Domain:	orange-themes-custom-widgets
	License: GPLv3 or later
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	*/

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	if ( !class_exists('OT_Widgets') ) {

		class OT_Widgets {
			public static $instance = null;

		    /**
		     * Theme name used mostly for prefixes in the system
		     * @var string
		     */
		    public $plugin_name = 'orange_themes_widgets';
		 
		    /**
		     * Theme name used for displaying (pretty version)
		     * @var string
		     */
		    public $plugin_full_name = false;

		    public $icons;

		    public static function init() {

		        $class = __CLASS__;
		        new $class;

		    }

		    function __construct() {
		    	add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ));
		    	add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ));
		    	
		    	

		  		$this->plugin_full_name('[OT]');

		  		$this->icons = new OT_Widgets_Icons();


				if (!defined('OT_WIDGETS_CSS_URL')) {
					define( 'OT_WIDGETS_CSS_URL', plugin_dir_url( __FILE__ ).'css/' );
				}

				if (!defined('OT_WIDGETS_JS_URL')) {
					define( 'OT_WIDGETS_JS_URL', plugin_dir_url( __FILE__ ).'js/' );
				}
		
				add_action( 'customize_preview_init', array( $this, 'load_admin_scripts' ));


				add_image_size( 'ot-widgets-latest-posts-thumbnail', 150, 150, true );
		    }

			/**
			 * Access the single instance of this class
			 * @return Orange Themes Widgets
			 */
			public static function get_instance() {
				
				if ( self::$instance==null ) {
					self::$instance = new OT_Widgets();
				}

				return self::$instance;
			}

			/**
			 * Set Plugins name 
			 * @return Orange Themes Widgets Name
			 */
			public function plugin_full_name($name) {
				return  $this->plugin_full_name = apply_filters( 'ot_widgets_full_name', $name );

			}

			/**
			 * Add widget
			 */
			public function add($name) {
				return register_widget($name);
			}

			/**
			 * Remove widget
			 */
			public function remove($name) {
				return unregister_widget($name);
			}

			/**
			 * Replace widget
			 */
			public function replace($name) {
				unregister_widget($name);
				return register_widget($name);
			}

			/**
			 * Load all needed css and js files
			 */
			function load_scripts() { 

				wp_enqueue_style("font-awesome", "//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
				wp_enqueue_style("ot-widget-style", OT_WIDGETS_CSS_URL."style-plugins.css");

			}

			/**
			 * Load all needed admin css and js files
			 */
			function load_admin_scripts() { 

				wp_enqueue_media();
		        wp_enqueue_style( 'wp-color-picker' );
		        wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script("ot-widgets" , OT_WIDGETS_JS_URL."admin/ot-widgets.js", Array('jquery') );

			}


		}

	}


	if ( ! function_exists('ot_widgets') ) {
		function ot_widgets() {
			// Instantiate the class
			$ot_widgets = OT_Widgets::get_instance();
			return $ot_widgets;

		}
	}
	

	/**
	 * Autoloader
	 *
	 * Automatically load files when their classes are required.
	 */
	
	spl_autoload_register( 'ot_widgets_register_classes' );

	function ot_widgets_register_classes( $class_name ) {
		//check if it's our class
		if (strpos(strtolower($class_name), 'ot_widgets') !== false) {

			if ( class_exists( $class_name ) ) {
				return;
			}


			$class_path = plugin_dir_path( __FILE__ )."widgets/". strtolower( str_replace( '_', '-', str_replace( 'ot_widgets_', '', $class_name ) ) ) . '.php';

			//load the needed class file
			if ( file_exists( $class_path ) ) {
				include $class_path;
			} else {
				$class_path = plugin_dir_path( __FILE__ )."inc/". strtolower( str_replace( '_', '-', str_replace( 'ot_widgets_', '', strtolower($class_name) ) ) ) . '.php';

				if ( file_exists( $class_path ) ) {
					include $class_path;
				}
			}

		}
	}

	if ( ! defined( 'OT_WIDGETS'  ) ) {
		define( "OT_WIDGETS", true );
	}


	//run the plugin
	add_action( 'plugins_loaded', array( 'OT_Widgets', 'init' ));
	
	//register widgets
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_features' );
	});
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_team' );
	});
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_latest_posts' );
	});
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_social' );
	});
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_about_author' );
	});
	add_action( 'widgets_init', function(){
		register_widget( 'ot_widgets_ad_widget' );
	});