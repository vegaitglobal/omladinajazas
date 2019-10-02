<?php
/**
 *	The template for dispalying the header image
 *
 *	@package WordPress
 *	@subpackage asterion
 */

	if( is_customize_preview() ) {
		$title_1 = get_theme_mod('asterion_header_title_1',esc_html__( 'Welcome To MOOZ Themes!', 'asterion' ));
		$title_2 = get_theme_mod('asterion_header_title_2',esc_html__( 'YOUR FAVORITE SOURCE OF FREE BOOTSTRAP THEMES', 'asterion' ));
		$button_title = get_theme_mod('asterion_header_button_title',esc_html__('Tell me more','asterion'));
	} else {
		$title_1 = get_theme_mod('asterion_header_title_1', get_the_title());
		$title_2 = get_theme_mod('asterion_header_title_2');
		$button_title = get_theme_mod('asterion_header_button_title');
	}


	$button_url = get_theme_mod('asterion_header_button_url', "#");
	$button_target = get_theme_mod('asterion_header_button_target', 1);

?>


	<div class="ot-container">
		<div class="intro-text">
			<?php if( $title_1 ) { ?>
				<h3 class="intro-lead-in">
					<?php echo esc_html($title_1);?>
				</h3>
			<?php } ?>
			<?php if( $title_2 ) { ?>
				<h2 class="intro-heading">
					<?php echo esc_html($title_2);?>
				</h2>
			<?php } ?>
			<?php if( $button_title ) { ?>
				<a href="<?php echo esc_url($button_url);?>" target="<?php echo esc_attr( $button_target == 1 ) ? '_blank' : '_self' ; ?>" class="page-scroll btn btn-xl">
					<?php echo esc_html($button_title);?>
				</a>
			<?php } ?>
		</div>
	</div>
