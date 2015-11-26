<?php

class Animal {

  private $iCodigo;
  private $sNome;

  public function __construct($iCodigo, $sNome) {

    $this->iCodigo = $iCodigo;
    $this->sNome   = $sNome;
  }

  public function getCodigo() {
    return $this->iCodigo;
  }

  public function getNome() {
    return $this->sNome;
  }
}