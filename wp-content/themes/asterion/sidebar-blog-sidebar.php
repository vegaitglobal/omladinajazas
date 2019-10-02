<?php
/**
 * The template for dispalying the blog sidebar.
 *
 * @package WordPress
 * @subpackage asterion
 */
?>
<?php if ( is_active_sidebar( 'blog-sidebar' )  ) : ?>
	<aside class="sidebar ot-sidebar">
		<?php dynamic_sidebar( 'blog-sidebar' ); ?>
	</aside>
<?php endif; ?>