<?php

	/**
	* Orange Themes Framework
	*/

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class Asterion {
	    /**
	     * Theme name used mostly for prefixes in the system
	     * @var string
	     */
	    public $theme_name = 'asterion';
	 
	    /**
	     * Theme name used for displaying (pretty version)
	     * @var string
	     */
	    public $theme_full_name = 'Asterion';

	    public static $instance = null;

	    public $posts;
	    public $customizer;
	    public $panel;
	    public $tgmpa;


		private function __construct() {
			//load all scripts
			add_action( 'wp_enqueue_scripts',  array( $this, 'enqueue_scripts' ) );


			//register all theme sidebars
			add_action( 'widgets_init',  array( $this, 'register_sidebars' ) );

			//sets up theme defaults and registers support for various WordPress features.
			add_action( 'after_setup_theme',  array( $this, 'after_setup_theme' ) );

			add_action( 'customize_preview_init', array( $this, 'customizer' ) );

			
			//include custom theme css code
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_css' ) );

			//register all theme plugins
			add_action( 'tgmpa_register', array($this,'register_required_plugins') );

			// Add specific CSS class by filter
			add_filter( 'body_class', array( $this, 'body_class') );


			// Instantiate secondary classes
			$this->posts = new Asterion_Posts();
			$this->customizer = new Asterion_Customizer();
			$this->panel = new Asterion_Backend_panel();
			$this->tgmpa = new TGM_Plugin_Activation();

		}


		/**
		* Access the single instance of this class
		* @return Asterion
		*/
		public static function get_instance() {
			
			if ( self::$instance==null ) {
				self::$instance = new Asterion();
			}

			return self::$instance;
		}


		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * Create your own after_setup_theme() function to override in a child theme.
		 *
		 */
		public function after_setup_theme() {
			/*
			 * Make theme available for translation.
			 */
			load_theme_textdomain( 'asterion', get_template_directory() . '/languages' );


			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );


			/*
			 * Enable support for custom logo.
			 *
			 */
			add_theme_support( 'custom-logo', array(
				'height'      => 46,
				'width'       => 280,
				'flex-height' => true,
			) );


			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 1200, 9999 );
			add_image_size( 'asterion-single-thumbnail', 750, 550, true );
			add_image_size( 'asterion-single-full-thumbnail', 1140, 660, true );
			add_image_size( 'asterion-blog-full-thumbnail', 1140, 660, true );
			add_image_size( 'asterion-blog-thumbnail', 750, 500, true );



			// This theme uses wp_nav_menu() in two locations.
			register_nav_menus( array(
				'main-menu' => esc_html__( 'Main Menu', 'asterion' ),
			) );


			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );


			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			) );

			add_theme_support( 'automatic-feed-links' );

			$GLOBALS['content_width'] = apply_filters( 'asterion_content_width', 640 );


			add_theme_support( 'custom-header', array(
				'default-image'  => esc_url( get_template_directory_uri() . '/images/bg.jpg' ),
				'width'          => 1920,
				'height'         => 532,
				'flex-height'    => true,
				'random-default' => false,
				'header-text'    => false,
			) );


			add_editor_style('asterion-google-fonts');


			//add_theme_support( 'custom-background', array('default-color'	=> '#f1f1f1',) );

			//enable jetpack custom post types
			if( get_option('jetpack_ot_theme_adjust') != 1 ) {
				update_option('jetpack_portfolio', 1);
				update_option('jetpack_testimonial', 1);
				update_option('jetpack_ot_theme_adjust', 1);
			}


			 add_theme_support( 'customize-selective-refresh-widgets' );

		}



		/**
		* Load all neede theme css and js codes
		*/
		public function enqueue_scripts() {
			

			wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css' );
			wp_enqueue_style( 'asterion-main-style', get_template_directory_uri().'/css/main-style.css' );

			// Add Google Fonts
			wp_enqueue_style( 'asterion-google-fonts', '//fonts.googleapis.com/css?family=Lora:400,400italic|Open+Sans:400,700|Merriweather:300,400,500,700');

			// Add main theme stylesheet
			wp_enqueue_style( 'asterion-style', get_stylesheet_uri() );

			// Add JS Files
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'sticky-js', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery') );
			wp_enqueue_script( 'asterion-js', get_template_directory_uri() . '/js/asterion.js', array('jquery') );

			// Threaded comments
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
	

		}

		/**
		 * Add body class
		 *
		 * @return body $classes array
		 */
		function body_class($classes) {

			if( is_front_page() && !is_home() ) {
				$classes[] = "no-sidebar";	
			} else if( is_front_page() && is_home() ) {
				if( !is_active_sidebar('sidebar-1') ) {
					$classes[] = "no-sidebar";	
				}
			}  else if( is_home() ) {
				if( !is_active_sidebar('blog-sidebar') ) {
					$classes[] = "no-sidebar";	
				}
			} else if( is_single() && get_post_type() == "post" ) {
				if( !is_active_sidebar('blog-sidebar') ) {
					$classes[] = "no-sidebar";	
				}
			} else if( is_singular() && get_post_type() == "page" ) {
				if( !is_active_sidebar('page-sidebar') ) {
					$classes[] = "no-sidebar";	
				}	
			} else if( is_singular() ) {
				if( !is_active_sidebar('sidebar-1') ) {
					$classes[] = "no-sidebar";	
				}
			}


			if( is_404() ) {
				$classes[] = "no-sidebar";	
			}
			

			if( is_page_template('page-templates/no-sidebar.php') || is_page_template('page-templates/clean-page.php') ) {
				$classes[] = "no-sidebar";	
			}
			if( is_page_template('page-templates/left-sidebar.php') ) {
				$classes[] = "left-sidebar";	
			}


			// return the $classes array
			return $classes;
		}

		/**
		* register customizer scripts
		*/
		function customizer() {

		    wp_enqueue_script( 'asterion_customize', get_template_directory_uri(). '/js/admin/customizer.js', array( 'customize-preview' ), '20120206', true  );

		}

		/**
		* theme required plugins
		*/
		function required_plugins() {

			$plugins = array(


				array(
					'name'     				=> esc_html__( 'Orange Themes Custom Widgets', 'asterion' ), // The plugin name
					'slug'     				=> 'orange-themes-custom-widgets', // The plugin slug (typically the folder name)
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '1.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
					'is_callable'        	=> true,
				),
				array(
					'name'     				=> esc_html__( 'Orange Front Page', 'asterion' ), // The plugin name
					'slug'     				=> 'orange-front-page', // The plugin slug (typically the folder name)
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
					'is_callable'        	=> true,
				),

				array(
					'name'     				=> esc_html__( 'Contact Form 7', 'asterion' ), // The plugin name
					'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
					'is_callable'        	=> true,
				),	
			
				array(
					'name'     				=> esc_html__( 'JetPack', 'asterion' ), // The plugin name
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
					'page_title'                      => esc_html__( 'Install Required Plugins', 'asterion' ),
					'menu_title'                      => esc_html__( 'Install Plugins', 'asterion' ),
					'installing'                      => esc_html__( 'Installing Plugin: %s', 'asterion' ), // %s = plugin name.
					'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'asterion' ),
					'notice_can_install_required'     => _n_noop(
						'This theme requires the following plugin: %1$s.',
						'This theme requires the following plugins: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop(
						'This theme recommends the following plugin: %1$s.',
						'This theme recommends the following plugins: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop(
						'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop(
						'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
						'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_ask_to_update_maybe'      => _n_noop(
						'There is an update available for: %1$s.',
						'There are updates available for the following plugins: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop(
						'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop(
						'The following required plugin is currently inactive: %1$s.',
						'The following required plugins are currently inactive: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop(
						'The following recommended plugin is currently inactive: %1$s.',
						'The following recommended plugins are currently inactive: %1$s.',
						'asterion'
					), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop(
						'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
						'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
						'asterion'
					), // %1$s = plugin name(s).
					'install_link'                    => _n_noop(
						'Begin installing plugin',
						'Begin installing plugins',
						'asterion'
					),
					'update_link' 					  => _n_noop(
						'Begin updating plugin',
						'Begin updating plugins',
						'asterion'
					),
					'activate_link'                   => _n_noop(
						'Begin activating plugin',
						'Begin activating plugins',
						'asterion'
					),
					'return'                          => esc_html__( 'Return to Required Plugins Installer', 'asterion' ),
					'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'asterion' ),
					'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'asterion' ),
					'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'asterion' ),  // %1$s = plugin name(s).
					'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'asterion' ),  // %1$s = plugin name(s).
					'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'asterion' ), // %s = dashboard link.
					'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'asterion' ),
					'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				),
					);
			tgmpa( $plugins, $config );
		}


		/**
		* Register all sidebars
		*/
		public function register_sidebars() {
			
	        register_sidebar( 
	            array(
	                'name' => esc_html__( 'Sidebar', 'asterion' ),
	                'id' => 'sidebar-1',
	                'description' => esc_html__( 'Main homepage widgets section', 'asterion' ),
	                'before_widget' => '<div id="%1$s" class="ot-widget widget %2$s">',
	                'after_widget' => '</div>',
					'before_title' => '<h2 class="ot-widget-title"><span>',
					'after_title'  => '</span></h2>',
	            )
	        );


			register_sidebar( 
				array(
					'name'          => esc_html__( 'Blog Sidebar', 'asterion' ),
					'id'            => 'blog-sidebar',
					'description'   => esc_html__( 'Main blog widgets section', 'asterion' ),
	                'before_widget' => '<div id="%1$s" class="ot-widget widget %2$s">',
	                'after_widget' => '</div>',
					'before_title' => '<h2 class="ot-widget-title"><span>',
					'after_title'  => '</span></h2>',
				) 
			);


			register_sidebar( 
				array(
					'name'          => esc_html__( 'Page Sidebar', 'asterion' ),
					'id'            => 'page-sidebar',
					'description'   => esc_html__( 'Page widgets section', 'asterion' ),
	                'before_widget' => '<div id="%1$s" class="ot-widget widget %2$s">',
	                'after_widget' => '</div>',
					'before_title' => '<h2 class="ot-widget-title"><span>',
					'after_title'  => '</span></h2>',
				) 
			);




	
		}


		/**
		* custom asterion css
		*/
		function custom_css() {
			ob_start();
		    $accent_color = get_theme_mod('asterion_accent_color', '#00afa4');
		    $hover_color = get_theme_mod('asterion_hover_color', '#fbcc3f');

		?>
			/* accent color*/

			.intro-image h3:after { background-color: <?php echo esc_attr($accent_color);?>; }
			.slick-dots li.slick-active button:before { background-color: <?php echo esc_attr($accent_color);?>; }
			.page-numbers .current { background-color: <?php echo esc_attr($accent_color);?>; border-color: <?php echo esc_attr($accent_color);?>; }
			.comment-reply-link, .comment-reply-login { color: <?php echo esc_attr($accent_color);?>; }
			/* hover color */

			.btn:hover, .wpcf7-submit:hover, .wpcf7-submit:focus, .wpcf7-submit:active, .btn:focus, .btn:active, .btn.active, .open .dropdown-toggle.btn { background-color: <?php echo esc_attr($hover_color);?>; border-color: <?php echo esc_attr($hover_color);?>; }

			.btn-xl:hover, .btn-xl:focus, .btn-xl:active, .btn-xl.active, .open .dropdown-toggle.btn-xl { background-color: <?php echo esc_attr($hover_color);?>; border-color: <?php echo esc_attr($hover_color);?>; }

			.navbar-default .nav li a:after { border-color: <?php echo esc_attr($hover_color);?>; }

			#back-top a:hover { background-color: <?php echo esc_attr($hover_color);?>; }

			.page-numbers li a:hover { background-color: <?php echo esc_attr($hover_color);?>; border-color: <?php echo esc_attr($hover_color);?>; }

			.blog-post .blog-post-body a:hover { color: <?php echo esc_attr($hover_color);?>; }

			a:hover, a:focus, a:active, a.active { color: <?php echo esc_attr($hover_color);?>; }

			.post-navigation .nav-links a:hover { color: <?php echo esc_attr($hover_color);?>; }

			.ot-sidebar .widget ul li a:hover { color: <?php echo esc_attr($hover_color);?>; }

		<?php
			$custom_css = ob_get_contents();
			ob_end_clean();

		    wp_add_inline_style( 'asterion-style', $custom_css );
		}

		


	}

?>