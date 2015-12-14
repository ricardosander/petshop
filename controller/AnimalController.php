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
        $this->aScripts[] = "../../js/jquery.maskedinput.js";
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
        $oAnimal->setClientePacote($this->getRequisicao()->isSetPost('temPacote'));

        $sDataNascimento = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('nascimento'))));
        $sDataCadastro   = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('cadastro'))));

        try {

            $oValidador = new AnimalValidador();
            $oValidador->setDados(array(
                "animal" => $oAnimal,
                "data_nascimento" => $sDataNascimento,
                "data_cadastro"   => $sDataCadastro)
            );
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
        $this->aScripts[] = "../../js/jquery.maskedinput.js";
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
        $oAnimal->setClientePacote($this->getRequisicao()->isSetPost('temPacote'));

        $sDataNascimento = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('nascimento'))));
        $sDataCadastro   = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('cadastro'))));

        try {

            $oValidador = new AnimalValidador();
            $oValidador->setDados(array(
                'animal' => $oAnimal,
                'data_cadastro' => $sDataCadastro,
                'data_nascimento' => $sDataNascimento)
            );
            $oValidador->validar();

            $oAnimal->setCadastro(new DateTime($sDataCadastro));
            $oAnimal->setNascimento(new DateTime($sDataNascimento));

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
        if ($this->getRequisicao()->isSetGet("busca")) {

            $sBuscaNome = trim($this->getRequisicao()->getGet("nomeBusca"));
            $this->aDados['sBuscaNome'] = $sBuscaNome;

            $oDao = new AnimalDao();
            $sBuscaNome = $oDao->escapeString($sBuscaNome);

            $sWhere = str_replace(" ", "%' or nome like '%", $sBuscaNome);
            $sWhere = " nome like '%{$sWhere}%' ";
        }

        $iPagina    = 1;
        $iPorPagina = 10;
        try {

            $oDaoAniamis = new AnimalDao();
            $iTotal      = $oDaoAniamis->contarTodos($this->getSessao()->getUsuarioLogado()->getCodigo(), $sWhere);

            if (count($this->getRequisicao()->getParametros()) > 0) {

                $iPagina = $this->getRequisicao()->getParametros()[0];
                if (empty($iPagina) || $iPagina < 1) {
                    $iPagina = 1;
                }
            }
            $oPaginacao = new AnimalPaginacao($iPorPagina, $iTotal, $iPagina);
            if ($this->getRequisicao()->isSetGet("busca")) {

                $aBuscaNome              = array();
                $aBuscaNome['nomeBusca'] = trim($this->getRequisicao()->getGet("nomeBusca"));
                $oPaginacao->setParametros($aBuscaNome);
            }
            $aAnimais = $oDaoAniamis->buscarTodos($this->getSessao()->getUsuarioLogado()->getCodigo(), $sWhere, $oPaginacao);

            $this->aDados['aAnimais']   = $aAnimais;
            $this->aDados['oPaginacao'] = $oPaginacao;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}