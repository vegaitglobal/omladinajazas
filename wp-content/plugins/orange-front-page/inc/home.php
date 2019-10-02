<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class OT_Front_Page_Home {
	   
	    public function __construct() {


	    }


		function sections() {

	    	$sections = array(
	    		esc_html__( 'About', 'orange-front-page' ),
	    		esc_html__( 'Features', 'orange-front-page' ),
	    		esc_html__( 'Portfolio', 'orange-front-page' ),
	    		esc_html__( 'Counters', 'orange-front-page' ),
	    		esc_html__( 'Testimonials', 'orange-front-page' ),
	    		esc_html__( 'Latest Posts', 'orange-front-page' ),
	    		esc_html__( 'Team', 'orange-front-page' ),
	    		esc_html__( 'Contact us', 'orange-front-page' )
	    	);

	    	return $sections;
	    }

	    function section_order() {

	    	$sections = $this->sections();

	    	$section_order = array();

	    	foreach( $sections as $key => $section) {
	    		$section_order[$key+1][0] = $section;	
	    		$section_order[$key+1][1] = $this->number_to_word($key+1);	
	    	}

	    	return $section_order;

	    }


	    function number_to_word( $nr ) {
	    	switch ( $nr ) {
	    		case '1':
	    			return esc_html__( 'First', 'orange-front-page' );
	    			break;
	    		case '2':
	    			return esc_html__( 'Second', 'orange-front-page' );
	    			break;
	    		case '3':
	    			return esc_html__( 'Third', 'orange-front-page' );
	    			break;
	    		case '4':
	    			return esc_html__( 'Forth', 'orange-front-page' );
	    			break;
	    		case '5':
	    			return esc_html__( 'Fifth', 'orange-front-page' );
	    			break;
	    		case '6':
	    			return esc_html__( 'Sixth', 'orange-front-page' );
	    			break;
	    		case '7':
	    			return esc_html__( 'Seventh', 'orange-front-page' );
	    			break;
	    		case '8':
	    			return esc_html__( 'Eight', 'orange-front-page' );
	    			break;
	    		case '9':
	    			return esc_html__( 'Ninth', 'orange-front-page' );
	    			break;
	    		case '10':
	    			return esc_html__( 'Tenth', 'orange-front-page' );
	    			break;
	    	}
	    }


	    function section( $val ) {
	    	$sections = $this->section_order();

	    	foreach ( $sections as $key => $section) {


	    		$_section = ot_front_page()->options->get( strtolower(str_replace( ' ', '_', $section[0] )).'_show' );;

	    		if( $val == $key && $_section == 1 ) {
	    			$file_path = plugin_dir_path( __FILE__ ).'../sections/'.strtolower(str_replace( ' ', '-', $section[0] )).".php";
	    			
	    			if ( file_exists( $file_path ) ) {
	    				include( $file_path );
	    			}
	    			
	    		}
	    	}

	    }


		function widget_counter( $sidebar_id ) {
			global $_wp_sidebars_widgets;
			if ( empty( $_wp_sidebars_widgets ) ) :
				$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
			endif;
			
			$sidebars_widgets_count = $_wp_sidebars_widgets;
			
			if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
				return $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			endif;

			return false;
		}
				


		function widget_counter_class( $sidebar_id ) {

			$widget_count = $this->widget_counter( $sidebar_id );

			if( $widget_count != false ) { 
				$widget_classes = 'widget-count-' . $widget_count;
				if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
					// Four widgets er row if there are exactly four or more than six
					$widget_classes .= ' per-row-4';
				elseif ( $widget_count >= 3 ) :
					// Three widgets per row if there's three or more widgets 
					$widget_classes .= ' per-row-3';
				elseif ( 2 == $widget_count ) :
					// Otherwise show two widgets per row
					$widget_classes .= ' per-row-2';
				endif; 
				echo esc_attr($widget_classes);
			}

		
		}
					

	}

?>