<?php

class Animal {

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
    private $sEspecie;

    /**
     * @var string
     */
    private $sRaca;

    /**
     * @var string
     */
    private $sPelo;

    /**
     * @var string
     */
    private $sPelagem;

    /**
     * @var string
     */
    private $sPorte;

    /**
     * @var double
     */
    private $nPeso;

    /**
     * @var DateTime
     */
    private $oNascimento;

    /**
     * @var DateTime
     */
    private $oCadastro;

    /**
     * @var boolean
     */
    private $lCastrado;

    /**
     * @var string
     */
    private $sObservacoes;

    /**
     * @var string
     */
    private $sSexo;

    /**
     * @param integer $iCodigo
     */
    public function __construct($iCodigo = null) {

        //TODO fazer leazy load
    }

    /**
     * @return integer
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
    public function getEspecie() {
        return $this->sEspecie;
    }

    /**
     * @return string
     */
    public function getRaca() {
        return $this->sRaca;
    }

    /**
     * @return string
     */
    public function getPelo() {
        return $this->sPelo;
    }

    /**
     * @return string
     */
    public function getPelagem() {
        return $this->sPelagem;
    }

    /**
     * @return string
     */
    public function getPorte() {
        return $this->sPorte;
    }

    /**
     * @return number
     */
    public function getPeso() {
        return $this->nPeso;
    }

    /**
     * @return DateTime
     */
    public function getNascimento() {
        return $this->oNascimento;
    }

    /**
     * Retorna a data de nascimento formatada.
     * @param string $sFormato
     * @return string
     */
    public function getNascimentoFormatado($sFormato = "Y-m-d") {

        if (is_null($this->oNascimento)) {
            return "";
        }
        return $this->oNascimento->format($sFormato);
    }

    /**
     * @return DateTime
     */
    public function getCadastro() {
        return $this->oCadastro;
    }


    /**
     * Retorna a data de cadastro formatada.
     * @param string $sFormato
     * @return string
     */
    public function getCadastroFormatado($sFormato = "Y-m-d") {

        if (is_null($this->oCadastro)) {
            return "";
        }
        return $this->oCadastro->format($sFormato);
    }

    /**
     * @return boolean
     */
    public function isCastrado() {
        return $this->lCastrado;
    }

    /**
     * @return string
     */
    public function getObservacoes() {
        return $this->sObservacoes;
    }

    /**
     * @return string
     */
    public function getSexo() {
        return $this->sSexo;
    }

    /**
     * @param integer $iCodigo
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
     * @param string $sEspecie
     */
    public function setEspecie($sEspecie) {
        $this->sEspecie = $sEspecie;
    }

    /**
     * @param string $sRaca
     */
    public function setRaca($sRaca) {
        $this->sRaca = $sRaca;
    }

    /**
     * @param string $sPelo
     */
    public function setPelo($sPelo) {
        $this->sPelo = $sPelo;
    }

    /**
     * @param string $sPelagem
     */
    public function setPelagem($sPelagem) {
        $this->sPelagem = $sPelagem;
    }

    /**
     * @param string $sPorte
     */
    public function setPorte($sPorte) {
        $this->sPorte = $sPorte;
    }

    /**
     * @param number $nPeso
     */
    public function setPeso($nPeso) {
        $this->nPeso = $nPeso;
    }

    /**
     * @param DateTime $oNascimento
     */
    public function setNascimento($oNascimento) {
        $this->oNascimento = $oNascimento;
    }

    /**
     * @param DateTime $oCadastro
     */
    public function setCadastro($oCadastro) {
        $this->oCadastro = $oCadastro;
    }

    /**
     * @param boolean $lCastrado
     */
    public function setCastrado($lCastrado) {
        $this->lCastrado = $lCastrado;
    }

    /**
     * @param string $sObservacoes
     */
    public function setObservacoes($sObservacoes) {
        $this->sObservacoes = $sObservacoes;
    }

    /**
     * @param string $sSexo
     */
    public function setSexo($sSexo) {
        $this->sSexo = $sSexo;
    }
}