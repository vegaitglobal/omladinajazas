<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class OT_Front_Page_Backend_Panel {

		var $sub_section = array(
			'getting_started', 
			'changelog',
			'demo_content'
		);
		var $options = array();


	    public function __construct() {
	    	add_action('admin_menu', array( $this, 'panel_section' ));


			add_action('wp_ajax_orange_front_page_reset_settings',  array( $this, 'reset_settings' ));

			add_action( 'admin_init', array($this,'handle_import_action') );
			add_action( 'admin_action_orange_front_page_import_demo', array($this,'import_demo') );
			//export
			add_action( 'admin_action_orange_front_page_export_widgets', array($this,'export_widgets') );
	    	add_action( 'admin_action_orange_front_page_export_management', array($this,'export_management') );
			//upload import file
			add_action( 'admin_action_orange_front_page_upload_demo', array($this,'upload_demo') );
	    }

		/**
		* Reset theme settings
		*/
		public function reset_settings() {

			if ( isset($_REQUEST) && isset($_REQUEST['nonce']) ) {
				check_ajax_referer( 'orange-front-page-action', 'nonce' );

				if(is_multisite()) { 
					update_site_option('Orange_Front_Page_'.get_current_blog_id(),'');
				} else {
					update_option('Orange_Front_Page','');
				}

				update_option( 'otfp_front_page_imported', 0 );

			}

			wp_die();
		}


		/**
		 * Import widgets
		 *
		 * @param string $content       JSON encoded widgets data.
		 *
		 * @return bool
		 */

		public static function import_widgets( $content ) {
			
			$widgets = json_decode( $content, true );

			if ( $widgets && is_array( $widgets ) ) {
				$sidebars_array      	= get_option( 'sidebars_widgets' );
				//$sidebars_array      	= '';
	
				foreach ( $widgets as $sidebar_id => $sidebar_widgets ) {
					foreach ( $sidebar_widgets as $widget_id => $widget_data ) {

						// $widget_id eg. "recent-comments-4".
						$name_parts   = explode( '-', $widget_id );     // $name_parts is an array with keys: recent, comments, 4
						$widget_index = array_pop( $name_parts );       // pop the '4' element off the end of array
						$widget_group = implode( '-', $name_parts );    // merge back existing elements

						$widget_group_data = get_option( 'widget_' . $widget_group );

						// If widget with the same index exists, use next free index.
						if ( isset( $widget_group_data[ $widget_index ] ) ) {
							$offset = max( array_keys( $widget_group_data ) ) + 1;

							$widget_index += $offset;
						}

						$widget_group_data[ $widget_index ] = $widget_data;

						// Save widget data.
						update_option( 'widget_' . $widget_group, $widget_group_data );

						// Assign widget to sidebar.
						if ( ! isset( $sidebars_array[ $sidebar_id ] ) ) {
							$sidebars_array[ $sidebar_id ] = array();
						}

						$sidebars_array[ $sidebar_id ][] = $widget_id;
					}
				}

				// Save widget to sidebar relation.
				update_option( 'sidebars_widgets', $sidebars_array );

				
				return true;
			}

			wp_die();
		}

		function panel_section( ) {
			if( ot_front_page()->supported_themes() == false ) {
				add_theme_page( esc_html__("Orange Front Page Dashboard", 'orange-front-page'), esc_html__("Orange Front Page Dashboard", 'orange-front-page'), 'administrator', 'orange-front-page-panel', array( $this, 'orange_front_page_panel' ));
			}
		}


		protected function _get_plugin_basename_from_slug( $slug ) {
			$keys = array_keys( ot_front_page()->tgmpa->get_plugins() );

			foreach ( $keys as $key ) {
				if ( preg_match( '|^' . $slug . '/|', $key ) ) {
					return $key;
				}
			}

			return $slug;
		}


		function check_recomended_plugins() {


			//get recomended plugins list
			$required_plugins = ot_front_page()->required_plugins();
			$active_plugin_count = 0;

			//count recomended plugins 
			$recomended_plugin_count = count($required_plugins);

			//count active recomended plugins 
			foreach ( $required_plugins as $key => $plugin ) {
				if ( ( ! empty( $plugin['is_callable'] ) && is_callable( $plugin['is_callable'] ) ) || is_plugin_active( $this->_get_plugin_basename_from_slug( $plugin['slug'] ) ) ) {
					$active_plugin_count++;
				}
			}

			return ( $active_plugin_count == $recomended_plugin_count ) ? true : false;


		}


		function add_options( $options ) {
			foreach( $options as $option ) {
				$this->options[] = $option;
			}
		}


		function print_options(){
			foreach ( $this->options as $option ) {
				$this->print_options_switch( $option['type'], $option );
			}
		}
	

		function print_options_switch( $switch_value, $array_value) {

			switch ( $switch_value ) {

				case 'section_start':
					$this->print_section_start( $array_value );
				break;

				case 'section_end':
					$this->print_section_end( $array_value );
				break;

				case 'section_content':
					$this->print_section_content( $array_value );
				break;
	
				case 'changelog':
					$this->print_changelog();
				break;
			
			}
		}

		/**
		 * Export data
		 *
		 * @return array
		 */
		public function export_management() {

			if($_GET['ot-export-type']=="orange-front-page") {
				if(is_multisite()) { 
					$data = get_site_option('Orange_Front_Page_'.get_current_blog_id());
				} else {
					$data = get_option('Orange_Front_Page');
				}

			}

			$this->download_settings($data);
			return true;
		}


		/**
		 * Export widgets
		 *
		 * @return array
		 */
		public function export_widgets() {
			$sidebars_array = get_option( 'sidebars_widgets' );
			$exported       = array();

			foreach ( $sidebars_array as $sidebar => $widgets ) {
				if ( 'wp_inactive_widgets' === $sidebar ) {
					continue;
				}

				if ( ! empty( $widgets ) && is_array( $widgets ) ) {
					$exported[ $sidebar ] = array();

					foreach ( $widgets as $sidebar_widget ) {
						// $sidebar_widget eg. "recent-comments-4".
						$name_parts   = explode( '-', $sidebar_widget );    // $name_parts is an array with keys: recent, comments, 4
						$widget_index = array_pop( $name_parts );           // Pop the '4' element off the end of array.
						$widget_group = implode( '-', $name_parts );        // Merge back existing elements.

						$widget_group_data = get_option( 'widget_' . $widget_group );

						$widget_data = $widget_group_data[ $widget_index ];

						$exported[ $sidebar ][ $sidebar_widget ] = $widget_data;
					}
				}
			}

			$this->download_settings($exported);
			return true;
		}

		/**
		 * Download export file
		 */
		function download_settings($data) {
			if ( isset( $_GET['download'] ) && isset( $_GET['file_name'] ) && "1" === $_GET['download'] ) { // Input var okey.
			    $exportfile = $_GET['file_name'].".json";

			    // Set the headers to force a download
			    header('Content-type: application/force-download');
			    header('Content-Disposition: attachment; filename="'.str_replace(' ', '_', $exportfile).'"');

			    
				die(json_encode($data));
			}
		}

		/**
		 * Upload import file
		 */
		function upload_demo() {

			// Check export file if any
			if(isset($_FILES['ot_import']['tmp_name'])) {

				if ( ! function_exists( 'wp_handle_upload' ) ) {
				    require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				$overrides = array( 'test_form' => false, 'test_type' => false );
				$upload = wp_handle_upload($_FILES['ot_import'],$overrides);

				if ( isset( $upload['error'] ) ) {
					return $upload;
				}
			
				
				if($_GET['ot-export-type']=="orange-front-page") {

					$this->import_options_from_file($upload['file']);

				} else if($_GET['ot-export-type']=="orange-front-page-widgets") {

					$this->import_widgets_from_file($upload['file']);

				}
				
			}
		}

		/**
		 * Import management options from file
		 *
		 * @param string $path      Path to file.
		 *
		 * @return bool
		 */
		public static function import_options_from_file( $path ) {
			WP_Filesystem();

			/**
			 * Safe way to access filesystem
			 *
			 * @var WP_Filesystem_Base $wp_filesystem
			 */
			global $wp_filesystem;

			$content = $wp_filesystem->get_contents( $path );

			if ( false === $content ) {
				return false;
			}

			return self::import_options( $content );
		}

		/**
		 * Import widgets from file
		 *
		 * @param string $path      File path.
		 *
		 * @return bool
		 */
		public static function import_widgets_from_file( $path ) {
			WP_Filesystem();

			/**
			 * Dafe way to access filesystem
			 *
			 * @var WP_Filesystem_Base $wp_filesystem
			 */
			global $wp_filesystem;

			$content = $wp_filesystem->get_contents( $path );

			if ( false === $content ) {
				return false;
			}

			return self::import_widgets( $content );
		}

		/**
		 * Import options into database
		 *
		 * @param string $content       JSON encoded string.
		 *
		 * @return bool
		 */
		public static function import_options( $content ) {
			if(!$parsed = json_decode($content, true)) {
				$parsed = unserialize($content);
			}

			if(is_array($parsed)) {
		
				if(is_multisite()) {
					update_site_option('Orange_Front_Page_'.get_current_blog_id(),$parsed); 
				} else {
					update_option('Orange_Front_Page',$parsed);	
				}
				update_option('otfp_front_page_imported','1');	
				return true;
			}

			return false;
		}

		/**
		 * Load WP Importers (if plugin Wordpress Importer active) but prevent admin import action
		 */
		function handle_import_action() {
			// -- Explanation
			// if $_GET['import'] is set, WP defines the WP_LOAD_IMPORTERS const (in wp-admin/admin.php).
			// This, in turn, loads WP_Import class and triggers admin import action.
			// We want to use only WP_Import class to import our demo content, import action is redundant.
			// To achieve this, we have to unset $_GET['import'] after defining const but before action call.
			// The "admin_init" hook is a right place to do that.
			if ( isset( $_GET['import'] ) && 'orange-front-page' === $_GET['import'] ) { // Input var okey.
				unset( $_GET['import'] ); // Input var okey.
			}
		}

		/**
		* import demo content
		*/
		function import_demo() {
			$allowed_types = array( 'orange-front-page', 'orange-front-page-widgets');
			$type          = isset( $_GET['import-type'] ) ? sanitize_text_field( wp_unslash( $_GET['import-type'] ) ) : ''; // input var okey.

			if ( ! in_array( $type, $allowed_types, true ) ) {
				wp_die(
					'<h1>' . esc_html__( 'Cheatin&#8217; uh?', 'orange-front-page' ) . '</h1>
					<p>' . sprintf( esc_html__( 'Demo data import type not allowed. Allowed values: %s.', 'orange-front-page' ), esc_html( implode( ', ', $allowed_types ) ) ) . '</p>',
					403
				);
			}

			$response = null;

			switch ( $type ) {
				case 'orange-front-page':
					$response = $this->import_management_settings();
					break;
				case 'orange-front-page-widgets':
					$response = $this->import_widgets_data();
					break;
			}

			set_transient( 'orange_front_page_import_demo_response', $response );
			if( ot_front_page()->supported_themes() != false ) {
				wp_redirect( admin_url( 'themes.php?page='.ot_front_page()->supported_themes().'-panel' ) );
			} else {
				wp_redirect( admin_url( 'themes.php?page=orange-front-page-panel' ) );	
			}
			
		}


		/**
		 * Import management and customizer panel settings
		 *
		 * @return array            Response status and message
		 */
		public function import_management_settings() {


			$demo_options_path = trailingslashit( plugin_dir_path( __FILE__ ) ) . '../dummy-data/orange-front-page.json';

			if ( self::import_options_from_file( $demo_options_path ) ) {
				$response = array(
					'status'  => 'success',
					'message' => esc_html__( 'Customizer options imported successfully.', 'orange-front-page' ),
				);
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import customizer options', 'orange-front-page' ),
				);
			}


			return $response;
		}


		/**
		 * Import widget data
		 *
		 * @return array            Response status and message
		 */
		public function import_widgets_data() {


			$demo_options_path = trailingslashit( plugin_dir_path( __FILE__ ) ) . '../dummy-data/orange-front-page-widgets.json';

			if ( self::import_widgets_from_file( $demo_options_path ) ) {
				$response = array(
					'status'  => 'success',
					'message' => esc_html__( 'Widgets imported successfully.', 'orange-front-page' ),
				);
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Widgets import failed.', 'orange-front-page' ),
				);
			}


			return $response;
		}

		function print_header() {
		?>
			<div class="ot-control-header">
				<div class="ot-control-container">
					<div class="ot-logo">
						<img src="<?php echo esc_url(plugin_dir_url( __FILE__ )."../images/backend/ot-logo.png");?>">
					</div>
					<div class="ot-submenu">
						<span>
							<a href="https://www.orange-themes.com/support/" target="_blank">
								<?php esc_html_e("Need Help?", "orange-front-page");?>
							</a>
						</span>
						<span>
							<a href="https://www.orange-themes.net/demo/orange-front-page/" target="_blank">
								<?php esc_html_e("Demo", "orange-front-page");?>
							</a>
						</span>
						<span>
							<a href="https://www.orange-themes.com/feedback/" target="_blank">
								<?php esc_html_e("Send us Feedback", "orange-front-page");?>
							</a>
						</span>
					</div>
				</div>
			</div>

			<div class="ot-control-panel">
				<div class="ot-control-container">
					<ul class="ot-nav-tabs" role="tablist">
		<?php
						foreach ( $this->options as $value ) :
							if( $value['type'] == 'navigation' ) :
		?>
								<li class="<?php if( isset( $value['class'] ) ) echo esc_attr( $value['class'] );?>">
									<a href="#<?php echo esc_attr( $value['slug'] );?>" aria-controls="<?php echo esc_attr( $value['slug'] );?>" role="tab" data-toggle="tab">
										<?php echo esc_html( $value['name'] );?>
									</a>
								</li>
		<?php
							endif;
						endforeach;
		?>
				</ul>

		<?php
		}


		function print_section_start( $value ) {
		?>
				<div id="<?php echo esc_attr( $value['slug'] );?>" class="ot-tab-content" style="min-height: 640px;">
		<?php
		}


		function print_section_content( $value ) {
		 	echo $value['content'];
		}


		function print_changelog() {

			WP_Filesystem();
			global $wp_filesystem;
			$changelog = $wp_filesystem->get_contents( plugin_dir_path( __FILE__ ).'../readme.txt' );
			$changelog_lines = explode( PHP_EOL, $changelog );

			$orange_front_page = get_plugin_data( plugin_dir_path( __FILE__ ).'../ot_front.php' );

		?>
			<div class="ot-center">
				<h1 class="ot-welcome-title">
					<?php esc_html_e("Orange Front Page", "orange-front-page");?> 
					<?php if( !empty($orange_front_page['Version']) ): ?> 
						<sup id="orange-front-page-version">
							<?php echo esc_attr( $orange_front_page['Version'] ); ?> 
						</sup>
					<?php endif; ?>
				</h1>
			</div>
		<?php
			$change_log = false;
			foreach( $changelog_lines as $changelog_line ) {

				if(strpos($changelog_line, '== Changelog ==') !== false || $change_log == true ) {
					if( substr( $changelog_line, 0, 2 ) === "= " ) {
						echo '<hr /><h2>'.substr( $changelog_line, -8, 5 ).'</h2>';
					} else if( substr( $changelog_line, 0, 2 ) !== "==" ) {
						echo $changelog_line,'<br/>';
					}

					$change_log = true;
				}

			}

		}


		function print_section_end( $value ) {
		?>
				</div>
		<?php
		}


		function print_footer() {
		?>
					</div>
				</div>
		<?php
		}


		function orange_front_page_panel( ) {
			//load all panel section files

			foreach ( $this->sub_section as $section) {
				$backend_path = plugin_dir_path( __FILE__ )."backend/".str_replace( '_', '-', $section ) . '.php';
				include $backend_path;
			}

			//create the panel content
			$this->print_header();
			$this->print_options();
			$this->print_footer();

		}
	}

?>