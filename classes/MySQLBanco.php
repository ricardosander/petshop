<?php
class MySQLBanco implements Banco {

  private $conn;

  public function conectar() {

    $sHost = "localhost";
    $sUser = "root";
    $sPassword = "root";
    $sDataBase = "meupet";
    $sPorta = null;

    $this->conn = mysqli_connect($sHost, $sUser, $sPassword, $sDataBase, $sPorta);
  }

  public function query($sSql) {

    return mysqli_query($this->conn, $sSql);
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
}