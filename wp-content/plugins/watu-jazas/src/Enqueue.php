<?php


namespace WatuJazas;


use ReflectionException;


/**
 * Class Enqueue
 * @package WatuJazas\Base
 */
class Enqueue extends PluginBase {

  const SCRIPTS_DIRECTORY = 'assets/js';

  const STYLE_DIRECTORY = 'assets/style';

  public function register() {
    add_action('wp_enqueue_scripts', [$this, 'enqueueFront']);
  }

  /**
   * Registers all script and style files for the front
   */
  function enqueueFront() {

    var_dump($this->getPluginUrl() . self::SCRIPTS_DIRECTORY . '/common.js');

    wp_enqueue_script('watu_jazas_front_script_common', $this->getPluginUrl() . self::SCRIPTS_DIRECTORY . '/common.js', ['jquery']);
    wp_enqueue_script('watu_jazas_front_script_knowledge_test', $this->getPluginUrl() . self::SCRIPTS_DIRECTORY . '/knowledge_test.js', ['jquery']);
    wp_enqueue_script('watu_jazas_front_script_risk_calculator', $this->getPluginUrl() . self::SCRIPTS_DIRECTORY . '/risk_calculator.js', ['jquery']);
    wp_enqueue_style('watu_jazas_front_style_ojh', $this->getPluginUrl() . self::STYLE_DIRECTORY . '/ojh.css');
  }
}
