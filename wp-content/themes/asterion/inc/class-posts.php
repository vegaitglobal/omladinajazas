<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class Asterion_Posts {
	   
	    public function __construct() {

	    
	    }


	    /**
	     * generates sinlge post image or blog list thumbnail
	     * @return  image html
	     */

	    function post_thumbnail() {
			if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
				return;
			}

			if ( is_singular() ) :
			?>

				<div class="blog-post-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
							if( is_active_sidebar( 'blog-sidebar' ) && !is_page_template('page-templates/no-sidebar.php') ) {
								the_post_thumbnail( 'asterion-single-thumbnail' ); 
							} else {
								the_post_thumbnail( 'asterion-single-full-thumbnail' ); 
							}
						?>
					</a>
				</div>
				
			<?php else : ?>

				<div class="blog-post-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
							if( is_active_sidebar( 'blog-sidebar' ) ) {
								the_post_thumbnail( 'asterion-blog-thumbnail' ); 
							} else {
								the_post_thumbnail( 'asterion-blog-full-thumbnail' ); 
							}
						?>
					</a>
				</div>
			
			<?php endif; // End is_singular()
	    }

	    /**
	     * generates categories layout
	     * @return  category layout
	     */

	    function categories() {

			if ( get_the_category() ) :
			?>
				<span class="ot-post-cats"><i class="fa fa-clone"></i><?php the_category( ' ' ); ?></span>
			<?php endif; // End get_the_category()

	    }

	    /**
	     * generates terms layout
	     * @return  terms layout
	     */

	    function terms( $tax, $echo = false ) {

			$terms = get_the_terms( get_the_ID(), $tax );
			$term_count = count( $terms );
			$i = 1;

			$_terms = "";

			if( $term_count > 0 && !empty($terms)) {
				foreach ( $terms as $term ) {

					$_terms.= esc_html($term->name);

					if( $term_count != $i ) {
						$_terms.= ', ';
					}
					$i++;
				}

				if( $echo !=false ) {
					echo $_terms;
				} else {
					return $_terms;
				}

			} else {
				return false;
			}


	    }

	    /**
	     * generates post list pagination
	     * @return  post list pagination
	     */

	    function pagination() {

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'asterion' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'asterion' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

	    }
	}

?>