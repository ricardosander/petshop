<?php

namespace PetShop;

/**
 * Class Utils
 * Classe com utilidades para o sistema.
 */
abstract class Utils {

  /**
   * Transforma umas string no formato xx.xxx,xx em uma string no formato xxxxx.xx
   * @param $sDouble
   * @return string
   */
  public static function stringToFloat($sDouble) {

    $sDouble = str_replace(".", "", $sDouble);
    $sDouble = str_replace(",", ".", $sDouble);
    return $sDouble;
  }

  /**
   * Transforma um float em uma string no formato xx.xxx,xx. Retorna uma string vazia caso o parâmetro informado
   * não seja um número válido;
   * @param float $nFloat
   * @return string
   */
  public static function floatToString($nFloat) {

    if (!is_numeric($nFloat)) {
      return "";
    }
    return number_format($nFloat, 2, ",", ".");
  }

  /**
   * Formata um telefone para os formatos (dd) dddd-dddd ou dddd-dddd.
   * @param $sTelefone
   * @return string
   */
  public static function getTelefoneFormatado(string $sTelefone) {

    $iPosicaoInicial    = 0;
    $sTelefoneFormatado = "";

    if (empty($sTelefone)) {
      return $sTelefoneFormatado;
    }

    if (strlen($sTelefone) == 11) {

      $sTelefoneFormatado = "(" . substr($sTelefone, $iPosicaoInicial, 2) . ") ";
      $iPosicaoInicial    = 2;
    }

    $sTelefoneFormatado .= " " . substr($sTelefone, $iPosicaoInicial, 5) . "-";

    $iPosicaoInicial += 5;

    $sTelefoneFormatado .= substr($sTelefone, $iPosicaoInicial);

    return $sTelefoneFormatado;
  }

  /**
   * Retorna a parte DDD do número, se houver.
   * @param string $sTelefone
   * @return string
   */
  public static function getDDD(string $sTelefone) : string {

    if (strlen($sTelefone) < 11) {
      return "";
    }
    return substr($sTelefone, 0, 2);
  }

  /**
   * Retorna o número sem o DDD.
   * @param string $sTelefone
   * @return string
   */
  public static function getSemDDD(string $sTelefone) : string {

    if (strlen($sTelefone) < 11) {
      return $sTelefone;
    }
    return substr($sTelefone, 2);
  }
}