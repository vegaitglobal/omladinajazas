<?php
/**
 * The template for dispalying the sidebar.
 *
 * @package WordPress
 * @subpackage asterion
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside class="sidebar ot-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
<?php endif; ?>