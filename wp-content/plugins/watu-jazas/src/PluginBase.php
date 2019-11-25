<?php


namespace WatuJazas;


class PluginBase {

  /**
   * @var string
   */
  private $pluginPath;
  /**
   * @var string
   */
  private $pluginUrl;
  /**
   * @var string
   */
  private $pluginName;

  public function __construct() {
    $this->pluginPath = plugin_dir_path(dirname(__FILE__));
    $this->pluginUrl = plugin_dir_url(dirname(__FILE__));
    $this->pluginName = plugin_basename(dirname(__FILE__, 2) . '/watu-rest.php');
  }

  /**
   * @return string
   */
  public function getPluginPath() {
    return $this->pluginPath;
  }

  /**
   * @return string
   */
  public function getPluginUrl() {
    return $this->pluginUrl;
  }

  /**
   * @return string
   */
  public function getPluginName() {
    return $this->pluginName;
  }

}
