<?php

namespace PetShop\Model;

use PetShop\Entidade\Cliente as Entidade;
use PetShop\Entidade\Animal as EntidadeAnimal;
use PetShop\Entidade\Telefone as EntidadeTelefone;
use \Exception;

class Cliente {

  /**
   * @var int
   */
  private $iCodigo;

  /**
   * @var string
   */
  private $sNome;

  /**
   * @var string
   */
  private $sNomeSecundario;

  /**
   * @var string
   */
  private $sEndereco;

  /**
   * @var string
   */
  private $sBairro;

  /**
   * @var Telefone[]
   */
  private $telefones = null;

  /**
   * @var string
   */
  private $sObservacao;

  /**
   * @var float
   */
  private $nSaldoDevedor = 0;

  /**
   * @var int
   */
  private $iUsuario;

  /**
   * @var Animal[]
   */
  private $aAnimais = null;

  public function __construct($iCodigo = "") {

    if (!empty($iCodigo)) {

      $oDao = new Entidade();
      $lRetorno = $oDao->buscarPorCodigo($iCodigo, "", $this);

      if ($lRetorno === false) {
        throw new Exception("Cliente não encontrado.");
      }
    }
  }

  /**
   * @return int
   */
  public function getCodigo() {
    return $this->iCodigo;
  }

  /**
   * @return string
   */
  public function getNome() {
    return $this->sNome;
  }

  /**
   * @return string
   */
  public function getNomeSecundario() {
    return $this->sNomeSecundario;
  }

  /**
   * @return string
   */
  public function getEndereco() {
    return $this->sEndereco;
  }

  /**
   * @return string
   */
  public function getBairro() {
    return $this->sBairro;
  }

  /**
   * @return Telefone[]
   */
  public function getTelefones() {

      if (is_null($this->telefones)) {

          $this->telefones = array();

          $daoTelefones = new EntidadeTelefone();
          $where = " cliente = " . $this->getCodigo();
          $order = "id";
          $telefones = $daoTelefones->buscar("*", $where, $order);

          if ($telefones !== false) {
              $this->telefones = $telefones;
          }
      }
      return $this->telefones;
  }

  /**
   * @return string
   */
  public function getObservacao() {
    return $this->sObservacao;
  }

  /**
   * @return float
   */
  public function getSaldoDevedor() {
    return $this->nSaldoDevedor;
  }

  /**
   * @return bool
   */
  public function isDevedor() {
    return $this->nSaldoDevedor > 0;
  }

  /**
   * @return int
   */
  public function getUsuario() {
    return $this->iUsuario;
  }

  public function getAnimais() {

    if (is_null($this->aAnimais)) {

      $this->aAnimais = array();

      $oDaoAnimais = new EntidadeAnimal();
      $sWhere = " cliente = " . $this->getCodigo();
      $aAnimais = $oDaoAnimais->buscar("*", $sWhere);

      if ($aAnimais !== false) {
        $this->aAnimais = $aAnimais;
      }

    }
    return $this->aAnimais;
  }

  /**
   * @param int $iCodigo
   */
  public function setCodigo($iCodigo) {
    $this->iCodigo = $iCodigo;
  }

  /**
   * @param string $sNome
   */
  public function setNome($sNome) {
    $this->sNome = $sNome;
  }

  /**
   * @param string $sNomeSecundario
   */
  public function setNomeSecundario($sNomeSecundario) {
    $this->sNomeSecundario = $sNomeSecundario;
  }

  /**
   * @param string $sEndereco
   */
  public function setEndereco($sEndereco) {
    $this->sEndereco = $sEndereco;
  }

  /**
   * @param string $sBairro
   */
  public function setBairro($sBairro) {
    $this->sBairro = $sBairro;
  }

  /**
   * @param Telefone[] $telefones
   */
  public function setTelefones($telefones) {
    $this->telefones = $telefones;
  }

  /**
   * @param string $sObservacao
   */
  public function setObservacao($sObservacao) {
    $this->sObservacao = $sObservacao;
  }

  /**
   * @param float $nSaldoDevedor
   */
  public function setSaldoDevedor($nSaldoDevedor) {
    $this->nSaldoDevedor = $nSaldoDevedor;
  }

  /**
   * @param $iUsuario
   */
  public function setUsuario($iUsuario) {
    $this->iUsuario = $iUsuario;;
  }
}