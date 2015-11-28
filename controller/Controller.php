<?php
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
  protected $aDados   = array();

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

  public function __construct() {

    $this->aCss[] = "../../css/bootstrap.css";
    $this->aCss[] = "../../css/bootstrap-theme.css";
    $this->aCss[] = "../../css/bootstrap-submenu.css";
    $this->aCss[] = "../../css/petshop.css";

    $this->aScripts[] = "../../js/jquery.min.js";
    $this->aScripts[] = "../../js/bootstrap.js";
    $this->aScripts[] = "../../js/bootstrap-submenu.js";
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

    $sArquivo = "view/{$this->getDiretorioView()}{$sArquivo}.php";

    if (file_exists($sArquivo)) {

      $this->aDados['aScripts'] = $this->aScripts;
      $this->aDados['aCss']     = $this->aCss;

      foreach ($this->aDados as $sChave => $oValor) {
        $$sChave = $oValor;
      }

      include($this->sCabecalho);
      include($sArquivo);
      include($this->sRodape);
      return;
    }
    $this->__call(null, null);
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
}