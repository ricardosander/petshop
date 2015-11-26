<html>
<head>
  <link href="css/bootstrap.css" type="text/css" rel="stylesheet" >
</head>
<body>
<div class="container">
  <h1>Bem vindo ao sistema petshop web</h1>
<?php
require_once("autoload.php");


try {

  $oDaoAniamis = new AnimalDao();
  $aAnimais = $oDaoAniamis->buscarTodos();

  foreach ($aAnimais as $oAnimal) {
    echo "{$oAnimal->getCodigo()} - {$oAnimal->getNome()}<br>";
  }

} catch (Exception $e) {
  echo $e->getMessage();
}
?>
</div>
</body></html>
