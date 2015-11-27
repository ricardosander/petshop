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
  protected $aDados = array();

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
  protected function renderizarView($sArquivo) {

    $sArquivo = "view/{$this->getDiretorioView()}{$sArquivo}.php";

    if (file_exists($sArquivo)) {

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