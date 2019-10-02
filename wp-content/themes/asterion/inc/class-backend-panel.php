<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class Asterion_Backend_panel {

		var $sub_section = array(
			'getting_started', 
			'changelog'
		);

		var $sub_additional_section = array(
			'demo_content'
		);


		var $options = array();


	    public function __construct() {
	    	add_action('admin_menu', array( $this, 'panel_section' ));

	    	if( isset( $_GET['page'] ) && $_GET['page'] == "asterion-panel" ) {
				//load all backend scripts
				add_action( 'admin_enqueue_scripts',  array( $this, 'enqueue_scripts' ) );	
	    	}

			add_action('admin_init',  array( $this, 'add_new_section' ));

	    }

		/**
		* Add new section if Orange Front Page is installed
		*/
		public function add_new_section() {
			if( asterion()->customizer->ot_orange_inactive_callback() == false ) {
			
				$this->sub_section = array_merge($this->sub_section,$this->sub_additional_section);	
				
			}
		}
 

		/**
		* Load all neede theme backend css and js codes
		*/
		public function enqueue_scripts() {

			// orange themes panel
			wp_enqueue_style( 'asterion-orange-panel', get_template_directory_uri() . '/css/admin/orange-panel.css' );
			wp_enqueue_script("jquery-ui-tabs");
			wp_enqueue_script( 'asterion-orange-panel', get_template_directory_uri() . '/js/admin/backend.js' );


			wp_localize_script( 'asterion-orange-panel', 'asterion', array(
				'admin_url' => admin_url( 'admin-ajax.php' ),
				'security' => wp_create_nonce( 'asterion-action')
			) );
		}


		function panel_section( ) {
			add_theme_page( esc_html__("Asterion Dashboard", 'asterion'), esc_html__("Asterion Dashboard", 'asterion'), 'administrator', 'asterion-panel', array( $this, 'asterion_panel' ));
		}


		protected function _get_plugin_basename_from_slug( $slug ) {
			$keys = array_keys( asterion()->tgmpa->get_plugins() );

			foreach ( $keys as $key ) {
				if ( preg_match( '|^' . $slug . '/|', $key ) ) {
					return $key;
				}
			}

			return $slug;
		}


		function check_recomended_plugins() {


			//get recomended plugins list
			$required_plugins = asterion()->required_plugins();
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



		function print_header() {
		?>
			<div class="ot-control-header">
				<div class="ot-control-container">
					<div class="ot-logo">
						<img src="<?php echo esc_url(get_template_directory_uri()."/images/backend/mooz-logo.png");?>">
					</div>
					<div class="ot-submenu">
						<span>
							<a href="https://moozthemes.com/asterion-wordpress-theme/" target="_blank">
								<?php esc_html_e("Need Help?", "asterion");?>
							</a>
						</span>
						<span>
							<a href="http://mozthemes.com/asterion/" target="_blank">
								<?php esc_html_e("Theme Demo", "asterion");?>
							</a>
						</span>
						<span>
							<a href="https://moozthemes.com/contact/" target="_blank">
								<?php esc_html_e("Send us Feedback", "asterion");?>
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
			$changelog = $wp_filesystem->get_contents( get_template_directory().'/readme.txt' );
			$changelog_lines = explode( PHP_EOL, $changelog );

			$asterion = wp_get_theme( 'asterion' );

		?>
			<div class="ot-center">
				<h1 class="ot-welcome-title">
					<?php esc_html_e("Asterion", "asterion");?> 
					<?php if( !empty($asterion['Version']) ): ?> 
						<sup id="asterion-version">
							<?php echo esc_attr( $asterion['Version'] ); ?> 
						</sup>
					<?php endif; ?>
				</h1>
			</div>
		<?php
			$change_log = false;
			foreach( $changelog_lines as $changelog_line ) {

				if(strpos($changelog_line, '==== THEME CHANGELOG ====') !== false || $change_log == true ) {
					if( substr( $changelog_line, 0, 2 ) === "= " ) {
						echo '<hr /><h2>'.substr( $changelog_line, -8, 5 ).'</h2>';
					} else if( substr( $changelog_line, 0, 4 ) !== "====" ) {
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


		function asterion_panel( ) {
			//load all panel section files
			foreach ( $this->sub_section as $section) {
				if ( in_array( $section, $this->sub_additional_section ) && asterion()->customizer->ot_orange_inactive_callback() == false ) {
					$backend_path = OT_FRONT_PAGE_INC_PATH."backend/".str_replace( '_', '-', $section ) . '.php';
					include $backend_path;
				} else {
					get_template_part("inc/backend/".str_replace( '_', '-', $section ));
				}
			}

			//create the panel content
			$this->print_header();
			$this->print_options();
			$this->print_footer();

		}
	}

?>