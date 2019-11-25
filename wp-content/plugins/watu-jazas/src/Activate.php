<?php
/**
 * @package WatuJazas
 */


namespace WatuJazas;


class Activate {

  public static function activate() {
    flush_rewrite_rules();
  }

}
