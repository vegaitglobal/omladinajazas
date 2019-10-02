<?php
	/*
	Plugin Name: 	Orange Front Page
	Plugin URI: 	https://www.orange-themes.com/
	Description: 	Orange Themes Custom Front Page Plugin
	Version: 		1.0.3
	Author: 		Orange Themes
	Author URI: 	https://www.orange-themes.com/
	Domain Path:    /languages
	Text Domain:	orange-front-page
	License: GPLv3 or later
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	*/

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



	if ( !class_exists('OT_Front_Page') ) {

		class OT_Front_Page {
			public static $instance = null;

		    /**
		     * Theme name used mostly for prefixes in the system
		     * @var string
		     */
		    public $plugin_name = 'orange_themes_front_page';
		    public $plugin_prefix = 'otfp';
		 
		    /**
		     * Theme name used for displaying (pretty version)
		     * @var string
		     */
		    public $plugin_full_name = false;
		    public static $sections_loaded = false;
		    public $supported_themes = array('asterion');

		    public $home;
		    public $customizer;
		    public $posts;
		    public $panel;
		    public $tgmpa;
		    public $options;

		    public static function init() {
			    $class = __CLASS__;
			    new $class;
		    }

		    function __construct() {
				global $wp_customize;

				//reload option in customizer
				if ( isset( $wp_customize ) ) {
					add_action('get_header',  array( $this, 'get_options' ));
					add_action('wp_enqueue_scripts',  array( $this, 'get_options' ));
				}

				if (!defined('OT_FRONT_PAGE_INC_PATH')) {
					define( 'OT_FRONT_PAGE_INC_PATH', plugin_dir_path( __FILE__ ) ."inc/");
				}

				if (!defined('OT_FRONT_PAGE_CSS_URL')) {
					define( 'OT_FRONT_PAGE_CSS_URL', plugin_dir_url( __FILE__ ).'css/' );
				}

				if (!defined('OT_FRONT_PAGE_JS_URL')) {
					define( 'OT_FRONT_PAGE_JS_URL', plugin_dir_url( __FILE__ ).'js/' );
				}

				

				include OT_FRONT_PAGE_INC_PATH ."class-tgm-plugin-activation.php";

				add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ));
				add_action( 'customize_preview_init', array( $this, 'customizer' ) );

		    	
				//load all backend scripts
				add_action( 'admin_enqueue_scripts',  array( $this, 'load_admin_scripts' ) );	
		    	

				//register all theme sidebars
				add_action( 'widgets_init',  array( $this, 'register_sidebars' ) );


		    	$this->home = new OT_Front_Page_Home();
		    	$this->customizer = new OT_Front_Page_Customizer();
		    	$this->posts = new OT_Front_Page_Posts();
		    	$this->tgmpa = new TGM_Plugin_Activation();
		    	$this->panel = new OT_Front_Page_Backend_Panel();
		    	$this->options = new OT_Front_Page_Options();

				//register all theme plugins
				add_action( 'tgmpa_register', array($this,'register_required_plugins') );
				
		    	//migrate old theme options to the new
		    	$theme_slug = get_option( 'stylesheet' );
		    	if( $theme_slug == 'asterion' ) {
		    		$theme_mods = get_option( "theme_mods_$theme_slug" );
		    		$otfp_migrate = get_option( "otfp_migrate" );
		    		if( isset($theme_mods ) && $theme_mods != "" && $otfp_migrate!=1) {

			    		$new_options = array();
			    		foreach ($theme_mods as $key => $value) {
			    			$key_new = str_replace("asterion_","",$key);
			    			if($value) {
			    				$new_options[$key_new] = $value;
			    			}
			    			
			    		}
			    		update_option('Orange_Front_Page',$new_options);
			    		update_option('otfp_migrate', 1);

		    		}

		    	}

		    	add_action( 'plugins_loaded', array( $this, 'plugins_loadeds' ),20);

		    	
		    	add_action( 'orange_themes_front_page', array( $this, 'blocks' ), 10, 3 );
		    	
		   


		    }


			public static function plugins_loadeds() {

				load_plugin_textdomain( 'orange-front-page', false, basename(dirname( __FILE__ )). '/languages' ); 
				
				add_image_size( 'ot-front-page-portfolio', 360, 240, true );
				add_image_size( 'ot-front-page-portfolio-large', 800, 533, true );
				add_image_size( 'ot-front-page-testimonials', 90, 90, true );
				add_image_size( 'ot-front-page-latest-posts-front', 712, 474, true );

			}


			/**
			 * Access the single instance of this class
			 * @return Orange Themes Front Page
			 */
			public static function get_instance() {
				
				if ( self::$instance==null ) {
					self::$instance = new OT_Front_Page();
				}

				return self::$instance;
			}

			/**
			 * Set Plugins name 
			 * @return Orange Themes Front Page Name
			 */
			public function plugin_full_name($name) {
				return  $this->plugin_full_name = apply_filters( 'ot_front_page_full_name', $name );

			}


			/**
			 * Load all needed css and js files
			 */
			function load_scripts() { 

				wp_enqueue_style("font-awesome", "//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
				wp_enqueue_style( 'slick', OT_FRONT_PAGE_CSS_URL.'slick.css' );
				wp_enqueue_style("orange-front-page-style", OT_FRONT_PAGE_CSS_URL."orange-style.css");
				wp_enqueue_script( 'appear-js', OT_FRONT_PAGE_JS_URL . 'jquery.appear.js', array('jquery') );
				wp_enqueue_script( 'slick-slider', OT_FRONT_PAGE_JS_URL . 'slick.min.js' );
				wp_enqueue_script("orange-front-page", OT_FRONT_PAGE_JS_URL."orange-front-page.js");


			}

			/**
			 * Load all needed admin css and js files
			 */
			function load_admin_scripts() { 

				if( isset( $_GET['page'] ) && ( $_GET['page'] == "orange-front-page-panel" || $_GET['page'] == $this->supported_themes().'-panel' ) ) {

					// orange themes panel
					wp_enqueue_style( 'orange-front-page-orange-panel', OT_FRONT_PAGE_CSS_URL . 'admin/orange-panel.css' );
					wp_enqueue_script( "jquery-ui-tabs" );
					wp_enqueue_script( "ajaxupload" , OT_FRONT_PAGE_JS_URL."admin/ajaxupload.js" );
					wp_enqueue_script( 'orange-front-page-orange-panel', OT_FRONT_PAGE_JS_URL . 'admin/backend.js' );
					

					wp_localize_script( 'orange-front-page-orange-panel', 'orange_front_page', array(
						'admin_url' => admin_url( 'admin-ajax.php' ),
						'security' => wp_create_nonce( 'orange-front-page-action')
					) );

				}
			}

			/**
			* register customizer scripts
			*/
			function customizer() {

			    wp_enqueue_script( 'ot-front-page-customize', plugin_dir_url( __FILE__ ). 'js/admin/customizer.js', array( 'customize-preview' ), '20120206', true  );

			}
			
			/**
			 * Reload Options
			 * @return theme options
			 */
			public function get_options() {

				$this->options = new OT_Front_Page_Options();

				return $this->options;
			}

			/**
			* add block to the front page
			*/
			function blocks( ) {
				if( self::$sections_loaded != true ) {
					self::$sections_loaded = true;
					$sections = '';
					ob_start();
					for ( $i = 0; $i < 10; $i++ ) { 

						$section = ot_front_page()->options->get( 'section_order_'.$i);
						if( !$section  ) {
							$section = $i;
						}

						$home = ot_front_page()->home;

						if( $section ):
							$home->section( $section );
						endif;
						
					}

					$sections.= ob_get_contents();
					ob_end_clean();
					
					$before_sec = '<div class="orange-front-page">';
					$after_sec = '</div>';
					echo $before_sec.$sections.$after_sec;
				}


				
			}

			
			/**
			* required plugins
			*/
			function required_plugins() {

				$plugins = array(


					array(
						'name'     				=> esc_html__( 'Orange Themes Custom Widgets', 'orange-front-page' ), // The plugin name
						'slug'     				=> 'orange-themes-custom-widgets', // The plugin slug (typically the folder name)
						'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
						'version' 				=> '1.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
						'is_callable'        	=> true,
					),

					array(
						'name'     				=> esc_html__( 'Contact Form 7', 'orange-front-page' ), // The plugin name
						'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
						'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
						'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
						'is_callable'        	=> true,
					),	
				
					array(
						'name'     				=> esc_html__( 'JetPack', 'orange-front-page' ), // The plugin name
						'slug'     				=> 'jetpack', // The plugin slug (typically the folder name)
						'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
						'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
						'is_callable'        	=> true,
					),	
				

				);


				return $plugins;
			}




			/**
			 * Register the required plugins for this theme.
			 *
			 * In this example, we register two plugins - one included with the TGMPA library
			 * and one from the .org repo.
			 *
			 * The variable passed to tgmpa_register_plugins() should be an array of plugin
			 * arrays.
			 *
			 * This function is hooked into tgmpa_init, which is fired within the
			 * TGM_Plugin_Activation class constructor.
			 */
			function register_required_plugins() {

				/**
				 * Array of plugin arrays. Required keys are name and slug.
				 * If the source is NOT from the .org repo, then source is also required.
				 */
				$plugins = $this->required_plugins();

				/**
				 * Array of configuration settings. Amend each line as needed.
				 * If you want the default strings to be available under your own theme domain,
				 * leave the strings uncommented.
				 * Some of the strings are added into a sprintf, so see the comments at the
				 * end of each line for what each argument will be.
				 */
				$config = array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => true,                   // Automatically activate plugins after installation or not.
					'message'      => '',                      // Message to output right before the plugins table.
					
					'strings'      => array(
						'page_title'                      => esc_html__( 'Install Required Plugins', 'orange-front-page' ),
						'menu_title'                      => esc_html__( 'Install Plugins', 'orange-front-page' ),
						'installing'                      => esc_html__( 'Installing Plugin: %s', 'orange-front-page' ), // %s = plugin name.
						'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'orange-front-page' ),
						'notice_can_install_required'     => _n_noop(
							'This theme requires the following plugin: %1$s.',
							'This theme requires the following plugins: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_can_install_recommended'  => _n_noop(
							'This theme recommends the following plugin: %1$s.',
							'This theme recommends the following plugins: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_cannot_install'           => _n_noop(
							'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
							'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_ask_to_update'            => _n_noop(
							'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
							'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_ask_to_update_maybe'      => _n_noop(
							'There is an update available for: %1$s.',
							'There are updates available for the following plugins: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_cannot_update'            => _n_noop(
							'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
							'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_can_activate_required'    => _n_noop(
							'The following required plugin is currently inactive: %1$s.',
							'The following required plugins are currently inactive: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_can_activate_recommended' => _n_noop(
							'The following recommended plugin is currently inactive: %1$s.',
							'The following recommended plugins are currently inactive: %1$s.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'notice_cannot_activate'          => _n_noop(
							'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
							'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
							'orange-front-page'
						), // %1$s = plugin name(s).
						'install_link'                    => _n_noop(
							'Begin installing plugin',
							'Begin installing plugins',
							'orange-front-page'
						),
						'update_link' 					  => _n_noop(
							'Begin updating plugin',
							'Begin updating plugins',
							'orange-front-page'
						),
						'activate_link'                   => _n_noop(
							'Begin activating plugin',
							'Begin activating plugins',
							'orange-front-page'
						),
						'return'                          => esc_html__( 'Return to Required Plugins Installer', 'orange-front-page' ),
						'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'orange-front-page' ),
						'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'orange-front-page' ),
						'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'orange-front-page' ),  // %1$s = plugin name(s).
						'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'orange-front-page' ),  // %1$s = plugin name(s).
						'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'orange-front-page' ), // %s = dashboard link.
						'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'orange-front-page' ),
						'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
					),
						);
				tgmpa( $plugins, $config );
			}


			/**
			* Register all sidebars
			*/
			public function register_sidebars() {


				//front page sidebars 
				register_sidebar( 
					array(
						'name'          => esc_html__( 'Features Widget Area in Front Page', 'orange-front-page' ),
						'id'            => 'sidebar-features',
						'description'   => esc_html__( 'Front page features panel widgets section', 'orange-front-page' ),
		                'before_widget' => '<div id="%1$s" class="ot-widget widget %2$s">',
		                'after_widget' => '</div>',
						'before_title' => '<h2 class="ot-widget-title"><span>',
						'after_title'  => '</span></h2>',
					) 
				);
				register_sidebar( 
					array(
						'name'          => esc_html__( 'Team Widget Area in Front Page', 'orange-front-page' ),
						'id'            => 'sidebar-team',
						'description'   => esc_html__( 'Front page team panel widgets section', 'orange-front-page' ),
		                'before_widget' => '<div id="%1$s" class="ot-widget widget %2$s">',
		                'after_widget' => '</div>',
						'before_title' => '<h2 class="ot-widget-title"><span>',
						'after_title'  => '</span></h2>',
					) 
				);

			}


			/**
			* Supported orange themes
			*/
			public function supported_themes() {
				$supported_themes = $this->supported_themes;
				$theme = wp_get_theme( );

				if( in_array(strtolower($theme->get( 'Name' )), $supported_themes) ) {
					return strtolower($theme->get( 'Name' ));
				} else {
					return false;
				}

			}

		}

	}


	if ( ! function_exists('ot_front_page') ) {
		function ot_front_page() {
			// Instantiate the class
			$ot_front_page = OT_Front_Page::get_instance();
			return $ot_front_page;

		}
	}


	/**
	 * Autoloader
	 *
	 * Automatically load files when their classes are required.
	 */
	
	spl_autoload_register( 'ot_front_page_register_classes' );

	function ot_front_page_register_classes( $class_name ) {
		//check if it's our class
		if (strpos(strtolower($class_name), 'ot_front_page') !== false) {

			if ( class_exists( $class_name ) ) {
				return;
			}
			

			$class_path = plugin_dir_path( __FILE__ )."inc/". strtolower( str_replace( '_', '-', str_replace( 'ot_front_page_', '', strtolower($class_name) ) ) ) . '.php';

			if ( file_exists( $class_path ) ) {
				include $class_path;
			}


		}


	}


	//run the plugin
	add_action( 'plugins_loaded', array( 'OT_Front_Page', 'init' ));	

