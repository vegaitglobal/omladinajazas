<?php
/**
 * @package WatuJazas\
 */


namespace WatuJazas;


class Deactivate {

  public static function deactivate() {
    flush_rewrite_rules();
  }

}
