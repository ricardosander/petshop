<?php

use PetShop\Http\Requisicao;
use PetShop\Http\Sessao;

/**
 * Class Controller
 * Classe básica para o manipulação de controllers no modelo MVC.
 */
abstract class Controller {

    /**
     * Diretório onde estarão as views para o controller.
     * @var string
     */
    protected $sDiretorioView = "";

    /**
     * Dados do controller que serão inclusos na view.
     * @var array
     */
    protected $aDados = array();

    /**
     * Caminho dos arquivos Javascrip para serem carregados.
     * @var array
     */
    protected $aScripts = array();

    /**
     * Caminho dos arquivos CSS para serem carregados.
     * @var array
     */
    protected $aCss = array();

    /**
     * Nome do arquivo para renderização da view.
     * @var string
     */
    protected $sView;

    /**
     * Cabeçalho padrão
     * @var string
     */
    private $sCabecalho = "view/base/cabecalho.php";

    /**
     * Rodapé padrão
     * @var string
     */
    private $sRodape = "view/base/rodape.php";

    /**
     * Objeto para manipulação de sessão.
     * @var Sessao
     */
    private $oSessao;

    /**
     * @var Requisicao
     */
    private $oRequisicao;

    public function __construct() {


        $sCaminho = "http://".$_SERVER['HTTP_HOST'];

        $this->aCss[] = "{$sCaminho}/css/bootstrap.css";
        $this->aCss[] = "{$sCaminho}/css/bootstrap-theme.css";
        $this->aCss[] = "{$sCaminho}/css/bootstrap-submenu.css";
        $this->aCss[] = "{$sCaminho}/css/petshop.css";

        $this->aScripts[] = "{$sCaminho}/js/jquery.min.js";
        $this->aScripts[] = "{$sCaminho}/js/bootstrap.js";
        $this->aScripts[] = "{$sCaminho}/js/bootstrap-submenu.js";
        $this->oRequisicao = new Requisicao($_SERVER, $_REQUEST);
        $this->oSessao     = new Sessao();
    }

    /**
     * @param string $sView
     */
    public function setView($sView) {
        $this->sView = $sView;
    }

    /**
     * Retorna o nome do diretório da view.
     * @return string
     */
    protected function getDiretorioView() {

        if (empty($this->sDiretorioView)) {
            return "";
        }
        return "{$this->sDiretorioView}/";
    }

    /**
     * Renderiza a view.
     * @param string $sArquivo Nome do arquivo para ser incluído.
     */
    protected function renderizarView($sArquivo = "") {

        if (empty($sArquivo)) {
            $sArquivo = $this->sView;
        }

        $this->setRecursos($sArquivo);

        $sArquivo = "view/{$this->getDiretorioView()}{$sArquivo}.php";

        if (file_exists($sArquivo)) {

            $this->aDados['aScripts'] = $this->aScripts;
            $this->aDados['aCss']     = $this->aCss;

            $this->aDados['sMsg']       = $this->getSessao()->getMensagem();
            $this->aDados['sStatus']    = $this->getSessao()->getTipoMensagem();
            $this->aDados['sUltimaUri'] = $this->getSessao()->getUltimaUri();
            $this->aDados['sUri']       = $this->getRequisicao()->getUri();


            foreach ($this->aDados as $sChave => $oValor) {
                $$sChave = $oValor;
            }

            $this->getSessao()->atualizaUltimaUri($this->getRequisicao()->getUri());

            include($this->sCabecalho);
            include($sArquivo);
            include($this->sRodape);
            return;
        }
        $this->__call(null, null);
    }

    /**
     * @param $sArquivo
     */
    private function setRecursos($sArquivo) {

        $sCaminho = "{$this->getDiretorioView()}$sArquivo";
        $sCss = "css/{$sCaminho}.css";
        $sJs = "js/{$sCaminho}.js";

        if (file_exists($sCss)) {
            $this->aCss[] = "../../{$sCss}";
        }

        if (file_exists($sJs)) {
            $this->aScripts[] = "../../{$sJs}";
        }
    }

    /**
     * Método chamado caso o metodo do controller não exista
     * @param $metodo
     * @param $argumentos
     */
    public function __call($metodo, $argumentos) {

        $this->sDiretorioView = "index";
        $this->renderizarView("404");
    }

    /**
     * Retorna um objeto que representa a sessão.
     * @return Sessao
     */
    public function getSessao() {
        return $this->oSessao;
    }

    /**
     * @return Requisicao
     */
    public function getRequisicao() {
        return $this->oRequisicao;
    }

    /**
     * Redireciona
     * @param string $sUri URI para o redirecionamento.
     */
    public function redireciona($sUri) {

        header("Location: {$sUri}");
        die;
    }

    protected function setCabecalho($sCabecalho) {
        $this->sCabecalho = $sCabecalho;
    }

    protected function setRodape($sRodape) {
        $this->sRodape = $sRodape;
    }
}