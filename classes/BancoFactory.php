<?php

abstract class BancoFactory {

  /**
   * @var Banco
   */
  public static $oBanco = null;

  public static function getBanco() {

    if (is_null(self::$oBanco)) {
      self::$oBanco = new MySQLBanco();
    }
    return self::$oBanco;
  }
}