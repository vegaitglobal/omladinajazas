<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	// THEME PATHS
	if ( ! defined( 'ASTERION_INC_PATH'  ) ) {
		define( "ASTERION_INC_PATH", trailingslashit( get_template_directory()."/inc/" ) );
	}


	/**
	* Autoloader
	*
	* Automatically load files when their classes are required.
	*/
	spl_autoload_register( 'asterion_register_classes' );
	function asterion_register_classes( $class_name ) {

		if ( strpos( $class_name, 'Asterion' ) !== false ) {

			if ( class_exists( $class_name ) ) {
				return;
			}

			if( $class_name != 'Asterion' ) {
				$file_name = strtolower( str_replace( '_', '-', str_replace( 'Asterion', '', $class_name ) ) );	
			} else {
				$file_name = '-asterion';
			}
			

			$class_path = ASTERION_INC_PATH . 'class' .$file_name. '.php';

			if ( file_exists( $class_path ) ) {
				include $class_path;
			}
		} else {

			$class_path = ASTERION_INC_PATH .$class_name. '.php';
			if ( file_exists( $class_path ) ) {
				include $class_path;
			}


		}

		include ASTERION_INC_PATH ."class-tgm-plugin-activation.php";
	}


	if ( ! function_exists( 'asterion' ) ) {
		
		function asterion() {
			// Instantiate the class
			$orange_themes = Asterion::get_instance();
			return $orange_themes;

		}

	}


	$orange_themes = asterion();


?>