<?php

namespace PetShop\Http;

use PetShop\DAO\Usuario as UsuarioDao;
use PetShop\Model\Usuario;

class Sessao {

    /**
     * @var Usuario
     */
    private $oUsuarioLogado = null;

    /**
     * @var string Mensagem para o usuário.
     */
    private $sMensagem;

    /**
     * @var string Tipo de mensagem par ao usuário.
     */
    private $sTipoMensagem;

    /**
     * @var array
     */
    private $aDados = array();

    /**
     * @var string Última URI acessada pelo usuário.
     */
    private $sUltimaURI = "";

    public function __construct() {

        $this->sMensagem     = "";
        $this->sTipoMensagem = "";

        $this->iniciaSessao();
        if (isset($_SESSION["usuario_logado"])) {

            $oDaoUsuario = new UsuarioDao();
            $oUsuario = $oDaoUsuario->buscarPorCodigo($_SESSION["usuario_logado"]);
            $this->oUsuarioLogado = $oUsuario;
        }

        if (isset($_SESSION["sTipoMsg"]) && !empty($_SESSION["sTipoMsg"])) {
            $this->sTipoMensagem = $_SESSION["sTipoMsg"];
        }

        if (isset($_SESSION["sMsg"]) && !empty($_SESSION["sMsg"])) {
            $this->sMensagem = $_SESSION["sMsg"];
        }

        if (isset($_SESSION['objetos'])) {
            $this->aDados['objetos'] = $_SESSION['objetos'];
        }

        if (isset($_SESSION['ultima_uri'])) {
            $this->sUltimaURI = $_SESSION['ultima_uri'];
        }
    }

    public function isUsuarioLogado() {

        return $this->oUsuarioLogado != null &&
        $this->oUsuarioLogado instanceof Usuario &&
        !empty($this->oUsuarioLogado->getUsuario());
    }

    public function logarUsuario(Usuario $oUsuario) {

        $this->oUsuarioLogado = $oUsuario;
        $_SESSION["usuario_logado"] = $oUsuario->getCodigo();
    }

    public function deslogar() {

        $this->oUsuarioLogado = null;
        $this->destroiSessao();
        $this->iniciaSessao();
    }

    public function getUsuarioLogado() {
        return clone $this->oUsuarioLogado;
    }

    private function iniciaSessao() {

        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    private function destroiSessao() {

        if (session_status() == PHP_SESSION_ACTIVE) {

            unset($_SESSION["usuario_logado"]);
            session_destroy();
        }
    }

    public function setMensagemErro($sMensagem) {
        $this->setMensagem($sMensagem, 'danger');
    }

    public function setMensagemSucesso($sMensagem) {
        $this->setMensagem($sMensagem, 'success');
    }

    public function setMensagem($sMensagem, $sTipo = '') {

        $_SESSION['sTipoMsg'] = $sTipo;
        $_SESSION['sMsg']     = $sMensagem;
        $this->sMensagem      = $sMensagem;
        $this->sTipoMensagem  = $sTipo;
    }

    public function getMensagem() {

        $sMensagem = $this->sMensagem;
        $this->sMensagem = "";
        unset($_SESSION['sMsg']);
        return $sMensagem;
    }

    public function getTipoMensagem() {

        $sTipo = $this->sTipoMensagem;
        $this->sTipoMensagem = "";
        unset($_SESSION['sTipoMsg']);
        return $sTipo;
    }

    public function setObjeto($sChave, $oObjeto) {

        $this->aDados['objetos'][$sChave] = $oObjeto;
        $_SESSION['objetos'][$sChave]     = $oObjeto;
    }

    public function getObjeto($sChave) {
        if (isset($this->aDados['objetos'][$sChave])) {
            return $this->aDados['objetos'][$sChave];
        }
        return false;
    }

    public function removeObjeto($sChave) {

        if (isset($_SESSION['objetos'][$sChave])) {
            unset($_SESSION['objetos'][$sChave]);
        }
    }

    public function atualizaUltimaUri($sUri) {

        $this->sUltimaURI       = $sUri;
        $_SESSION['ultima_uri'] = $sUri;
    }

    public function getUltimaUri() {
        return $this->sUltimaURI;
    }
}
