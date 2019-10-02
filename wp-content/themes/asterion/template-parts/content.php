<?php
/**
 *    The template for dispalying the content.
 *
 * @package    WordPress
 * @subpackage asterion
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php 
		//load post thubnail
		asterion()->posts->post_thumbnail(); 
	?>

	<div class="blog-post-body">

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="post-meta">
			<span class="ot-post-date"><i class="fa fa-clock-o"></i><?php the_time( get_option('date_format') );?></span>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="ot-post-comments">
				<i class="fa fa-comments-o"></i>
					<?php comments_popup_link( esc_html__( 'Leave a comment', 'asterion' ), esc_html__( '1 Comment', 'asterion' ), esc_html__( '% Comments', 'asterion' ) ); ?>
				</span>
			<?php endif; ?>
		<?php 
			//load categories
			asterion()->posts->categories();
		?>

		</div>

		<?php 
			if ( is_search() ) : // Only display Excerpts for Search
				the_excerpt();
			else :
				if ( get_the_excerpt() != "" ) :
					the_excerpt();
				else :
					the_content();
				endif;
			endif; // endif is_search
		?>
			
		<?php 
			//load post list pagination
			asterion()->posts->pagination(); 
		?>

		<?php if( ! is_single() ) : ?>
			<div class="read-more">
				<a href="<?php the_permalink(); ?>" class="btn">
					<?php esc_html_e( 'Continue Reading', 'asterion' ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>
</article><!--/#post-<?php the_ID(); ?>.blog-post-->