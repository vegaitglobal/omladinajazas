<?php


namespace WatuJazas\Enum;


use ReflectionClass;
use ReflectionException;


/**
 * Class EnumBase
 * @package WatuJazas\Enum
 */
abstract class EnumBase {

  /**
   * @return array
   * @throws ReflectionException
   */
  final public static function getConstants() {
    return (new ReflectionClass(static::class))->getConstants();
  }

  /**
   * @param $value
   * @return bool
   * @throws ReflectionException
   */
  final public static function isValid($value) {
    return in_array($value, static::getConstants());
  }

}
