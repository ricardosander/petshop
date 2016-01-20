<?php

class MySQLBanco implements Banco {

  /**
   * @var mysqli
   */
  private $conn;

  private $lTransacao = false;

  public function iniciaTransacao() {

    if (is_null($this->conn)) {
      $this->conectar();
    }

    $this->lTransacao = mysqli_begin_transaction($this->conn);
    return $this->lTransacao;
  }

  public function encerraTransacao($lErro) {

    $this->lTransacao = false;
    if ($lErro) {
      $lRetorno = mysqli_rollback($this->conn);
    } else {
      $lRetorno = mysqli_commit($this->conn);
    }
    $this->fecharConexao();
    return $lRetorno;
  }

  public function temTransacao() {
    return $this->lTransacao;
  }

  public function conectar() {

    if (!isset($this->conn) && $this->temTransacao()) {
      return;
    }
    $sHost     = "localhost";
    $sUser     = "root";
    $sPassword = "root";
    $sDataBase = "meupet";
    $sPorta    = null;

    $this->conn = mysqli_connect($sHost, $sUser, $sPassword, $sDataBase, $sPorta);
  }

  public function query($sSql) {

    $lRetorno = mysqli_query($this->conn, $sSql);

    if ($lRetorno === false) {
      throw new Exception(mysqli_error($this->conn));
    }
    return $lRetorno;
  }

  public function ultimoId() {
    return mysqli_insert_id($this->conn);
  }

  public function numeroLinhas($rsQuery) {

    return mysqli_num_rows($rsQuery);
  }

  public function getResgitro($rsQuery, $iLinha) {

    $oStdClas = new stdClass();

    $aResult = mysqli_fetch_row($rsQuery);

    if ($aResult != null) {

      $aCampos = mysqli_fetch_fields($rsQuery);

      foreach ($aCampos as $iCampo => $aCampo) {
        $oStdClas->{$aCampo->name} = $aResult[$iCampo];
      }
    }

    return $oStdClas;
  }

  public function escapeStrings($sString) {
    return mysqli_real_escape_string($this->conn, $sString);
  }

  /**
   * Metodos Orientados a objeto.
   */


//    public function getResgitro($iLinha) {
//
//        $oStdClas = new stdClass();
//
//        $aResult = $this->result->fetch_row();
//
//        if ($aResult != null) {
//
//            $aCampos = $this->result->fetch_fields();
//
//            foreach ($aCampos as $iCampo => $aCampo) {
//                $oStdClas->{$aCampo->name} = $aResult[$iCampo];
//            }
//        }
//
//        return $oStdClas;
//    }
//
//    public function query($sSql) {
//        $this->result = $this->conn->query($sSql);
//    }
//
//    public function escapeStrings($sString) {
//        return $this->conn->real_escape_string($sString);
//    }
//
//    //Prepara um sql para ser rodado.
//    public function prepara($sSql) {
//        $this->stm = $this->conn->prepare($sSql);
//    }
//
//    //Atribui valores as variáveis da consulta
//    public function preparaValores($sTipo, $sValor) {
//        $this->stm->bind_param($sTipo, $sValor);
//    }
//
//    //Executa a consulta.
//    public function executa() {
//        return $this->stm->execute();
//    }
//
//    //Prepara as variáveis que receberão os valores dos resultados encontrados.
//    public function bind_result(&$var1, &$var2) {
//        return $this->stm->bind_result($var1, $var2);
//    }
//
//    //Coloca os resultados de uma linha encontradas nas variáveis e retorna true se ainda tiver mais registros.
//    public function fetch() {
//        return $this->stm->fetch();
//    }
//
//    //Número de linhas da query
//    public function numeroLinhas($rsQuery) {
//        return $this->result->num_rows;
//    }
//
//    //Fecha o statement
//    public function fechar() {
//        return $this->stm->close();
//    }
//
//    //Fecha a conexão.
  public function fecharConexao() {

    if (isset($this->conn) || $this->temTransacao()) {
      return true;
    }
    return $this->conn->close();
  }
//
//    public function store_result() {
//        return $this->stm->store_result();
//    }
//
//    public function result_metadata() {
//        $this->result2 = $this->stm->result_metadata();
//    }
//
//
//    public function fetch_fields() {
//        return $this->result->fetch_fields();
//    }
}