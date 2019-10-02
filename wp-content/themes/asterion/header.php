<?php
	/**
	 *    The template for displaying the header.
	 *
	 * @package    WordPress
	 * @subpackage asterion
	 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$intro_image = get_theme_mod( 'asterion_intro_image', get_template_directory_uri() . '/images/bg.jpg' );

	if ( get_theme_mod('asterion_intro_image_parallax') ) {
		$parallax_class = " intro-parallax"; 
	} else { 
		$parallax_class = false; 
	}

	if ( get_theme_mod('asterion_intro_image_overlay', true ) ) {
		$overlay_class = " dark-overlay"; 
	} else { 
		$overlay_class = false; 
	}

	$intro_image_show = get_theme_mod( 'asterion_intro_image_show', true );
	$menu_position = get_theme_mod( 'asterion_menu_position', 1 );

	if ( get_theme_mod( 'asterion_menu_style', 2 ) == 2 ) {
		$menu_style = 'ot-light-text'; 
	} else { 
		$menu_style = "ot-dark-text"; 
	}

	$menu_bg_style = get_theme_mod( 'asterion_menu_bg_style', 1 );
	if( $menu_bg_style == 2 ) {
		$menu_bg_style_class = " ot-dark-menu";
	} else {
		$menu_bg_style_class = " ot-light-menu";
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- Off-canvas wrap -->
	    <div class="asterion-offcanvas-wrap">
	        <div class="close"><i class="fa fa-close" aria-hidden="true"></i></div>
	        <div class="asterion-offcanvas-nav"></div>
	    </div><!-- end .asterion-offcanvas-wrap -->
		<header id="header" class="<?php echo esc_attr( ( is_front_page() ) ? 'intro-image': 'intro-blog' ); ?> <?php echo esc_attr( $parallax_class ); ?> <?php echo esc_attr( $menu_style ); ?>" style="background-image: url(' <?php echo esc_url( ( is_front_page() ) ? $intro_image : ( ! get_header_image() ) ? $intro_image : get_header_image() ); ?>');">

			<div class="navbar<?php echo ( $menu_position == "1" ) ? ' navbar-fixed-top' : false ; echo esc_attr($menu_bg_style_class); ?>">
				<div class="ot-container">

			        <!-- Toggle menu -->
                    <span class="site-navigation-toggle"><i class="fa fa-bars" aria-hidden="true"></i></span>
					<!-- Brand and toggle get grouped for better mobile display --> 
					<div class="navbar-header"> 

						<?php
							// Try to retrieve the Custom Logo
							if ( has_custom_logo() ) :
								the_custom_logo();
							else :
							// Display the site's name
						?>
								<h1>
									<a href="<?php echo esc_url( home_url( '/' ) );?>" rel="home">
										<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>
									</a>
								</h1>

								<?php if( get_bloginfo('description') ) : ?>
									<div class="description">
										<?php echo esc_attr( get_bloginfo('description') );?>
									</div>
							<?php endif;?>
						<?php endif;?>
					</div> 

					<!-- Site navigation -->
					<div class="asterion-primary-nav">
						<?php 
							$args =	array(
										'menu'              => 'main-menu',
										'theme_location'    => 'main-menu',
										'depth'             => 3,
										'container'         => 'nav',
										'container_class'   => 'asterion-navigation nav',
										'menu_class'        => 'menu menu-right',
										'walker'            => new Asterion_Nav_Walker()
									);

							/* display the WordPress Main Menu if available */
							if ( has_nav_menu( 'main-menu' ) ) : 
								wp_nav_menu($args);
							elseif( is_admin() ):
								?>
									<nav class="asterion-navigation nav">
										<ul class="menu menu-right">
											<li><a href=""><?php esc_html_e("Please set up the menu", 'asterion');?></a></li>
										</ul>
									</div> 
								<?php
							else :
								wp_nav_menu($args);
							
							endif;
						?>
					</div>
				</div>
			</div>
			
			
			<div class="slider-container<?php echo esc_attr( $overlay_class ); ?>">
				<?php if( is_front_page() && get_option( 'show_on_front' ) == "page" && $intro_image_show ) : ?>
					<?php get_template_part( 'sections/intro-image' ); ?>
				<?php endif; ?>
			</div>
			
		</header>

		<div class="ot-page-wrapper">
			<div id="content" class="site-content">
			