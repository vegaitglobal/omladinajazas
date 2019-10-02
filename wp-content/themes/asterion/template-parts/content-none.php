<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 *	@package WordPress
 *	@subpackage asterion
 */
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<section class="no-results not-found">

	<div class="text-center error-box">

		<h1><?php esc_html_e( 'Nothing Found', 'asterion' ); ?></h1>
	
		<div class="row">

			<div class="col-md-12 col-md-offset-2">

				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'asterion' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'asterion' ); ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>

					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'asterion' ); ?></p>
					<?php get_search_form(); ?>

				<?php endif; ?>

			</div>
				
		</div>

	</div>

</section> <!-- /.content-box -->
