/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	"use strict";
	/***********************************************/
	/******************  Features  *****************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[features_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#features' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#features' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[features_title]', function( value ) {
		value.bind( function( to ) {

			$( '#features .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[features_text]', function( value ) {
		value.bind( function( to ) {

			$( '#features .section-title p' ).html( to );
		} );
	} );


	// section color
	wp.customize( 'Orange_Front_Page[features_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#features' ).css( 'background-color', to );	
			} else {
				$( '#features' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[features_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#features' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#features' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );

	/***********************************************/
	/****************** Portfolio  *****************/
	/***********************************************/
	
	// Show this section
	wp.customize( 'Orange_Front_Page[portfolio_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#portfolio' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#portfolio' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[portfolio_title]', function( value ) {
		value.bind( function( to ) {

			$( '#portfolio .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[portfolio_text]', function( value ) {
		value.bind( function( to ) {

			$( '#portfolio .section-title p' ).html( to );
		} );
	} );

	// image hover effect
	wp.customize( 'Orange_Front_Page[portfolio_image_hover_effect]', function( value ) {
		value.bind( function( to ) {

			$( '#portfolio .ot-portfolio-item figure' ).attr( 'class', 'effect-'+to );
		} );
	} );

	// image overlay
	wp.customize( 'Orange_Front_Page[portfolio_image_overlay_color]', function( value ) {
		value.bind( function( to ) {

			$( '#portfolio .ot-portfolio-item figure' ).css( 'background-color', to );
		} );
	} );


	// section color
	wp.customize( 'Orange_Front_Page[portfolio_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#portfolio' ).css( 'background-color', to );	
			} else {
				$( '#portfolio' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[portfolio_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#portfolio' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#portfolio' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );

	/***********************************************/
	/****************** Testimonials  *****************/
	/***********************************************/
	
	// Show this section
	wp.customize( 'Orange_Front_Page[testimonials_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#testimonials' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#testimonials' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[testimonials_title]', function( value ) {
		value.bind( function( to ) {

			$( '#testimonials .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[testimonials_text]', function( value ) {
		value.bind( function( to ) {

			$( '#testimonials .section-title p' ).html( to );
		} );
	} );


	// section color
	wp.customize( 'Orange_Front_Page[testimonials_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#testimonials' ).css( 'background-color', to );	
			} else {
				$( '#testimonials' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[testimonials_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#testimonials' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#testimonials' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );

	/***********************************************/
	/******************  Team  *****************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[team_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#team' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#team' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[team_title]', function( value ) {
		value.bind( function( to ) {

			$( '#team .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[team_text]', function( value ) {
		value.bind( function( to ) {

			$( '#team .section-title p' ).html( to );
		} );
	} );


	// section color
	wp.customize( 'Orange_Front_Page[team_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#team' ).css( 'background-color', to );	
			} else {
				$( '#team' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[team_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#team' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#team' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );

	/***********************************************/
	/****************  Latest Posts  ***************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[latest_posts_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#latest-posts' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#latest-posts' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[latest_posts_title]', function( value ) {
		value.bind( function( to ) {

			$( '#latest-posts .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[latest_posts_text]', function( value ) {
		value.bind( function( to ) {

			$( '#latest-posts .section-title p' ).html( to );
		} );
	} );


	// section color
	wp.customize( 'Orange_Front_Page[latest_posts_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#latest-posts' ).css( 'background-color', to );	
			} else {
				$( '#latest-posts' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );

	// check bg color
	wp.customize( 'Orange_Front_Page[latest_posts_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to == "#fff" || to == "#ffffff") {
				$( '#latest-posts' ).addClass( 'ot-bg-white' );
			} else {
				$( '#latest-posts' ).removeClass( 'ot-bg-white' );
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[latest_posts_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#latest-posts' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#latest-posts' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );


	/***********************************************/
	/******************  About  *****************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[about_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#about' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#about' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[about_title]', function( value ) {
		value.bind( function( to ) {

			$( '#about .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[about_text]', function( value ) {
		value.bind( function( to ) {

			$( '#about .section-title p' ).html( to );
		} );
	} );



	// section color
	wp.customize( 'Orange_Front_Page[about_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#about' ).css( 'background-color', to );	
			} else {
				$( '#about' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[about_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#about' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#about' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );
	

	/***********************************************/
	/******************  CONTACT  *****************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[contact_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#contact' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#contact' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title
	wp.customize( 'Orange_Front_Page[contact_title]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .section-title h2' ).html( to );
		} );
	} );

	// Text
	wp.customize( 'Orange_Front_Page[contact_text]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .section-title p' ).html( to );
		} );
	} );

	// section color
	wp.customize( 'Orange_Front_Page[contact_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#contact' ).css( 'background-color', to );	
			} else {
				$( '#contact' ).css( 'background-color', '#ffffff' );	
			}
			
		} );
	} );


	// section text color
	wp.customize( 'Orange_Front_Page[contact_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#contact' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#contact' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );


	// Address title
	wp.customize( 'Orange_Front_Page[contact_address_title]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .address-details .ot-address .section-text h4' ).html( to );
		} );
	} );

	// Address 
	wp.customize( 'Orange_Front_Page[contact_address]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .address-details .ot-address .section-text p' ).html( to );
		} );
	} );

	// Contact info title 
	wp.customize( 'Orange_Front_Page[contact_info_title]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .address-details .ot-contact .section-text h4' ).html( to );
		} );
	} );

	// Contact info phone 
	wp.customize( 'Orange_Front_Page[contact_info_phone]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .address-details .ot-contact .section-text p.ot-phone span' ).html( to );
		} );
	} );

	// Contact info email 
	wp.customize( 'Orange_Front_Page[contact_info_email]', function( value ) {
		value.bind( function( to ) {

			$( '#contact .address-details .ot-contact .section-text p.ot-email span' ).html( to );
		} );
	} );

	/***********************************************/
	/******************  GENERAL  *****************/
	/***********************************************/

	// Copyright
	wp.customize( 'Orange_Front_Page[copyright]', function( value ) {
		value.bind( function( to ) {

			$( '.ot-footer .ot-copyright' ).html( to );
		} );
	} );


	/***********************************************/
	/******************  HEADER   *****************/
	/***********************************************/

	// Header image 
	wp.customize( 'Orange_Front_Page[intro_image]', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#header' ).css( "background-image", 'url(' + to + ')' );	
			} else {
				$( '#header' ).css( "background-image", 'none' );	
			}
			
		} );
	} );

	// image parallax
	wp.customize( 'Orange_Front_Page[intro_image_parallax]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#header' ).removeClass( 'intro-parallax' );
			} else if( to == true ) {
				$( '#header' ).addClass( 'intro-parallax' );
			}
		} );
	} );

	// image overlay
	wp.customize( 'Orange_Front_Page[intro_image_overlay]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#header .slider-container' ).removeClass( 'dark-overlay' );
			} else if( to == true ) {
				$( '#header .slider-container' ).addClass( 'dark-overlay' );
			}
		} );
	} );

	// Header image title 1
	wp.customize( 'Orange_Front_Page[header_title_1]', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text h3.intro-lead-in' ).html( to );
		} );
	} );

	// Header image title 2
	wp.customize( 'Orange_Front_Page[header_title_2]', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text h2.intro-heading' ).html( to );
		} );
	} );

	// Header Button Title
	wp.customize( 'Orange_Front_Page[header_button_title]', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text a' ).html( to );
		} );
	} );

	// Header Button URL
	wp.customize( 'Orange_Front_Page[header_button_url]', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text a' ).attr( 'href', to );
		} );
	} );

	// Header Button target
	wp.customize( 'Orange_Front_Page[header_button_target]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.slider-container .intro-text a' ).attr( 'target', '_self' );
			} else if( to == true ) {
				$( '.slider-container .intro-text a' ).attr( 'target', '_blank' );
			}
		} );
	} );


	// single post image
	wp.customize( 'Orange_Front_Page[single_post_image]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .blog-post-image' ).hide();
			} else if( to == true ) {
				$( '.single-post .blog-post-image' ).show();
			}
		} );
	} );


	// single post data
	wp.customize( 'Orange_Front_Page[single_post_date]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-date' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-date' ).show();
			}
		} );
	} );
	// single post author
	wp.customize( 'Orange_Front_Page[single_post_author]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-author' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-author' ).show();
			}
		} );
	} );
	// single post tags
	wp.customize( 'Orange_Front_Page[single_post_tags]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .mz-entry-tags' ).hide();
			} else if( to == true ) {
				$( '.single-post .mz-entry-tags' ).show();
			}
		} );
	} );
	// single post categories
	wp.customize( 'Orange_Front_Page[single_post_cat]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-cats' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-cats' ).show();
			}
		} );
	} );


	// blog listing post image
	wp.customize( 'Orange_Front_Page[blog_post_image]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .blog-post-image' ).hide();
			} else if( to == true ) {
				$( '.blog .blog-post-image' ).show();
			}
		} );
	} );

	// blog listing post categories
	wp.customize( 'Orange_Front_Page[blog_post_cat]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-cats' ).hide();
			} else if( to == true ) {
				$( '.blog .ot-post-cats' ).show();
			}
		} );
	} );

	// blog listing post date
	wp.customize( 'Orange_Front_Page[blog_post_date]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-date' ).hide();
			} else if( to == true ) {
				$( '.blog .ot-post-date' ).show();
			}
		} );
	} );
	// blog listing post comments
	wp.customize( 'Orange_Front_Page[blog_post_comment]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-comments' ).hide();

			} else if( to == true ) {
				$( '.blog .ot-post-comments' ).show();

			}
		} );
	} );

	// main menu style
	wp.customize( 'Orange_Front_Page[menu_style]', function( value ) {
		value.bind( function( to ) {
			if( to == 2 ) {
				$( 'header' ).addClass('ot-light-text').removeClass('ot-dark-text');
			} else {
				$( 'header' ).addClass('ot-dark-text').removeClass('ot-light-text');

			}
		} );
	} );
	// main menu position
	wp.customize( 'Orange_Front_Page[menu_position]', function( value ) {
		value.bind( function( to ) {
			if( to == 2 ) {
				$( '#header .navbar' ).removeClass('navbar-fixed-top');
			} else {
				$( '#header .navbar' ).addClass('navbar-fixed-top');

			}
		} );
	} );


	/***********************************************/
	/******************  COUNTERS  *****************/
	/***********************************************/

	// Show this section
	wp.customize( 'Orange_Front_Page[counters_show]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#counters' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title 1 
	wp.customize( 'Orange_Front_Page[counters_title_1]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-1 h6' ).html( to );
		} );
	} );

	// Count 1 
	wp.customize( 'Orange_Front_Page[counters_count_1]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-1 h2' ).html( to );
			$( '#counters .ot-counter-nr-1 h2' ).data('n', to );
		} );
	} );

	// Title 2 
	wp.customize( 'Orange_Front_Page[counters_title_2]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-2 h6' ).html( to );
		} );
	} );

	// Count 2 
	wp.customize( 'Orange_Front_Page[counters_count_2]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-2 h2' ).html( to );
			$( '#counters .ot-counter-nr-2 h2' ).data('n', to );
		} );
	} );

	// Title 3
	wp.customize( 'Orange_Front_Page[counters_title_3]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-3 h6' ).html( to );
		} );
	} );

	// Count 3 
	wp.customize( 'Orange_Front_Page[counters_count_3]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-3 h2' ).html( to );
			$( '#counters .ot-counter-nr-3 h2' ).data('n', to );
		} );
	} );

	// Title 4
	wp.customize( 'Orange_Front_Page[counters_title_4]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-4 h6' ).html( to );
		} );
	} );

	// Count 4 
	wp.customize( 'Orange_Front_Page[counters_count_4]', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-4 h2' ).html( to );
			$( '#counters .ot-counter-nr-4 h2' ).data('n', to );
		} );
	} );


	//bg type
	wp.customize( 'Orange_Front_Page[counters_bg_type]', function( value ) {
		value.bind( function( to ) {

			if( to == 2 ) {

				$( '#counters' ).css( "background-image", 'none' );
				$( '#counters' ).css( 'background-color', wp.customize._value["Orange_Front_Page[counters_bg_color]"]() );
				console.log(wp.customize._value["Orange_Front_Page[counters_bg_color]"]());
				// section color
				wp.customize( 'Orange_Front_Page[counters_bg_color]', function( value ) {
					value.bind( function( to ) {
						if( to !== false ) {
							$( '#counters' ).css( 'background-color', to );	
						} else {
							$( '#counters' ).css( 'background-color', '#ffffff' );	
						}
						
					} );
				} );

			}

			if( to == 1 ) {
				$( '#counters' ).css( "background-color", 'none' );	

				$( '#counters' ).css( "background-image", 'url(' + wp.customize._value["Orange_Front_Page[counters_bg_image]"]()+')' );	

				// section image
				wp.customize( 'Orange_Front_Page[counters_bg_image]', function( value ) {
					value.bind( function( to ) {
						if( to !== false ) {
							$( '#counters' ).css( "background-image", 'url(' + to + ')' );	
						} else {
							$( '#counters' ).css( "background-image", 'none' );	
						}
						
					} );
				} );
			}
		});

	});

	// image parallax
	wp.customize( 'Orange_Front_Page[counters_image_parallax]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters' ).removeClass( 'intro-parallax' );
			} else if( to == true ) {
				$( '#counters' ).addClass( 'intro-parallax' );
			}
		} );
	} );

	// image overlay
	wp.customize( 'Orange_Front_Page[counters_image_overlay]', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters .short-section' ).removeClass( 'dark-overlay' );
			} else if( to == true ) {
				$( '#counters .short-section' ).addClass( 'dark-overlay' );
			}
		} );
	} );

	// section text color
	wp.customize( 'Orange_Front_Page[counters_text_color]', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#counters' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#counters' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );
	
	// image overlay
	wp.customize( 'Orange_Front_Page[counters_bg_color]', function( value ) {
		value.bind( function( to ) {
			if( wp.customize._value["Orange_Front_Page[counters_bg_type]"]() == 2 ) {
				$( '#counters' ).css( "background-image", 'none' );
				$( '#counters' ).css( 'background-color', to );
		
			}

		} );
	} );


} )( jQuery );