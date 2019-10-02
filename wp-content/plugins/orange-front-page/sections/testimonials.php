<?php
/**
 *	The template for dispalying the features section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	
	$title = ot_front_page()->options->get( 'testimonials_title' );
	$text = ot_front_page()->options->get( 'testimonials_text' );
	
	$count = ot_front_page()->options->get( 'testimonials_count', 6 );


	$jetpack_testimonials_args = array (
		'post_type'					=> array( 'jetpack-testimonial' ),
		'nopaging'					=> false,
		'ignore_sticky_posts'		=> true,
		'posts_per_page'			=> absint( $count ),
		'cache_results'				=> true,
		'update_post_meta_cache'	=> true,
		'update_post_term_cache'	=> true
	);

	$jetpack_testimonials_query = new WP_Query( $jetpack_testimonials_args );

	$bg_color = ot_front_page()->options->get( 'testimonials_bg_color', '#ffffff' );
	$text_color = ot_front_page()->options->get( 'testimonials_text_color', 0 );


?>
<?php if( ( $title != "" || $text != "" ) && $jetpack_testimonials_query->have_posts() && post_type_exists( 'jetpack-testimonial' ) ) : ?>
	<section id="testimonials" class="ot-section <?php echo esc_attr(( $text_color == 1 ) ? 'text-light' : 'text-dark'); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
		<div class="ot-container">
			<?php if( $title || $text) { ?>
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
			<?php } ?>
			<?php if( post_type_exists( 'jetpack-testimonial' ) ): ?>
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="testimonials-slider">
							<?php while( $jetpack_testimonials_query->have_posts() ): $jetpack_testimonials_query->the_post(); ?>
								<div class="item">
									<div class="testimonials-item">
										<div class="ot-testimonials-text"><p><?php echo ot_front_page()->customizer->sanitize_html(get_the_content());?></p></div>
										<div class="ot-testimonials-image"><?php the_post_thumbnail( 'ot-front-page-testimonials' ); ?></div>
										<h3><?php the_title(); ?></h3>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</div><!-- end container -->

	</section>
<?php endif; ?> 