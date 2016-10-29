<?php

use PetShop\DAO\Usuario as UsuarioDao;
use PetShop\Model\Usuario as Usuario;

class LoginController extends Controller {

    public function __construct() {

        parent::__construct();
        $this->sDiretorioView = "login";
    }

    public function login() {

        $this->setCabecalho("view/login/cabecalho.php");
        $this->setRodape("view/login/rodape.php");
    }

    public function loginPost() {

        if (!$this->getRequisicao()->isPost()) {
            $this->redireciona("/login/login");
        }

        if (!$this->getRequisicao()->isSetPost('usuario')) {

            $this->getSessao()->setMensagemErro("Usuário não informado.");
            $this->redireciona("/login/login");
        }

        if (!$this->getRequisicao()->isSetPost('senha')) {

            $this->getSessao()->setMensagemErro("Senha não informada.");
            $this->redireciona("/login/login");
        }

        $oUsuario = new Usuario();
        $oUsuario->setUsuario($this->getRequisicao()->getPost('usuario'));
        $oUsuario->setSenha(md5($this->getRequisicao()->getPost('senha')));

        $oDaoUsuario = new UsuarioDao();
        if (!$oDaoUsuario->validarUsuario($oUsuario)) {

            $this->getSessao()->setMensagemErro("Usuário ou senha inválido.");
            $this->redireciona("/login/login/");
        }


        $oUsuario->setSenha(null);
        $this->getSessao()->logarUsuario($oUsuario);

        $this->getSessao()->setMensagemSucesso("Logado com sucesso.");
        $this->redireciona("/");
    }

    public function logout() {

        if ($this->getSessao()->isUsuarioLogado()) {
            $this->getSessao()->deslogar();
        }

        $this->redireciona("/login/login");
    }
}