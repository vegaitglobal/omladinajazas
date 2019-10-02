<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	class OT_Front_Page_Options {
	 
		public static $Management_Settings;

		function __construct() {

		}


		/**
		 * Custom Update Option
		 */
		function update($name, $value, $save=false) {
			if(isset($name)) {
				self::$Management_Settings[$name] = $value;
			}

			if(is_multisite()) { 
				update_site_option('Orange_Front_Page_'.get_current_blog_id(),self::$Management_Settings);
			} else {
				update_option('Orange_Front_Page',self::$Management_Settings);
			}

		}

		/**
		 * Custom Get Option
		 */
		function get($name, $default = false ) {
			global $wp_customize;


			if(isset($wp_customize)) {
				$Management_Settings = $this->get_all();
				return (isset($Management_Settings[$name])) ? $Management_Settings[$name] : '';	
			} else {

				if(!isset(self::$Management_Settings) || !self::$Management_Settings) {
					$Management_Settings = $this->get_all();

					self::$Management_Settings = $Management_Settings;
				}

			 	return (isset(self::$Management_Settings[$name])) ? self::$Management_Settings[$name] : $default;	
			}

		}

		/**
		 * Custom Delete Option
		 */
		function delete($name, $save=false) {

			if(isset($name)) {
				unset(self::$Management_Settings[$name]);
			}

			if(is_multisite()) { 
				update_site_option('Orange_Front_Page_'.get_current_blog_id(),self::$Management_Settings);
			} else {
				update_option('Orange_Front_Page',self::$Management_Settings);
			}

		}

		/**
		 * Custom Get All Option
		 */
		function get_all() {
			global $wp_customize;

			if(!isset(self::$Management_Settings) || !self::$Management_Settings) {
				if(is_multisite()) { 
					$Management_Settings = get_site_option('Orange_Front_Page_'.get_current_blog_id());
					if( $Management_Settings == "" ) {
						$Management_Settings = get_option('Orange_Front_Page');
					}
				} else {
					$Management_Settings = get_option('Orange_Front_Page');
				}

				self::$Management_Settings = $Management_Settings;
			}

			if(isset($wp_customize)) {
				return get_option('Orange_Front_Page');
			} else {
				return self::$Management_Settings;	
			}
		 	
		 	
		}

	}