<?php
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

spl_autoload_register("meu_autoload");