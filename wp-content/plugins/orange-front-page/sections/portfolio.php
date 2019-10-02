<?php
/**
 *	The template for dispalying the features section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	$title = ot_front_page()->options->get( 'portfolio_title' );
	$text = ot_front_page()->options->get( 'portfolio_text' );
	
	$count = ot_front_page()->options->get( 'portfolio_count', 6 );


	$jetpack_portfolio_args = array (
		'post_type'					=> array( 'jetpack-portfolio' ),
		'nopaging'					=> false,
		'ignore_sticky_posts'		=> true,
		'posts_per_page'			=> absint( $count ),
		'cache_results'				=> true,
		'update_post_meta_cache'	=> true,
		'update_post_term_cache'	=> true
	);

	$jetpack_portfolio_query = new WP_Query( $jetpack_portfolio_args );

	$bg_color = ot_front_page()->options->get( 'portfolio_bg_color', '#ffffff' );
	$text_color = ot_front_page()->options->get( 'portfolio_text_color', 0 );
	$hover_effect = ot_front_page()->options->get( 'portfolio_image_hover_effect', 'bubba' );
	$overlay_color = ot_front_page()->options->get( 'portfolio_image_overlay_color', '#1a1a1a' );



	$counter = 1; 
?>
<?php if( ( $title != "" || $text != "" ) && $jetpack_portfolio_query->have_posts() && post_type_exists( 'jetpack-portfolio' ) ) : ?>
	<section id="portfolio" class="ot-section <?php echo esc_attr(( $text_color == 1 ) ? 'text-light' : 'text-dark'); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
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
			<?php if( post_type_exists( 'jetpack-portfolio' ) ): ?>

				<div class="row row-0-gutter">
					
					<?php while( $jetpack_portfolio_query->have_posts() ): $jetpack_portfolio_query->the_post(); ?>

						<div class="ot-portfolio-item" data-id="ot-portfolio-item-<?php echo esc_attr($counter);?>">
							<figure class="effect-<?php echo esc_attr($hover_effect);?>" style="background-color: <?php echo esc_attr($overlay_color);?>;">
								<?php the_post_thumbnail( 'ot-front-page-portfolio' ); ?>
								<figcaption>

									<h2><?php the_title(); ?></h2>

									<?php if( ot_front_page()->posts->terms( 'jetpack-portfolio-type' ) ) : ?>
										<p><?php ot_front_page()->posts->terms( 'jetpack-portfolio-type', true ); ?></p>
									<?php endif; ?>

								</figcaption>
							</figure>
						</div>
						<!-- Modal for portfolio item <?php echo esc_attr($counter);?> -->
						<div class="modal fade ot-portfolio-item-<?php echo esc_attr($counter);?>" >
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_attr_e("Close", 'orange-front-page');?>">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="Modal-label-<?php echo esc_attr($counter);?>">
											<?php the_title(); ?>
										</h4>
									</div>
									<div class="modal-body">
										<?php the_post_thumbnail( 'ot-front-page-portfolio-large' ); ?>
										<?php if( ot_front_page()->posts->terms( 'jetpack-portfolio-type' ) ) : ?>
											<div class="modal-works">
												<?php ot_front_page()->posts->terms( 'jetpack-portfolio-type', true ); ?>
											</div>
										<?php endif; ?>
										<?php if( get_the_excerpt() ) { ?>
											<p><?php the_excerpt();?></p>
										<?php } ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="close btn btn-default" data-dismiss="modal"><?php esc_html_e("Close", 'orange-front-page');?></button>
									</div>
								</div>
							</div>
						</div>

					<?php $counter++; ?>
					<?php endwhile; ?>

				</div><!-- end row -->

			<?php endif; ?>

		</div><!-- end container -->

	</section>
<?php endif; ?> 