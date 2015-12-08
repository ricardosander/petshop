<?php

class AnimalController extends Controller {

    public function __construct() {

        parent::__construct();
        if (!$this->getSessao()->isUsuarioLogado()) {

            header("Location: /login/login/");
            die;
        }
        $this->sDiretorioView = "animal";
    }

    public function cadastro() {

        if ($this->getSessao()->getObjeto("animal")) {
            $this->aDados['oAnimal'] = $this->getSessao()->getObjeto("animal");
            $this->getSessao()->removeObjeto("animal");
        }
    }

    public function cadastroPost() {

        if (!$this->getRequisicao()->isPost()) {
            $this->redireciona("/animal/cadastro");
        }

        $nPeso = Utils::stringToFloat($this->getRequisicao()->getPost('peso'));

        $oAnimal = new Animal();
        $oAnimal->setNome($this->getRequisicao()->getPost('nome'));
        $oAnimal->setEspecie($this->getRequisicao()->getPost('especie'));
        $oAnimal->setRaca($this->getRequisicao()->getPost('raca'));
        $oAnimal->setPelo($this->getRequisicao()->getPost('pelo'));
        $oAnimal->setPelagem($this->getRequisicao()->getPost('pelagem'));
        $oAnimal->setPorte($this->getRequisicao()->getPost('porte'));
        $oAnimal->setPeso($nPeso);
        $oAnimal->setObservacoes($this->getRequisicao()->getPost('observacoes'));
        $oAnimal->setSexo($this->getRequisicao()->getPost('sexo'));
        $oAnimal->setCastrado($this->getRequisicao()->isSetPost('castrado'));

        $sDataNascimento = $this->getRequisicao()->getPost('nascimento');
        $sDataCadastro   = $this->getRequisicao()->getPost('cadastro');

        $oDataNascimento = null;
        $oDataCadastro   = null;

        $aErroDatas = array();
        try {

            if (count(explode("/", $sDataNascimento)) == 3) {
                $sDataNascimento = implode("-", array_reverse(explode("/", $sDataNascimento)));
            }
            $oDataNascimento = new DateTime($sDataNascimento);
        } catch (Exception $e) {
            $aErroDatas[] = "O campo Nascimento informado não é uma data válida.";
        }

        try {

            if (count(explode("/", $sDataCadastro)) == 3) {
                $sDataCadastro = implode("-", array_reverse(explode("/", $sDataCadastro)));
            }

            $oDataCadastro   = new DateTime($sDataCadastro);
        } catch (Exception $e) {
            $aErroDatas[] = "O campo Cadastro informado não é uma data válida.";
        }

        $oAnimal->setNascimento($oDataNascimento);
        $oAnimal->setCadastro($oDataCadastro);

        try {

            $oValidador = new AnimalValidador();
            $oValidador->setDados($oAnimal);
            $oValidador->validar();

            if (!empty($aErroDatas)) {
                throw new Exception(implode("<br>", $aErroDatas));
            }

            $oDao = new AnimalDao();
            if (!$oDao->inserir($oAnimal, $this->getSessao()->getUsuarioLogado()->getCodigo())) {
                throw new Exception("Houve um erro ao tentar inserir o animal. Contate suporte.");
            }

            $this->getSessao()->setMensagemSucesso("Animal adicionado com sucesso.");
            $this->redireciona("/animal/cadastro");

        } catch (Exception $e) {

            $this->getSessao()->setObjeto("animal" , $oAnimal);
            $this->getSessao()->setMensagemErro($e->getMessage());
            $this->redireciona("/animal/cadastro");
        }
    }

    public function editar() {

        if (empty($this->getRequisicao()->getParametros())) {

            $this->getSessao()->setMensagemErro("Animal não informado.");
            $this->redireciona("/animal/lista");
        }
        $iCodigo = $this->getRequisicao()->getParametros()[0];

        $oDaoAnimal = new AnimalDao();
        $oAnimal = $oDaoAnimal->buscarPorCodigo($iCodigo, $this->getSessao()->getUsuarioLogado()->getCodigo());

        if ($oAnimal === false) {

            $this->getSessao()->setMensagemErro("Animal não encontrado.");
            $this->redireciona("/animal/lista");
        }
        $this->aDados["oAnimal"]   = $oAnimal;
        $this->aDados["sAcao"]     = "editar";
        $this->aDados["sAcaoBotao"] = "Atualizar";
        $this->setView("cadastro");
    }

