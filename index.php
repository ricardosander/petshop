<?php
declare(strict_types=1);
try {

  header('Content-Type: text/html; charset=utf-8');
  require_once("autoload.php");

  $controller = new FrontController();
  $controller->run();
} catch (Throwable $e) {

  //TODO adicionar página estática com o erro.
  die("O erro técnico ocorreu. Contate o suporte");
}
die;