<?php

namespace PetShop\Model;

class Usuario {

  private $iCodigo;
  private $sUsuario;
  private $sSenha;

  public function __construct() {

  }

  /**
   * @return mixed
   */
  public function getCodigo() {
    return $this->iCodigo;
  }

  /**
   * @param mixed $iCodigo
   */
  public function setCodigo($iCodigo) {
    $this->iCodigo = $iCodigo;
  }

  /**
   * @return mixed
   */
  public function getUsuario() {
    return $this->sUsuario;
  }

  /**
   * @param mixed $sUsuario
   */
  public function setUsuario($sUsuario) {
    $this->sUsuario = $sUsuario;
  }

  /**
   * @return mixed
   */
  public function getSenha() {
    return $this->sSenha;
  }

  /**
   * @param mixed $sSenha
   */
  public function setSenha($sSenha) {
    $this->sSenha = $sSenha;
  }

}