    public function editarPost() {

        if (!$this->getRequisicao()->isPost()) {
            $this->redireciona("/animal/editar/");
        }

        $nPeso = Utils::stringToFloat($this->getRequisicao()->getPost('peso'));

        $oAnimal = new Animal();
        $oAnimal->setCodigo($this->getRequisicao()->getPost("id"));
        $oAnimal->setNome($this->getRequisicao()->getPost('nome'));
        $oAnimal->setEspecie($this->getRequisicao()->getPost('especie'));
        $oAnimal->setRaca($this->getRequisicao()->getPost('raca'));
        $oAnimal->setPelo($this->getRequisicao()->getPost('pelo'));
        $oAnimal->setPelagem($this->getRequisicao()->getPost('pelagem'));
        $oAnimal->setPorte($this->getRequisicao()->getPost('porte'));
        $oAnimal->setPeso($nPeso);
        $oAnimal->setObservacoes($this->getRequisicao()->getPost('observacoes'));
        $oAnimal->setSexo($this->getRequisicao()->getPost('sexo'));
        $oAnimal->setCastrado($this->getRequisicao()->isSetPost('castrado'));

        $sDataNascimento = $this->getRequisicao()->getPost('nascimento');
        $sDataCadastro   = $this->getRequisicao()->getPost('cadastro');

        $oDataNascimento = null;
        $oDataCadastro   = null;

        $aErroDatas = array();
        try {

            if (count(explode("/", $sDataNascimento)) == 3) {
                $sDataNascimento = implode("-", array_reverse(explode("/", $sDataNascimento)));
            }

            $oDataNascimento = new DateTime($sDataNascimento);
        } catch (Exception $e) {
            $aErroDatas[] = "O campo Nascimento informado não é uma data válida.";
        }

        try {

            if (count(explode("/", $sDataCadastro)) == 3) {
                $sDataCadastro = implode("-", array_reverse(explode("/", $sDataCadastro)));
            }

            $oDataCadastro   = new DateTime($sDataCadastro);
        } catch (Exception $e) {
            $aErroDatas[] = "O campo Cadastro informado não é uma data válida.";
        }

        $oAnimal->setNascimento($oDataNascimento);
        $oAnimal->setCadastro($oDataCadastro);

        try {

            $oValidador = new AnimalValidador();
            $oValidador->setDados($oAnimal);
            $oValidador->validar();

            if (empty($oAnimal->getCodigo())) {
                throw new Exception("Animal não identificado para a edição.");
            }

            if (!empty($aErroDatas)) {
                throw new Exception(implode("<br>", $aErroDatas));
            }

            $oDao = new AnimalDao();
            if (!$oDao->atualizar($oAnimal, $this->getSessao()->getUsuarioLogado()->getCodigo())) {
                throw new Exception("Houve um erro ao tentar atualizar o animal. Contate suporte.");
            }

            $this->getSessao()->setMensagemSucesso("Animal atualizado com sucesso.");
            $this->redireciona("/animal/lista");

        } catch (Exception $e) {

            $this->getSessao()->setObjeto("animal", $oAnimal);
            $this->getSessao()->setMensagemErro($e->getMessage());
            $this->redireciona("/animal/editar/{$oAnimal->getCodigo()}");
        }
    }

    public function excluir() {

        if (empty($this->getRequisicao()->getParametros())) {

            $this->getSessao()->setMensagemErro("Animal não informado.");
            $this->redireciona("/animal/lista");
        }
        $iCodigo = $this->getRequisicao()->getParametros()[0];

        $oDaoAnimal = new AnimalDao();
        $oAnimal = $oDaoAnimal->buscarPorCodigo($iCodigo, $this->getSessao()->getUsuarioLogado()->getCodigo());

        if ($oAnimal === false) {

            $this->getSessao()->setMensagemErro("Animal não encontrado.");
            $this->redireciona("/animal/lista");
        }
        $this->aDados["oAnimal"] = $oAnimal;
    }

    public function excluirPost() {

        if (!$this->getRequisicao()->isPost()) {
            $this->redireciona("/animal/lista");
        }

        $iCodigo = $this->getRequisicao()->getPost("codigo");

        $oDaoAnimal = new AnimalDao();
        $oAnimal = $oDaoAnimal->buscarPorCodigo($iCodigo, $this->getSessao()->getUsuarioLogado()->getCodigo());

        try {

            if (empty($oAnimal->getCodigo())) {
                throw new Exception("Animal não identificado para a edição.");
            }

            if (!$oDaoAnimal->excluir($oAnimal, $this->getSessao()->getUsuarioLogado()->getCodigo())) {
                throw new Exception("Houve um erro ao tentar excluir o Animal. Conte o suporte.");
            }
            $this->getSessao()->setMensagemSucesso("Animal excluído com sucesso.");
            $this->redireciona("/animal/lista");

        } catch (Exception $e) {

            $this->getSessao()->setObjeto("animal", $oAnimal);
            $this->getSessao()->setMensagemErro($e->getMessage());
            $this->redireciona("/animal/excluir/{$oAnimal->getCodigo()}");
        }
    }

    public function ver() {

        if (empty($this->getRequisicao()->getParametros())) {

            $this->getSessao()->setMensagemErro("Animal não informado.");
            $this->redireciona("/animal/lista");
        }
        $iCodigo = $this->getRequisicao()->getParametros()[0];

        $oDaoAnimal = new AnimalDao();
        $oAnimal = $oDaoAnimal->buscarPorCodigo($iCodigo, $this->getSessao()->getUsuarioLogado()->getCodigo());

        if ($oAnimal === false) {

            $this->getSessao()->setMensagemErro("Animal não encontrado.");
            $this->redireciona("/animal/lista");
        }
        $this->aDados["oAnimal"] = $oAnimal;
    }

    public function lista() {

        $sWhere = "";
        if ($this->getRequisicao()->isGet("busca")) {

            $sBuscaNome = trim($this->getRequisicao()->getGet("nomeBusca"));
            $this->aDados['sBuscaNome'] = $sBuscaNome;

            $oDao = new AnimalDao();
            $sBuscaNome = $oDao->escapeString($sBuscaNome);

            $sWhere = str_replace(" ", "%' or nome like '%", $sBuscaNome);
            $sWhere = " nome like '%{$sWhere}%' ";
        }

        try {

            $oDaoAniamis = new AnimalDao();
            $aAnimais = $oDaoAniamis->buscarTodos($this->getSessao()->getUsuarioLogado()->getCodigo(), $sWhere);

            $this->aDados['aAnimais'] = $aAnimais;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}