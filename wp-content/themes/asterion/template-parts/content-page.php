<?php
/**
 *	The template for displaying the page content.
 *
 *	@package WordPress
 *	@subpackage asterion
 */
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<article  id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php 
		//load post thubnail
		asterion()->posts->post_thumbnail(); 
	?>
	<div class="blog-post-body">

		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>

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
	</div>
</article>