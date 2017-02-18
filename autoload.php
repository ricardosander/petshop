<?php
/**
 * Autoload para classes dentro de app com namespace.
 * @param $sClass
 */
function __autoload($sClass) {

    $sClass = 'app/' . str_replace('\\', '/', $sClass) . '.php';
    if (file_exists($sClass)) {
        require_once($sClass);
    }
}
spl_autoload_register("__autoload");