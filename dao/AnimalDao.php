<?php

class AnimalDao {

  private $oBanco;

  public function __construct() {
    $this->oBanco = new MySQLBanco();
  }

  public function buscarTodos() {

    $sSqlBuscar = "select * from animal";
    $this->oBanco->conectar();
    $rsAnimais = $this->oBanco->query($sSqlBuscar);
    $iNumeroAnimais = $this->oBanco->numeroLinhas($rsAnimais);

    $aRegistros = array();
    for ($i = 0; $i < $iNumeroAnimais; $i++) {
      $aRegistros[] = $this->oBanco->getResgitro($rsAnimais, $i);
    }

    $aAnimais = array();
    foreach ($aRegistros as $oRegistro) {
      $aAnimais[] = new Animal($oRegistro->id, $oRegistro->nome);
    }
    return $aAnimais;
  }
}