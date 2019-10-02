<?php
/**
 *	Template name: Clean Page
 *
 *	The template for displaying Custom Page Template: Without Aay aditional tags.
 *
 *	@package WordPress
 *	@subpackage asterion
 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage">

			<?php 
				while ( have_posts() ) : 
					the_post();
			?>

				<div class="post-date">
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								esc_html__( 'Edit %s', 'asterion' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</div>


				<div class="entry-content">
					<?php the_content(); ?>
					<?php			
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'asterion' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'asterion' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
					?>
				</div>

			<?php

				endwhile;
			?>

		</main>
	</div>
<?php get_footer(); ?>