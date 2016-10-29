<?php

namespace PetShop\DataBase;

use PetShop\DataBase\Banco;
use PetShop\DataBase\MySQL;

abstract class Factory {

  /**
   * @var Banco
   */
  public static $oBanco = null;

  public static function getBanco() {

    if (is_null(self::$oBanco)) {
      self::$oBanco = new MySQL();
    }
    return self::$oBanco;
  }
}