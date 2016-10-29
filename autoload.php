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

/**
 * Autoload para arquivos antigos que estão sendo migrados.
 * @param $sClass
 */
function meu_autoload($sClass) {

  $sNomeArquivo = "classes/{$sClass}.php";
  if (file_exists($sNomeArquivo)) {
    require_once($sNomeArquivo);
  }

  $sNomeArquivo = "dao/{$sClass}.php";
  if (file_exists($sNomeArquivo)) {
    require_once($sNomeArquivo);
  }

  $sNomeArquivo = "controller/{$sClass}.php";
  if (file_exists($sNomeArquivo)) {
    require_once($sNomeArquivo);
  }
}

spl_autoload_register("__autoload");
spl_autoload_register("meu_autoload");