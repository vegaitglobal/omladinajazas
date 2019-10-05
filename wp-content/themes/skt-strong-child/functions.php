<?php

function enqueue_parent_styles() {
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function skt_strong_child_scripts_function() {

  wp_enqueue_script( 'skt-strong-child', get_stylesheet_directory_uri() . '/js/custom.js');

}
add_action('wp_enqueue_scripts','skt_strong_child_scripts_function');
