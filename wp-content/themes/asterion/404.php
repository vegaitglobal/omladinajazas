<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage asterion
 */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php get_header(); ?>

	<section class="content-area">

		<main id="main" class="site-main" role="main">

			<div class="text-center error-box">

				<h1><?php esc_html_e('Page not found', 'asterion'); ?></h1>
			
				<div class="row">

					<div class="col-md-12 col-md-offset-2">

						<?php get_search_form(); ?>

					</div>

				</div>

			</div>

		</main>

	</section> <!-- /.content-box -->


<?php get_footer(); ?>