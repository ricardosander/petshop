<?php

class AnimalController extends Controller {

  public function __construct() {

    $this->sDiretorioView = "animal";
  }

  public function lista() {

    try {

      $oDaoAniamis = new AnimalDao();
      $aAnimais    = $oDaoAniamis->buscarTodos();

      $this->aDados['aAnimais'] = $aAnimais;

    } catch (Exception $e) {
      die($e->getMessage());
    }

    $this->renderizarView("lista");
  }
}