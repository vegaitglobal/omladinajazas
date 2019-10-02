<?php
/**
 *	The template for dispalying the contact section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	$title = ot_front_page()->options->get( 'contact_title' );
	$text = ot_front_page()->options->get( 'contact_text' );
	$address_title = ot_front_page()->options->get( 'contact_address_title' );
	$address = ot_front_page()->options->get( 'contact_address' );
	$info_title = ot_front_page()->options->get( 'contact_info_title' );
	$info_phone = ot_front_page()->options->get( 'contact_info_phone' );
	$info_email = ot_front_page()->options->get( 'contact_info_email' );
	$bg_color = ot_front_page()->options->get( 'contact_bg_color','#ffffff' );
	$text_color = ot_front_page()->options->get( 'contact_text_color', 0 );
	$contact_form_7 = ot_front_page()->options->get( 'contact_from');

?>

<?php if( $title != "" || $text != "" || $address_title != "" || $address != "" || $info_title != "" || $info_phone != "" || $info_email != "" ) : ?>
	<!-- contact plugin --> 
	<section id="contact" class="ot-section <?php echo esc_attr(( $text_color == 0 ) ? 'text-dark' : 'text-light'); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
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

			<?php if( $address_title || $address || $info_title || $info_phone || $info_email ) : ?>
				<div class="row address-details">
					<?php if( $address_title || $address ) : ?>
						<div class="col-md-6 ot-address">
							<div class="section-text">
								<?php if( $address_title ) : ?>
									<h4><?php echo ot_front_page()->customizer->sanitize_html($address_title);?></h4>
								<?php endif; ?>
								<?php if( $address ) : ?>
									<p><?php echo ot_front_page()->customizer->sanitize_html($address); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if( $info_title || $info_phone || $info_email ) : ?>
						<div class="col-md-6 ot-contact">
							<div class="section-text">
								<?php if( $info_title ) : ?>
									<h4><?php echo ot_front_page()->customizer->sanitize_html($info_title);?></h4>
								<?php endif; ?>
								<?php if( $info_phone ) : ?>
									<p class="ot-phone">
										<i class="fa fa-phone"></i>
										<span><?php echo ot_front_page()->customizer->sanitize_html($info_phone);?></span>
									</p>
								<?php endif; ?>
								<?php if( $info_email ) : ?>
									<p class="ot-email">
										<i class="fa fa-envelope"></i> 
										<span><?php echo ot_front_page()->customizer->sanitize_html($info_email);?></span>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if( class_exists('WPCF7') && $contact_form_7 != null && $contact_form_7 != 'default' ): ?>
				<div class="row">
					<div class="col-sm-12">
						<?php $shortcode = '[contact-form-7 id="'. esc_attr( $contact_form_7 ) .'"]'; ?>
						<?php echo do_shortcode( $shortcode ); ?>
					</div>
				</div><!--/.row-->
			<?php endif; ?>
		</div>
		<!-- /.container -->
	</section>
<?php endif; ?>