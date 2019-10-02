<?php
/**
 * The template for dispalying the page sidebar.
 *
 * @package WordPress
 * @subpackage asterion
 */
?>
<?php if ( is_active_sidebar( 'page-sidebar' )  ) : ?>
	<aside class="sidebar ot-sidebar">
		<?php dynamic_sidebar( 'page-sidebar' ); ?>
	</aside>
<?php endif; ?>