<?php
interface Banco {

  public function iniciaTransacao();
  public function encerraTransacao($lErro);
  public function temTransacao();
  public function conectar();
  public function query($sSql);
  public function numeroLinhas($rsQuery);
  public function getResgitro($rsQuery, $iLinha);
  public function escapeStrings($sString);
}