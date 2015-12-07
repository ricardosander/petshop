<?php

class FrontController extends Controller {

    /**
     * Controller que será utilizado.
     * @var string
     */
    private $sController;

    /**
     * Método que será executado.
     * @var string
     */
    private $sAcao;

    /**
     * Parâmetros.
     * @var array
     */
    private $aParametros;

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

    }

    /**
     * Processa a URI acessada para redirecionar ao Controller/Método correto.
     */
    private function processaUri() {

        $sPath = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $sPath = preg_replace('/[^a-zA-Z0-9]\//', "", $sPath);
        if (!empty($this->sBasePath) && strpos($sPath, $this->sBasePath) === 0) {
            $sPath = substr($sPath, strlen($this->sBasePath));
        }
        @list($sController, $sAcao, $sParametros) = explode("/", $sPath, 3);

        if (!empty($sController)) {

            $sController .= "Controller";
            $sController = ucfirst($sController);
        }

        if (empty($sAcao)) {
            $sAcao = "index";
        }

        if ($this->getRequisicao()->isPost()) {
            $sAcao .= "Post";
        }

        $aParametros = explode("/", $sParametros);

        $this->sController = $sController;
        $this->sAcao = $sAcao;
        $this->aParametros = $aParametros;
    }

    /**
     * Executa a lógica de recepção do usuário.
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
        $oController->getRequisicao()->setParametros($this->aParametros);

        $oController->{$this->sAcao}();

        $oController->renderizarView();
    }
}