<?php

namespace PetShop\DAO;

use \Usuario as Model;
use \MySQLBanco;

class Usuario {

  /**
   * @var Banco
   */
  private $oBanco;

  public function __construct() {
    $this->oBanco = new MySQLBanco();
  }

  public function validarUsuario(Model $oUsuario) {

    $this->oBanco->conectar();

    $sUsuario = $this->oBanco->escapeStrings($oUsuario->getUsuario());
    $sSenha   = $oUsuario->getSenha();

    $sSql = " select id from usuario where usuario = '{$sUsuario}'  and senha = '{$sSenha}';";

    $rsUsuario = $this->oBanco->query($sSql);

    if ($rsUsuario === false) {
      die($sSql);
    }

    $iLinhas = $this->oBanco->numeroLinhas($rsUsuario);

    if ($iLinhas != 1) {
        return false;
    }

      $oStdUsuario = $this->oBanco->getResgitro($rsUsuario, 0);
      $oUsuario->setCodigo($oStdUsuario->id);
      return true;
  }

  public function buscarPorCodigo($iCodigo) {

      $this->oBanco->conectar();
      $iCodigo = $this->oBanco->escapeStrings($iCodigo);

      $sSql = " select * from usuario where id = {$iCodigo} ;";

      $rsUsuario = $this->oBanco->query($sSql);

      if ($rsUsuario === false) {
          die($sSql);
      }

      $iLinhas = $this->oBanco->numeroLinhas($rsUsuario);

      if ($iLinhas != 1) {
          die("Erro ao buscar usuário");
      }

      $oStdUsuario = $this->oBanco->getResgitro($rsUsuario, 0);

      $oUsuario = new Model();
      $oUsuario->setCodigo($oStdUsuario->id);
      $oUsuario->setUsuario($oStdUsuario->usuario);

      return $oUsuario;
  }
}