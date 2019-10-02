<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class OT_Front_Page_Posts {
	   
	    public function __construct() {

	    
	    }


	    /**
	     * generates terms layout
	     * @return  terms layout
	     */

	    function terms( $tax, $echo = false ) {

			$terms = get_the_terms( get_the_ID(), $tax );
			$term_count = count( $terms );
			$i = 1;

			$_terms = "";

			if( $term_count > 0 && !empty($terms)) {
				foreach ( $terms as $term ) {

					$_terms.= esc_html($term->name);

					if( $term_count != $i ) {
						$_terms.= ', ';
					}
					$i++;
				}

				if( $echo !=false ) {
					echo $_terms;
				} else {
					return $_terms;
				}

			} else {
				return false;
			}


	    }

	}

?>