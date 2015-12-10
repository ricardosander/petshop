<?php

/**
 * Interface Paginacao
 * Interface para ser utilizada por classes que controlam paginação.
 */
interface Paginacao {

    public function __construct($iRegistrosPorPagina, $iTotalRegistros, $iPagina);

    /**
     * Retorna a quantidade de registros das páginas anteriores a atual.
     * @return int
     */
    public function getOffset();

    /**
     * Retorna o número de registros por página.
     * @return int
     */
    public function getLimit();

    /**
     * Retorna o HTML da paginação para ser impresso na view.
     * @return String
     */
    public function getPaginacao();

    /**
     * Retorna o SQL para paginar a query.
     * @return string
     */
    public function getSql();

    /**
     * Seta as informações referentes a busca realizada via GET.
     * @param array $aBuscaNome
     * @return void
     */
    public function setParametros($aBuscaNome);
}