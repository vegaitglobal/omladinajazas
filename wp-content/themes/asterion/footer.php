<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage asterion
 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$copyright  = get_theme_mod( 'asterion_copyright', sprintf( __( '&copy; Copyright %s. All Rights Reserved.', 'asterion' ), date('Y')) );
?>
			
			</div><!-- /.container -->
		</div><!-- /.ot-container -->
		<!-- back to top button -->
		<p id="back-top" style="display: block;">
			<a href="#top">
				<i class="fa fa-angle-up"></i>
			</a>
		</p>

		<div class="ot-footer">
			<div class="ot-container text-center">
				<div class="ot-copyright"><?php echo asterion()->customizer->sanitize_html( $copyright ); ?></div>
				<?php
					printf( esc_html__( '%s %s %s %s', 'asterion' ) , esc_html__( 'Theme by', 'asterion' ), '<a href="https://moozthemes.com/" title="MOOZ Themes" target="_blank">MOOZ Themes</a>', esc_html__( 'Powered by', 'asterion' ), '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
				?>
			</div>
		</div>

		<?php wp_footer(); ?>
	</body>
</html>