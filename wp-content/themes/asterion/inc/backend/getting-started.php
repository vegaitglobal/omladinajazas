<?php
	ob_start();
?>

	<div class="ot-center">

		<h1 class="ot-welcome-title"><?php esc_html_e("Welcome to Asterion!", 'asterion');?></h1>

		<p><?php esc_html_e("Our most popular free one page WordPress theme, Asterion!", 'asterion');?></p>
		<p><?php esc_html_e("We want to make sure you have the best experience using Asterion and that is why we gathered here all the necessary information for you. We hope you will enjoy using Asterion, as much as we enjoy creating great products.", 'asterion');?></p>
	</div>

	<hr>

	<div class="ot-center">

		<h1><?php esc_html_e("Getting started", 'asterion');?></h1>

		<p><?php esc_html_e("You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.", 'asterion');?></p>
		<p><a href="<?php echo esc_url('//www.moozthemes.com/asterion-documentation/');?>" class="button button-primary" target="_blank"><?php esc_html_e("View Documentation", 'asterion');?></a></p>

		<h4><?php esc_html_e("Customize everything in a single place.", 'asterion');?></h4>
		<p><?php esc_html_e("Using the WordPress Customizer you can easily customize every aspect of the theme.", 'asterion');?></p>
		<p><a href="<?php echo esc_url(admin_url( '/customize.php' ));?>" class="button button-primary"><?php esc_html_e("Go to Customizer", 'asterion');?></a></p>

	</div>

	<hr>


<?php
	$content = ob_get_contents();
	ob_end_clean();



	$section_content = array(
		array(
			"type" => "navigation",
			"name" => esc_html__("Getting Started",'asterion'),
			"slug" => "getting_started"
		),
		array(
			"type" => "section_start",
			"slug" => 'getting_started'
		),

		array(
			"type" => "section_content",
			"content" => $content
		),

		array(
			"type" => "section_end"
		),

	);

	asterion()->panel->add_options( $section_content );