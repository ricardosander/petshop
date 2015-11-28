<?php

class AnimalController extends Controller {

  public function __construct() {

    parent::__construct();
    $this->sDiretorioView = "animal";
  }

  public function lista() {

    try {

      $oDaoAniamis = new AnimalDao();
      $aAnimais    = $oDaoAniamis->buscarTodos();

      $this->aDados['aAnimais'] = $aAnimais;

      $this->renderizarView();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}