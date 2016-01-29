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

    public function __construct($sModulo, $iRegistrosPorPagina, $iTotalRegistros, $iPagina) {

        $this->iRegistrosPorPagina = $iRegistrosPorPagina;
        $this->iTotalRegistros     = $iTotalRegistros;
        $this->iPagina             = $iPagina;
        $this->sModulo             = $sModulo;
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

            $aParametrosAux   = array();
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

        $sHtml  = "<p class='text-info'>Página {$this->iPagina}/{$iTotalPaginas}</p>";
        $sHtml .= "<ul class='pagination'>";


        for ($i = 1; $i <= $iTotalPaginas; $i++) {

            $sLink  = "/{$this->sModulo}/lista/{$i}";
            $sClass = "";

            if ($i == $this->iPagina) {

                $sLink  = "#";
                $sClass = "class='active'";
            }

            $sHtml .= "<li {$sClass} ><a href='{$sLink}{$sParametros}'>{$i}</a></li>";
        }

        $sHtml .= "</ul><br>";
        return $sHtml;
    }

    public function getSql() {
        return " limit {$this->getLimit()} offset {$this->getOffset()} ";
    }

    public function setParametros($aParametros) {
        $this->aParametros = $aParametros;
    }
}