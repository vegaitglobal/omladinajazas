<?php

/**
 * @package WatuJazas
 */

/*
Plugin Name: Watu Jazas
Description: Watu Jazas Plugin
Version: 1.0.0
Author: Milos Roknic
Text Domain: watu-jazas
 */


use WatuJazas\Activate;
use WatuJazas\Deactivate;
use WatuJazas\Init;


defined('ABSPATH') or die('You cannot access this file.');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Code that runs during plugin activation
 */
function activate_simple_forms_plugin() {
  Activate::activate();
}

register_activation_hook(__FILE__, 'activate_simple_forms_plugin');

/**
 * Code that runs during plugin deactivation
 */
function deactivate_simple_forms_plugin() {
  Deactivate::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivate_simple_forms_plugin');

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('WatuJazas\\Init')) {
  Init::register_services();
}
