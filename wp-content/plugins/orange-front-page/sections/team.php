<?php
/**
 *	The template for dispalying the team section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	$title = ot_front_page()->options->get( 'team_title' );
	$text = ot_front_page()->options->get( 'team_text' );
	
	$bg_color = ot_front_page()->options->get( 'team_bg_color', '#ffffff' );
	$text_color = ot_front_page()->options->get( 'team_text_color', 0 );

?>

<?php if( $title != "" || $text != "" || is_active_sidebar( 'sidebar-team' ) ) : ?>
	<!-- team plugin --> 
	<section id="team" class="ot-section <?php echo esc_attr(( $text_color == 1) ? 'text-light' : 'text-dark'); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
		<div class="ot-container">
			<?php if( $title || $text ) : ?>
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<?php if( $title ) : ?>
								<h2><?php echo ot_front_page()->customizer->sanitize_html($title);?></h2>
							<?php endif; ?>
							<?php if( $text ) : ?>
								<p><?php echo ot_front_page()->customizer->sanitize_html($text);?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-team' ) ) : ?>
				<div class="row <?php ot_front_page()->home->widget_counter_class('sidebar-team');?>">
					<?php dynamic_sidebar( 'sidebar-team' ); ?>
				</div>
			<?php endif; ?>

		</div>
		<!-- /.container -->
	</section>
<?php endif; ?>