<?php
	ob_start();
?>

	<div class="ot-center">

		<h1 class="ot-welcome-title"><?php esc_html_e("Welcome to Orange Front Page!", 'orange-front-page');?></h1>

		<p><?php esc_html_e("Orange Front Page plugin will allow you to customize your front page using the default WordPress customizer. ", 'orange-front-page');?></p>
	</div>

	<hr>

	<div class="ot-center">

		<h1><?php esc_html_e("Getting started", 'orange-front-page');?></h1>

		<p><?php esc_html_e("To start using Orange Front Page you need to find in your theme file called front-page.php or any other template file that you use as front page in your page.", 'orange-front-page');?> 
			<?php esc_html_e("And copy this line:", 'orange-front-page');?></p>
		<code><?php echo htmlspecialchars('<?php do_action( "orange_themes_front_page" ); ?>');?></code>
		<p><?php esc_html_e("where you would like to see the new front page sections, usually after main loop.", 'orange-front-page');?></p>
		<p><?php esc_html_e("After that you can go to WordPress Customizer and start edit the new home sections and they should should show up on the front page.", 'orange-front-page');?></p>

	</div>

	<hr>


<?php
	$content = ob_get_contents();
	ob_end_clean();



	$section_content = array(
		array(
			"type" => "navigation",
			"name" => esc_html__("Getting Started",'orange-front-page'),
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

	$this->add_options( $section_content );