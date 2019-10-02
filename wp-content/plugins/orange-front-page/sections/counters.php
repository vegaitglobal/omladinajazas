<?php
/**
 *	The template for dispalying the about section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */


	$bg_image = ot_front_page()->options->get( 'counters_bg_image' );
	$counter_set = ot_front_page()->options->get( 'counters_title_1' );
	$bg_color = ot_front_page()->options->get( 'counters_bg_color', '#ffffff' );
	
	$bg_type = ot_front_page()->options->get( 'counters_bg_type');
	if( $bg_type == 2 ) {
		$bg_style = 'background-color:'.$bg_color;
	} else {
		$bg_style = 'background-image: url('.$bg_image.')';
	}

	$counters_image_parallax = ot_front_page()->options->get( 'counters_image_parallax');
	if ( $counters_image_parallax  ) {
		$parallax_class = " intro-parallax"; 
	} else { 
		$parallax_class = false; 
	}

	$counters_image_overlay = ot_front_page()->options->get( 'counters_image_overlay');
	if ( $counters_image_overlay ) {
		$overlay_class = " dark-overlay"; 
	} else { 
		$overlay_class = false; 
	}

	$text_color = ot_front_page()->options->get( 'counters_text_color', 0);

?>

<?php if( $counter_set ) : ?>
	<div id="counters" class="stats-bar <?php echo esc_attr(( $text_color == 1) ? 'text-light' : 'text-dark').$parallax_class; ?>" style="<?php echo esc_attr( $bg_style );?>">
		<div class="short-section<?php echo esc_attr($overlay_class);?>">
			<div class="ot-container text-center">
				<div class="row">
					<?php 

						for ($i=0; $i < 5; $i++) :
							$title = ot_front_page()->options->get( 'counters_title_'.$i);
							$count = ot_front_page()->options->get( 'counters_count_'.$i);
					?>
						<?php if( $title || $count ) : ?>
							<div class="col-md-3 mb-sm-30 <?php echo esc_attr( 'ot-counter-nr-'.$key );?>">
								<div class="counter-item">
									<h2 class="stat-number" data-n="<?php echo esc_attr( $count ); ?>">0</h2>
									<h6><?php echo esc_html($title); ?></h6>
								</div>
							</div>
						<?php endif; ?>
					<?php endfor; ?>
				

				</div>
			</div>
		</div>
	</div>
<?php endif; ?>