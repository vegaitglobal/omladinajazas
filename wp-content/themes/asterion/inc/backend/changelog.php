<?php

	$section_content = array(
		array(
			"type" => "navigation",
			"name" => esc_html__("Changelog",'asterion'),
			"slug" => "changelog"
		),
		array(
			"type" => "section_start",
			"slug" => 'changelog'
		),

		array(
			"type" => "changelog",
		),

		array(
			"type" => "section_end"
		),

	);

	asterion()->panel->add_options( $section_content );