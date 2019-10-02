<?php
/**
 *	Template name: Left Sidebar
 *	Template Post Type: post, page
 *	The template for displaying Custom Page?Post Template: Left Sidebar.
 *
 *	@package WordPress
 *	@subpackage asterion
 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php get_header(); ?>
	<?php 
	if( get_post_type() == "post" ) {
		get_sidebar( 'blog-sidebar' ); 
	} else {
		get_sidebar( 'page-sidebar' ); 
	}
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage">

			<?php 
				while ( have_posts() ) : 
					the_post();
					if( get_post_type() == "post" ) {
						get_template_part( 'template-parts/content', 'post' );
					} else {
						get_template_part( 'template-parts/content', 'page' );
					}
					

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

				endwhile;
			?>

		</main>
	</div>
<?php get_footer(); ?>