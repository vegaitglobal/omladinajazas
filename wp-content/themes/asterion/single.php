<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage asterion
 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php get_header(); ?>
	<div id="primary" class="content-area">

		<main id="main" class="site-main" itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage">

			<?php 
				while ( have_posts() ) : the_post();

					// Include the single post content template.
					get_template_part( 'template-parts/content', 'single' );

					$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
					$next     = get_adjacent_post( false, '', false );
					if ( $next || $previous ) :
						
		
			?>

					<nav class="navigation post-navigation" role="navigation">
						<h1 class="screen-reader-text">
							<?php esc_html_e( 'Post navigation', 'asterion' ); ?>
						</h1>
						<div class="nav-links">
							<?php
								if ( is_singular( 'attachment' ) ) {
									previous_post_link( '%link', __( '<div class="meta-nav"><span>Published In</span>%title</div>', 'asterion' ) );
								} elseif ( is_singular( 'post' ) ) {
									previous_post_link( '%link', __( '<div class="meta-nav meta-nav-left"><span>Previous Post</span>%title</div>', 'asterion' ) );
									next_post_link( '%link', __( '<div class="meta-nav meta-nav-right"><span>Next Post</span>%title</div>', 'asterion' ) );
								}
							?>
						</div><!-- .nav-links -->
					</nav><!-- .navigation -->
			<?php
					endif;
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

				endwhile;  // end of the loop. 
				wp_reset_query();
			?>

		</main>
	</div>


	<?php get_sidebar( 'blog-sidebar' ); ?>


<?php get_footer(); ?>