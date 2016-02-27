<?php

class PaginacaoSimples implements Paginacao {

  /**
   * @var int Número de registros por página.
   */
  private $iRegistrosPorPagina;

  /**
   * @var int Número total de registros.
   */
  private $iTotalRegistros;

  /**
   * @var int Página atual.
   */
  private $iPagina;

  /**
   * Parâmetros
   * @var array
   */
  private $aParametros;

  /**
   * @var string
   */
  private $sModulo;

  public function __construct($sModulo, $iRegistrosPorPagina, $iTotalRegistros, $iPagina) {

    $this->iRegistrosPorPagina = $iRegistrosPorPagina;
    $this->iTotalRegistros = $iTotalRegistros;
    $this->iPagina = $iPagina;
    $this->sModulo = $sModulo;
  }

  public function getOffset() {
    return ($this->iPagina - 1) * $this->iRegistrosPorPagina;
  }

  public function getLimit() {
    return $this->iRegistrosPorPagina;
  }

  public function getPaginacao() {

    if ($this->iTotalRegistros <= $this->iRegistrosPorPagina) {
      return "";
    }

    $sParametros = "";
    if (!empty($this->aParametros)) {

      $aParametrosAux = array();
      $aParametrosAux[] = "busca=1";
      foreach ($this->aParametros as $sChave => $sValor) {
        $aParametrosAux[] = "{$sChave}={$sValor}";
      }
      $sParametros = "?" . implode("&", $aParametrosAux);
    }

    $iTotalPaginas = intval($this->iTotalRegistros / $this->iRegistrosPorPagina);

    if ($this->iTotalRegistros % $this->iRegistrosPorPagina > 0) {
      $iTotalPaginas++;
    }

    $sHtml = "<p class='text-info'>Página {$this->iPagina}/{$iTotalPaginas}</p>";
    $sHtml .= "<ul class='pagination'>";

    //Calcula as posições inicial e final da paginação.
    $iPaginaInicio = ($this->iPagina - 2) > 0               ? $this->iPagina - 2 : 1;
    $iPaginaFim    = ($this->iPagina + 2) <= $iTotalPaginas ? $this->iPagina + 2 : $iTotalPaginas;

    //Ajustando valores para sempre ter 5 páginas.
    $iPaginaInicio -= $iPaginaFim > ($iTotalPaginas - 2) ? 4 - $iPaginaFim + $iPaginaInicio : 0;
    $iPaginaFim    += $iPaginaInicio < 3                 ? 4 - $iPaginaFim + $iPaginaInicio : 0;

    //Calcula páginas anterior e posterior.
    $iPaginaAnterior = ($this->iPagina - 1) > 0               ? $this->iPagina - 1 : 1;
    $iProximaPagina  = ($this->iPagina + 1) <= $iTotalPaginas ? $this->iPagina + 1 : $iTotalPaginas;

    $sHtml .= "<li><a href='/{$this->sModulo}/lista/1'><<</a></li>";
    $sHtml .= "<li><a href='/{$this->sModulo}/lista/{$iPaginaAnterior}'><</a></li>";
    for ($i = $iPaginaInicio; $i <= $iPaginaFim; $i++) {

      $sLink    = "/{$this->sModulo}/lista/{$i}";
      $sClass   = "";

      if ($i == $this->iPagina) {

        $sLink = "#";
        $sClass = "class='active'";
      }

      $sHtml .= "<li {$sClass} ><a href='{$sLink}'>{$i}</a></li>";
    }

    $sHtml .= "<li><a href='/{$this->sModulo}/lista/{$iProximaPagina}'>></a></li>";
    $sHtml .= "<li><a href='/{$this->sModulo}/lista/{$iTotalPaginas}'>>></a></li>";

    $sHtml .= "</ul><br>({$this->iTotalRegistros} resultados)<br><br>";
    return $sHtml;
  }

  public function getSql() {
    return " limit {$this->getLimit()} offset {$this->getOffset()} ";
  }

  public function setParametros($aParametros) {
    $this->aParametros = $aParametros;
  }
}