<?php

class Requisicao {

    private static $TIPO_GET  = "GET";
    private static $TIPO_POST = "POST";

    /**
     * @var object Guarda as informações relacionadas ao POST.
     */
    private $oPost;

    /**
     * @var object Guarda as informações relacionadas ao GET.
     */
    private $oGet;

    /**
     * @var string Guarda o tipo de requisição que foi feita.
     */
    private $sTipo;

    /**
     * @var string URI requisitada.
     */
    private $sURI;

    /**
     * @var array Parâemtros da URI.
     */
    private $aParametros;

    public function __construct(array $aServer, array $aRequest) {

        $this->sURI  = $aServer['REQUEST_URI'];
        $this->sTipo = $aServer['REQUEST_METHOD'];

        $oObjeto = $this->requestToObject($aRequest);

        if ($this->isGet()) {
            $this->oGet = $oObjeto;
        }

        if ($this->isPost()) {
            $this->oPost = $oObjeto;
        }
    }

    /**
     * Transforma um array em objeto.
     * @param array $aRequest
     * @return stdClass
     */
    private function requestToObject(array $aRequest) {

        $oObjeto = new stdClass();
        foreach ($aRequest as $sChave => $sValor) {
            $oObjeto->{$sChave} = $sValor;
        }
        return $oObjeto;
    }

    public function getUri() {
        return $this->sURI;
    }

    /**
     * Identifica se o tipo de requisição é POST.
     * @return bool
     */
    public function isPost() {
        return $this->sTipo == self::$TIPO_POST;
    }

    /**
     * Identifica se o tipo de requisição é GET.
     * @return bool
     */
    public function isGet() {
        return $this->sTipo == self::$TIPO_GET;
    }

    /**
     * Verifica se um atributo foi enviado via GET.
     * @param string $sAtributo Nome do atributo.
     * @return bool
     */
    public function isSetGet($sAtributo) {
        return isset($this->oGet->{$sAtributo});
    }

    /**
     * Retorna o valor de um atributo enviado via GET.
     * @param string $sAtributo Nome do atributo.
     * @return string
     */
    public function getGet($sAtributo) {

        $sRetorno = "";
        if ($this->isSetGet($sAtributo)) {
            $sRetorno = $this->oGet->{$sAtributo};
        }
        return $sRetorno;
    }

    /**
     * Verifiva se um atributo foi enviado via POST.
     * @param string $sAtributo Nome do atributo.
     * @return bool
     */
    public function isSetPost($sAtributo) {
        return isset($this->oPost->{$sAtributo});
    }

    /**
     * Retorna o valor de um atributo enviado via POST.
     * @param string $sAtributo Nome do atributo.
     * @return string
     */
    public function getPost($sAtributo) {

        $sRetorno = "";
        if ($this->isSetPost($sAtributo)) {
            $sRetorno = $this->oPost->{$sAtributo};
        }
        return $sRetorno;
    }

    /**
     * @return array
     */
    public function getParametros() {
        return $this->aParametros;
    }

    /**
     * @param $aParametros
     */
    public function setParametros(array $aParametros) {
        $this->aParametros = $aParametros;
    }
}