<?php

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
}