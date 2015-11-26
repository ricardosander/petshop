<?php

class Banco {

  private $conn;

  public function conectar() {

    $sHost   = "localhost";
    $sDbName = "petshop";
    $sPort   = "5432";
    $sUser   = "root";
    $sPassword = "root";

    $rsConn = @pg_connect("host={$sHost} port={$sPort} dbname={$sDbName} user={$sUser} password={$sPassword}");

    if ($rsConn === false)  {
      throw new Exception("Falha na conexão.");
    }
    $this->conn = $rsConn;
  }

  public function query($sSql) {

    $rsQuery = @pg_query($this->conn, $sSql);

    if ($rsQuery === false) {
      throw new Exception("Falha na query.");
    }
    return $rsQuery;
  }

  public function numeroLinhas($rsQuery) {
    return pg_num_rows($rsQuery);
  }

  public function getResgitro($rsQuery, $iLinha) {

    $iNumeroCampos = pg_num_fields($rsQuery);
    
    $aCampos = array();
    for ($iCampo = 0; $iCampo < $iNumeroCampos; $iCampo++) {
      $aCampos[$iCampo] = pg_field_name($rsQuery, $iCampo);
    }

    $oStdClas = new stdClass();
    foreach ($aCampos as $iCampo => $sCampo) {
      $oStdClas->{$sCampo} = pg_fetch_result($rsQuery, $iLinha, $iCampo);
    }

    return $oStdClas;
  }
}