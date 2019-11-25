<?php


namespace WatuJazas;


use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionException;
use WatuJazas\Enum\AssetsType;
use WatuJazas\Enum\EnqueueType;


/**
 * Class Enqueue
 * @package WatuJazas\Base
 */
class Enqueue extends PluginBase {

  const SCRIPTS_DIRECTORY = 'assets/js';

  const STYLE_DIRECTORY = 'assets/style';

  const ADMIN_ASSETS_DIRECTORY = 'admin';

  const FRONT_ASSETS_DIRECTORY = 'front';

  public function register() {
    add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
    add_action('wp_enqueue_scripts', [$this, 'enqueueFront']);
  }

  /**
   * Registers all script and style files for the admin area
   * @throws ReflectionException
   */
  function enqueueAdmin() {
    $scripts_dir_rel_path = self::SCRIPTS_DIRECTORY . '/' . self::ADMIN_ASSETS_DIRECTORY;
    $styles_dir_rel_path = self::STYLE_DIRECTORY . '/' . self::ADMIN_ASSETS_DIRECTORY;
    $this->registerScriptFiles($scripts_dir_rel_path, true);
    $this->registerStyleFiles($styles_dir_rel_path, true);
  }

  /**
   * Registers all script and style files for the front
   * @throws ReflectionException
   */
  function enqueueFront() {
    $scripts_dir_rel_path = self::SCRIPTS_DIRECTORY . '/' . self::FRONT_ASSETS_DIRECTORY;
    $styles_dir_rel_path = self::STYLE_DIRECTORY . '/' . self::FRONT_ASSETS_DIRECTORY;
    $this->registerScriptFiles($scripts_dir_rel_path);
    $this->registerStyleFiles($styles_dir_rel_path);
  }

  /**
   * Registers all .js files in a specific directory,
   * regardless of their exact location as long as they are
   * not outside of that directory
   * @param string $scripts_dir_rel_path
   * @param bool $is_admin_script
   * @throws ReflectionException
   */
  private function registerScriptFiles(string $scripts_dir_rel_path, bool $is_admin_script = FALSE) {
    $scripts_dir_abs_path = $this->getPluginPath() . $scripts_dir_rel_path;

    if (is_dir($scripts_dir_abs_path)) {
      $directory_iterator = new RecursiveDirectoryIterator($scripts_dir_abs_path, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
      foreach (new RecursiveIteratorIterator($directory_iterator, RecursiveIteratorIterator::SELF_FIRST) as $file) {
        if (!$file->isFile() || $file->getExtension() !== 'js') {
          continue;
        }
        $script_name = $this->getEnqueueName($file, $is_admin_script ? 'admin_script' : 'front_script');
        $script_path = $this->getEnqueuePath(EnqueueType::SCRIPT, $is_admin_script ? AssetsType::ADMIN : AssetsType::FRONT, $file->getRealPath());
        wp_enqueue_script($script_name, $script_path, ['jquery']);
      }
    }
  }

  /**
   * Registers all .css files in the style's directory,
   * regardless of their exact location as long as they are
   * not outside of style's directory
   * @param string $styles_dir_rel_path
   * @param bool $is_admin_style
   * @throws ReflectionException
   */
  private function registerStyleFiles(string $styles_dir_rel_path, bool $is_admin_style = FALSE) {
    $styles_dir_abs_path = $this->getPluginPath() . $styles_dir_rel_path;

    if (is_dir($styles_dir_abs_path)) {
      $directory_iterator = new RecursiveDirectoryIterator($styles_dir_abs_path, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
      foreach (new RecursiveIteratorIterator($directory_iterator, RecursiveIteratorIterator::SELF_FIRST) as $file) {
        if (!$file->isFile() || $file->getExtension() !== 'css') {
          continue;
        }
        $style_name = $this->getEnqueueName($file, $is_admin_style ? 'admin_style' : 'front_style');
        $style_path = $this->getEnqueuePath(EnqueueType::STYLE, $is_admin_style ? AssetsType::ADMIN : AssetsType::FRONT, $file->getRealPath());
        wp_enqueue_style($style_name, $style_path);
      }
    }
  }

  /**
   * @param object $file
   * @param string $prefix
   * @return string
   */
  private function getEnqueueName(object $file, string $prefix = '') {
    // Remove file extension from file name
    $file_name = str_replace('.' . $file->getExtension(), '', $file->getFilename());
    // Transform file name from CamelCase to snake_case
    $enqueue_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $file_name)), '_');
    return 'wr_' . $prefix . '_' . $enqueue_name;
  }

  /**
   * @param string $enqueue_type
   * @param string $assets_type
   * @param $file_abs_path
   * @return mixed
   * @throws ReflectionException
   * @throws Exception
   */
  private function getEnqueuePath(string $enqueue_type, string $assets_type, $file_abs_path) {
    if (!EnqueueType::isValid($enqueue_type)) {
      throw new Exception("Invalid enqueue type '$enqueue_type'.");
    }

    if (!AssetsType::isValid($assets_type)) {
      throw new Exception("Invalid assets type '$enqueue_type'.");
    }

    $dir_rel_path = NULL;
    switch ($enqueue_type) {
      case EnqueueType::SCRIPT:
        if ($assets_type === AssetsType::ADMIN) {
          $dir_rel_path = self::SCRIPTS_DIRECTORY . '/' . self::ADMIN_ASSETS_DIRECTORY;
        } elseif ($assets_type === AssetsType::FRONT) {
          $dir_rel_path = self::SCRIPTS_DIRECTORY . '/' . self::FRONT_ASSETS_DIRECTORY;
        }
        break;
      case EnqueueType::STYLE:
        if ($assets_type === AssetsType::ADMIN) {
          $dir_rel_path = self::STYLE_DIRECTORY . '/' . self::ADMIN_ASSETS_DIRECTORY;
        } elseif ($assets_type === AssetsType::FRONT) {
          $dir_rel_path = self::STYLE_DIRECTORY . '/' . self::FRONT_ASSETS_DIRECTORY;
        }
        break;
      default:
        throw new Exception("Missing case implementation in " . __FUNCTION__ . "  for enqueue type '$enqueue_type' .");
    }
    if (empty($dir_rel_path)) {
      throw new Exception("Invalid assets type '$enqueue_type'.");
    }
    $dir_abs_path = $this->getPluginPath() . $dir_rel_path;
    $dir_url_path = $this->getPluginUrl() . $dir_rel_path;

    return str_replace($dir_abs_path, $dir_url_path, $file_abs_path);
  }

}
