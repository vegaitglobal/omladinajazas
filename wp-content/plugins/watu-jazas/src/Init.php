<?php


namespace WatuJazas;


/**
 * Class Init
 * @package WatuJazas
 */
final class Init {

  public static function get_services() {
    return [
      Enqueue::class
    ];
  }

  public static function register_services() {
    foreach (self::get_services() as $service_class) {
      $service = new $service_class();
      if (method_exists($service, 'register')) {
        $service->register();
      }
    }
  }

}
