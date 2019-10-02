<?php
/**
 * The template used for displaying content single
 *
 * @package    WordPress
 * @subpackage asterion
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<article  id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php 
		if( get_theme_mod( 'asterion_single_post_image', 1 ) != false ) {
			//load post thubnail
			asterion()->posts->post_thumbnail(); 	
		}
	?>

	<div class="blog-post-body">


		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="post-date">
				<?php if( get_theme_mod( 'asterion_single_post_author', 1 ) != false ) { ?>
					<span class="ot-post-author"><i class="fa fa-user-o"></i><?php the_author_posts_link(); ?></span>
				<?php } ?>
				<?php if( get_theme_mod( 'asterion_single_post_date', 1 ) != false ) { ?>
					<span class="ot-post-date"><i class="fa fa-clock-o"></i><?php the_time( get_option('date_format') );?></span>
				<?php } ?>

				<?php 
					if( get_theme_mod( 'asterion_single_post_cat', 1 ) != false ) { 
						//load categories
						asterion()->posts->categories(); 
					}
				?>
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
		<?php endif; ?>

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
		<?php if( has_tag() && get_theme_mod( 'asterion_single_post_tags', 1 ) != false ) : ?>
			<!-- tags -->
			<div class="mz-entry-tags">
				<span>
					<i class="fa fa-tags"></i>
				</span>
				<?php

					$tags = get_the_tags( get_the_ID() );
					foreach( $tags as $tag ) {
						echo '<a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.esc_html( $tag->name ).'</a> ';
					}
				?>

			</div>
			<!-- end tags -->
		<?php endif; ?>

	</div>
</article>
