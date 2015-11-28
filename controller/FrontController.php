<?php

class FrontController extends Controller {

  /**
   * Controller que ser� utilizado.
   * @var string
   */
  private $sController;

  /**
   * M�todo que ser� executado.
   * @var string
   */
  private $sAcao;

  /**
   * Par�metros.
   * @var string
   */
  private $sParametros;

  /**
   * URI base do sistema
   * @var string
   */
  private $sBasePath = "";

  public function __construct() {

    parent::__construct();
    $this->sDiretorioView = "index";
  }

  /**
   * Index do sistema, utilizado ao acessar a URI base (tela de boas vindas).
   */
  public function index() {
    $this->renderizarView("index");
  }

  /**
   * Processa a URI acessada para redirecionar ao Controller/M�todo correto.
   */
  private function processaUri() {

    $sPath = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    $sPath = preg_replace('/[^a-zA-Z0-9]\//', "", $sPath);
    if (!empty($this->sBasePath) && strpos($sPath, $this->sBasePath) === 0) {
      $sPath = substr($sPath, strlen($this->sBasePath));
    }
    @list($sController, $sAcao, $sParametross) = explode("/", $sPath, 3);

    if (!empty($sController)) {

      $sController .= "Controller";
      $sController = ucfirst($sController);
    }

    if (empty($sAcao)) {
      $sAcao = "index";
    }

    $this->sController = $sController;
    $this->sAcao       = $sAcao;
    $this->sParametros = $sParametross;
  }

  /**
   * Executa a l�gica de recep��o do usu�rio.
   */
  public function run() {

    $this->processaUri();

    $oController = $this;
    if (!empty($this->sController)) {

      if (!file_exists("controller/{$this->sController}.php")) {

        $this->__call(null, null);
        return;
      }
      $oController = new $this->sController();
    }
    $oController->setView($this->sAcao);
    $oController->{$this->sAcao}();
  }
}