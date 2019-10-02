<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class OT_Front_Page_Customizer {
	   
	    public function __construct() {
	    	//register our customizer
			add_action( 'customize_register',  array( $this, 'register' ) );
	    
	    }

		function register( $wp_customize ) {

			// Add custom customizer controls
			require_once OT_FRONT_PAGE_INC_PATH . 'custom-controls.php';

			// General section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/order.php';
			// About section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/about.php';
			// Featured section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/features.php';
			// Portfolio section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/portfolio.php';
			// Counters section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/counters.php';
			// Testimonials section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/testimonials.php';
			// Team section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/team.php';
			// Latest posts section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/latest-posts.php';
			// Contact section options
			require_once OT_FRONT_PAGE_INC_PATH . 'customizer-sections/contact-us.php';			



		}
		

		function sanitize_html( $input ) {

			$allowed_html = array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'class' => array(),
					'id' 	=> array(),
					'alt' 	=> array(),
				),
				'br'     => array(
					'class' => array(),
					'id' 	=> array(),
				),
				'em'     => array(
					'class' => array(),
					'id' 	=> array(),
				),
				'img'    => array(
					'alt'    => array(),
					'src'    => array(),
					'srcset' => array(),
					'title'  => array(),
					'id' 	 => array(),
					'class'  => array(),
				),
				'strong' => array(
					'class' => array(),
					'id' 	=> array(),
				),
			);

			
			$input = force_balance_tags( $input );

			$output	= wp_kses( $input, $allowed_html );

			return $output;
		}		

		function sanitize_checkbox( $input ) {

			if ( $input == 1 ) {
				return 1;
			} else {
				return 0;
			}

		}

		function sanitize_radio( $input, $setting ) {
			global $wp_customize;

			$control = $wp_customize->get_control( $setting->id );

			if ( array_key_exists( $input, $control->choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}

        function cf7_active_callback() {

            if( class_exists( 'WPCF7' ) ) {
				return true;
			} else {
				return false;
            }

        }

        function cf7_inactive_callback() {

            if( !class_exists( 'WPCF7' ) ) {
				return true;
			} else {
				return false;
            }

        }

		function jetpack_testimonials_active_callback() {
			if ( post_type_exists( 'jetpack-testimonial' ) ) {
				return true;
			} else {
				return false;
			}
		}

		function jetpack_testimonials_inactive_callback() {
			if ( !post_type_exists( 'jetpack-testimonial' ) ) {
				return true;
			} else {
				return false;
			}
		}

		function jetpack_portfolio_active_callback() {
			if ( post_type_exists( 'jetpack-portfolio' ) ) {
				return true;
			} else {
				return false;
			}
		}
		function jetpack_portfolio_inactive_callback() {
			if ( !post_type_exists( 'jetpack-portfolio' ) ) {
				return true;
			} else {
				return false;
			}
		}

		function ot_widgets_active_callback() {
			if( class_exists( 'OT_Widgets' ) ) {
				return true;
			} else {
				return false;
			}
		}
		function ot_widgets_inactive_callback() {
			if( !class_exists( 'OT_Widgets' ) ) {
				return true;
			} else {
				return false;
			}
		}

	}

?>