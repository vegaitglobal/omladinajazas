<?php

	$section_content = array(
		array(
			"type" => "navigation",
			"name" => esc_html__("Changelog",'orange-front-page'),
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

	$this->add_options( $section_content );