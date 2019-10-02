/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	"use strict";


	/***********************************************/
	/******************  GENERAL  *****************/
	/***********************************************/

	// Copyright
	wp.customize( 'asterion_copyright', function( value ) {
		value.bind( function( to ) {

			$( '.ot-footer .ot-copyright' ).html( to );
		} );
	} );


	/***********************************************/
	/******************  HEADER   *****************/
	/***********************************************/

	// Header image 
	wp.customize( 'asterion_intro_image', function( value ) {
		value.bind( function( to ) {
			if( to !== false ) {
				$( '#header' ).css( "background-image", 'url(' + to + ')' );	
			} else {
				$( '#header' ).css( "background-image", 'none' );	
			}
			
		} );
	} );

	// image parallax
	wp.customize( 'asterion_intro_image_parallax', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#header' ).removeClass( 'intro-parallax' );
			} else if( to == true ) {
				$( '#header' ).addClass( 'intro-parallax' );
			}
		} );
	} );

	// image overlay
	wp.customize( 'asterion_intro_image_overlay', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#header .slider-container' ).removeClass( 'dark-overlay' );
			} else if( to == true ) {
				$( '#header .slider-container' ).addClass( 'dark-overlay' );
			}
		} );
	} );

	// Header image title 1
	wp.customize( 'asterion_header_title_1', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text h3.intro-lead-in' ).html( to );
		} );
	} );

	// Header image title 2
	wp.customize( 'asterion_header_title_2', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text h2.intro-heading' ).html( to );
		} );
	} );

	// Header Button Title
	wp.customize( 'asterion_header_button_title', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text a' ).html( to );
		} );
	} );

	// Header Button URL
	wp.customize( 'asterion_header_button_url', function( value ) {
		value.bind( function( to ) {
			$( '.slider-container .intro-text a' ).attr( 'href', to );
		} );
	} );

	// Header Button target
	wp.customize( 'asterion_header_button_target', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.slider-container .intro-text a' ).attr( 'target', '_self' );
			} else if( to == true ) {
				$( '.slider-container .intro-text a' ).attr( 'target', '_blank' );
			}
		} );
	} );


	// single post image
	wp.customize( 'asterion_single_post_image', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .blog-post-image' ).hide();
			} else if( to == true ) {
				$( '.single-post .blog-post-image' ).show();
			}
		} );
	} );


	// single post data
	wp.customize( 'asterion_single_post_date', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-date' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-date' ).show();
			}
		} );
	} );
	// single post author
	wp.customize( 'asterion_single_post_author', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-author' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-author' ).show();
			}
		} );
	} );
	// single post tags
	wp.customize( 'asterion_single_post_tags', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .mz-entry-tags' ).hide();
			} else if( to == true ) {
				$( '.single-post .mz-entry-tags' ).show();
			}
		} );
	} );
	// single post categories
	wp.customize( 'asterion_single_post_cat', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.single-post .ot-post-cats' ).hide();
			} else if( to == true ) {
				$( '.single-post .ot-post-cats' ).show();
			}
		} );
	} );


	// blog listing post image
	wp.customize( 'asterion_blog_post_image', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .blog-post-image' ).hide();
			} else if( to == true ) {
				$( '.blog .blog-post-image' ).show();
			}
		} );
	} );

	// blog listing post categories
	wp.customize( 'asterion_blog_post_cat', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-cats' ).hide();
			} else if( to == true ) {
				$( '.blog .ot-post-cats' ).show();
			}
		} );
	} );

	// blog listing post date
	wp.customize( 'asterion_blog_post_date', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-date' ).hide();
			} else if( to == true ) {
				$( '.blog .ot-post-date' ).show();
			}
		} );
	} );
	// blog listing post comments
	wp.customize( 'asterion_blog_post_comment', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.blog .ot-post-comments' ).hide();

			} else if( to == true ) {
				$( '.blog .ot-post-comments' ).show();

			}
		} );
	} );

	// main menu style
	wp.customize( 'asterion_menu_style', function( value ) {
		value.bind( function( to ) {
			if( to == 2 ) {
				$( 'header' ).addClass('ot-light-text').removeClass('ot-dark-text');
			} else {
				$( 'header' ).addClass('ot-dark-text').removeClass('ot-light-text');

			}
		} );
	} );
	// main menu background style
	wp.customize( 'asterion_menu_bg_style', function( value ) {
		value.bind( function( to ) {
			if( to == 2 ) {
				$( 'header div.navbar' ).addClass('ot-dark-menu').removeClass('ot-light-menu');
			} else {
				$( 'header div.navbar' ).addClass('ot-light-menu').removeClass('ot-dark-menu');

			}
		} );
	} );
	// main menu position
	wp.customize( 'asterion_menu_position', function( value ) {
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
	wp.customize( 'asterion_counters_show', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '#counters' ).removeClass( 'customizer-display-none' );
			}
		} );
	} );

	// Title 1 
	wp.customize( 'asterion_counters_title_1', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-1 h6' ).html( to );
		} );
	} );

	// Count 1 
	wp.customize( 'asterion_counters_count_1', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-1 h2' ).html( to );
			$( '#counters .ot-counter-nr-1 h2' ).data('n', to );
		} );
	} );

	// Title 2 
	wp.customize( 'asterion_counters_title_2', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-2 h6' ).html( to );
		} );
	} );

	// Count 2 
	wp.customize( 'asterion_counters_count_2', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-2 h2' ).html( to );
			$( '#counters .ot-counter-nr-2 h2' ).data('n', to );
		} );
	} );

	// Title 3
	wp.customize( 'asterion_counters_title_3', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-3 h6' ).html( to );
		} );
	} );

	// Count 3 
	wp.customize( 'asterion_counters_count_3', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-3 h2' ).html( to );
			$( '#counters .ot-counter-nr-3 h2' ).data('n', to );
		} );
	} );

	// Title 4
	wp.customize( 'asterion_counters_title_4', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-4 h6' ).html( to );
		} );
	} );

	// Count 4 
	wp.customize( 'asterion_counters_count_4', function( value ) {
		value.bind( function( to ) {
			$( '#counters .ot-counter-nr-4 h2' ).html( to );
			$( '#counters .ot-counter-nr-4 h2' ).data('n', to );
		} );
	} );


	//bg type
	wp.customize( 'asterion_counters_bg_type', function( value ) {
		value.bind( function( to ) {

			if( to == 2 ) {

				$( '#counters' ).css( "background-image", 'none' );	
				$( '#counters' ).css( 'background-color', wp.customize._value.asterion_counters_bg_color() );

				// section color
				wp.customize( 'asterion_counters_bg_color', function( value ) {
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
				$( '#counters' ).css( "background-image", 'url(' + wp.customize._value.asterion_counters_bg_image() + ')' );	

				// section image
				wp.customize( 'asterion_counters_bg_image', function( value ) {
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
	wp.customize( 'asterion_counters_image_parallax', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters' ).removeClass( 'intro-parallax' );
			} else if( to == true ) {
				$( '#counters' ).addClass( 'intro-parallax' );
			}
		} );
	} );

	// image overlay
	wp.customize( 'asterion_counters_image_overlay', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '#counters .short-section' ).removeClass( 'dark-overlay' );
			} else if( to == true ) {
				$( '#counters .short-section' ).addClass( 'dark-overlay' );
			}
		} );
	} );

	// section text color
	wp.customize( 'asterion_counters_text_color', function( value ) {
		value.bind( function( to ) {
			if( to != false ) {
				$( '#counters' ).addClass( 'text-light' ).removeClass( 'text-dark' );
			} else {
				$( '#counters' ).addClass( 'text-dark' ).removeClass( 'text-light' );
			}
		} );
	} );


} )( jQuery );