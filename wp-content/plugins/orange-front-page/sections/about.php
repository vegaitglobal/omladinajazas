<?php
/**
 *	The template for dispalying the about section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	$ot_front_page = ot_front_page()->customizer;

	$title = ot_front_page()->options->get( 'about_title' );
	$text = ot_front_page()->options->get( 'about_text' );
	$facebook = ot_front_page()->options->get( 'about_facebook' );
	$twitter = ot_front_page()->options->get( 'about_twitter' );
	$linkedin = ot_front_page()->options->get( 'about_linkedin' );
	$bg_color = ot_front_page()->options->get( 'about_bg_color','#ffffff' );
	$text_color = ot_front_page()->options->get( 'about_text_color', 0 );


?>

<?php if( $title != "" || $text != "" ) : ?>
	<!-- about plugin --> 
	<section id="about" class="ot-section <?php echo esc_attr(( $text_color == 1) ? 'text-light' : 'text-dark'); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
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
						<?php if( $facebook || $twitter || $linkedin ) : ?>
							<div class="ot-about-socials">
								<?php if( $facebook ) : ?>
									<a class="ot-facebook" href="<?php echo esc_url( $facebook );?>" title="<?php esc_html_e("Facebook", "orange-front-page");?>" target="_blank">
										<i class="fa fa-facebook"></i>
									</a>
								<?php endif; ?>
								<?php if( $twitter ) : ?>
									<a class="ot-twitter" href="<?php echo esc_url( $twitter );?>" title="<?php esc_html_e("Twitter", "orange-front-page");?>" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
								<?php endif; ?>
								<?php if( $linkedin ) : ?>
									<a class="ot-linkedin" href="<?php echo esc_url( $linkedin );?>" title="<?php esc_html_e("LinkedIn", "orange-front-page");?>" target="_blank">
										<i class="fa fa-linkedin"></i>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
		<!-- /.container -->
	</section>
<?php endif; ?>