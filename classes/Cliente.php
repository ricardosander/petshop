<?php

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
   * @var string
   */
  private $sTelefone;

  /**
   * @var string
   */
  private $sTelefone2;

  /**
   * @var string
   */
  private $sTelefone3;

  /**
   * @var string
   */
  private $sTelefone4;

  /**
   * @var string
   */
  private $sTelefone5;

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

      $oDao = new ClienteEntidadeDao();
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
   * @return string
   */
  public function getTelefone() {
    return $this->sTelefone;
  }

  /**
   * @return string
   */
  public function getTelefone2() {
    return $this->sTelefone2;
  }

  /**
   * @return string
   */
  public function getTelefone3() {
    return $this->sTelefone3;
  }

  /**
   * @return string
   */
  public function getTelefone4() {
    return $this->sTelefone4;
  }

  /**
   * @return string
   */
  public function getTelefone5() {
    return $this->sTelefone5;
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

      $oDaoAnimais = new AnimalEntidadeDao();
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
   * @param string $sTelefone
   */
  public function setTelefone($sTelefone) {
    $this->sTelefone = $sTelefone;
  }

  /**
   * @param string $sTelefone2
   */
  public function setTelefone2($sTelefone2) {
    $this->sTelefone2 = $sTelefone2;
  }

  /**
   * @param string $sTelefone3
   */
  public function setTelefone3($sTelefone3) {
    $this->sTelefone3 = $sTelefone3;
  }

  /**
   * @param string $sTelefone4
   */
  public function setTelefone4($sTelefone4) {
    $this->sTelefone4 = $sTelefone4;
  }

  /**
   * @param string $sTelefone5
   */
  public function setTelefone5($sTelefone5) {
    $this->sTelefone5 = $sTelefone5;
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