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

    //Cálcula a página de inicio da paginação.
    $iInicio = $this->iPagina - 2;
    if ($iInicio < 1) {
      $iInicio = 1;
    }

    //Cálcula a página de fim da paginação.
    $iFim = $this->iPagina + 2;
    if ($iFim > $iTotalPaginas) {
      $iFim = $iTotalPaginas;
    }

    //Ajusta a diferença para sempre termos 5 páginas sequenciais.
    if (($iFim - $iInicio) != 4) {

      $iDifenca = 4 - ($iFim - $iInicio);
      if ($iInicio == 1) {
        $iFim += $iDifenca;
      }

      if ($iFim == $iTotalPaginas) {
        $iInicio -= $iDifenca;
      }
    }

    if ($iInicio < 1) {
      $iInicio = 1;
    }

    if ($iFim > $iTotalPaginas) {
      $iFim = $iTotalPaginas;
    }

    for ($i = $iInicio; $i <= $iFim; $i++) {

      $sCaminho = "/{$this->sModulo}/lista";
      $sLink    = "{$sCaminho}/{$i}";
      $sClass   = "";

      if ($i == $iInicio && $i != $this->iPagina && $iInicio != 1) {
        $sHtml .= $this->montaLinkPaginacao(1, "{$sCaminho}/1", $sParametros);

        if (($i - 1) != 1) {
          $sHtml .= $this->montaLinkPaginacao("...", "");
        }
      }

      if ($i == $this->iPagina) {

        $sLink = "#";
        $sClass = "class='active'";
      }

      $sHtml .= $this->montaLinkPaginacao($i, $sLink, $sParametros, $sClass);

      if ($i == $iFim && $iFim != $iTotalPaginas) {

        if (($i + 1) != $iTotalPaginas) {
          $sHtml .= $this->montaLinkPaginacao("...", "");
        }
        $sHtml .= $this->montaLinkPaginacao($iTotalPaginas, "{$sCaminho}/{$iTotalPaginas}", $sParametros);
      }
    }

    $sHtml .= "</ul><br>({$this->iTotalRegistros} resultados)<br><br>";
    return $sHtml;
  }

  private function montaLinkPaginacao($iPosicao, $sLink, $sParametros = "", $sClass = "") {

    if (!empty($sLink)) {
      $sLink = "href='{$sLink}{$sParametros}'";
    }
    return "<li {$sClass} ><a {$sLink}>{$iPosicao}</a></li>";
  }

  public function getSql() {
    return " limit {$this->getLimit()} offset {$this->getOffset()} ";
  }

  public function setParametros($aParametros) {
    $this->aParametros = $aParametros;
  }
}