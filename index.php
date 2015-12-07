<?php
header('Content-Type: text/html; charset=utf-8');
require_once("autoload.php");

$controller = new FrontController();
$controller->run();