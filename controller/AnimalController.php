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

  public function selecionar() {


    if (count($this->getRequisicao()->getParametros()) < 2) {

      $this->getSessao()->setMensagemErro("Parâmetros não informados.");
      $this->redireciona("/cliente/lista");
    }

    $sVinculo = $this->getRequisicao()->getParametros()[0];
    $iCodigoCliente = $this->getRequisicao()->getParametros()[1];

    try {

      $oDao = new AnimalEntidadeDao();
      $sWhere = " cliente is null and usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
      $aAnimais = $oDao->buscar("*", $sWhere);

      $this->aDados['selecao'] = true;
      $this->aDados['vinculo'] = $sVinculo;
      $this->aDados['codigoVinculo'] = $iCodigoCliente;
      $this->aDados['aAnimais'] = $aAnimais;
      $this->setView("lista");
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function seleciona() {

    if (count($this->getRequisicao()->getParametros()) < 3) {

      $this->getSessao()->setMensagemErro("Parâmetros não informados.");
      $this->redireciona("/animal/lista");
    }

    $iCodigoAnimal = $this->getRequisicao()->getParametros()[0];
    $sVinculo = $this->getRequisicao()->getParametros()[1];
    $iCodigoCliente = $this->getRequisicao()->getParametros()[2];

    try {

      $oAnimal = new Animal($iCodigoAnimal);
      $oCliente = new Cliente($iCodigoCliente);

      $this->aDados['oAnimal'] = $oAnimal;
      $this->aDados['oCliente'] = $oCliente;
      $this->setView("seleciona_" . $sVinculo);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function selecionaPost() {

    $iCodigoCliente = $this->getRequisicao()->getPost("codigo_cliente");
    $iCodigoAnimal = $this->getRequisicao()->getPost("codigo_animal");

    $oDaoAnimal = new AnimalEntidadeDao();

    try {

      $oAnimal = new Animal($iCodigoAnimal);
      $oCliente = new Cliente($iCodigoCliente);
      $oAnimal->setCliente($oCliente);

      if (!$oDaoAnimal->salvar($oAnimal)) {
        throw new Exception("O vínculo enter Animal e Cliente não pode ser feito. Contate o suporte.");
      }

      $this->getSessao()->setMensagemSucesso("Cliente vínculado ao Animal com sucesso.");
      $this->redireciona("/cliente/ver/{$iCodigoCliente}");
    } catch (Exception $e) {

      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/animal/ver/{$iCodigoAnimal}");
    }
  }

  public function cadastro() {

    if ($this->getSessao()->getObjeto("animal")) {

      $this->aDados['oAnimal'] = $this->getSessao()->getObjeto("animal");
      $this->getSessao()->removeObjeto("animal");
    }

    if ($this->getRequisicao()->isSetGet("cliente")) {

      $iCodigoCliente = trim($this->getRequisicao()->getGet("cliente"));
      $this->aDados['codigo_cliente'] = $iCodigoCliente;
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
    $oAnimal->setUsuario($this->getSessao()->getUsuarioLogado()->getCodigo());

    $sDestino = null;
    if ($this->getRequisicao()->isSetPost("codigo_cliente")
      && !empty($this->getRequisicao()->getPost("codigo_cliente"))
    ) {

      $iCodigoCliente = $this->getRequisicao()->getPost("codigo_cliente");
      $oAnimal->setCliente(new Cliente($iCodigoCliente));
      $sDestino = "/cliente/ver/{$iCodigoCliente}";
    }

    $sDataNascimento = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('nascimento'))));
    $sDataCadastro = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('cadastro'))));

    try {

      $oValidador = new AnimalValidador();
      $oValidador->setDados(array(
          "animal" => $oAnimal,
          "data_nascimento" => $sDataNascimento,
          "data_cadastro" => $sDataCadastro)
      );
      $oValidador->validar();

      if (!empty($aErroDatas)) {
        throw new Exception(implode("<br>", $aErroDatas));
      }

      $oDao = new AnimalEntidadeDao();
      if (!$oDao->salvar($oAnimal)) {
        throw new Exception("Houve um erro ao tentar inserir o animal. Contate suporte.");
      }

      $this->getSessao()->setMensagemSucesso("Animal adicionado com sucesso.");

      if (empty($sDestino)) {
        $sDestino = "/cliente/cadastro?animal={$oAnimal->getCodigo()}";
      }
      $this->redireciona($sDestino);

    } catch (Exception $e) {

      $this->getSessao()->setObjeto("animal", $oAnimal);
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

    $oDao = new AnimalEntidadeDao();

    $sWhere = "usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oAnimal = $oDao->buscarPorCodigo($iCodigo, $sWhere);
    if ($oAnimal === false) {

      $this->getSessao()->setMensagemErro("Animal não encontrado.");
      $this->redireciona("/animal/lista");
    }
    $this->aDados["oAnimal"] = $oAnimal;
    $this->aDados["sAcao"] = "editar";
    $this->aDados["sAcaoBotao"] = "Atualizar";
    $this->aScripts[] = "../../js/jquery.maskedinput.js";
    $this->setView("cadastro");
  }

  public function editarPost() {

    if (!$this->getRequisicao()->isPost()) {
      $this->redireciona("/animal/editar/");
    }

    $nPeso = Utils::stringToFloat($this->getRequisicao()->getPost('peso'));

    $oAnimal = new Animal($this->getRequisicao()->getPost("id"));
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
    $oAnimal->setUsuario($this->getSessao()->getUsuarioLogado()->getCodigo());

    $sDataNascimento = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('nascimento'))));
    $sDataCadastro = implode("-", array_reverse(explode("/", $this->getRequisicao()->getPost('cadastro'))));

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

      $oDao = new AnimalEntidadeDao();
      if (!$oDao->salvar($oAnimal)) {
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

    $oDao = new AnimalEntidadeDao();
    $sWhere = "usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oAnimal = $oDao->buscarPorCodigo($iCodigo, $sWhere);

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

    $oDao = new AnimalEntidadeDao();
    $sWhere = "usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oAnimal = $oDao->buscarPorCodigo($iCodigo, $sWhere);

    try {

      if (empty($oAnimal->getCodigo())) {
        throw new Exception("Animal não identificado para a exclusão.");
      }

      if (!$oDao->excluir($oAnimal)) {
        throw new Exception("Houve um erro ao tentar excluir o Animal. Conte o suporte.");
      }
      $this->getSessao()->setMensagemSucesso("Animal excluído com sucesso.");
      $this->redireciona("/animal/lista");

    } catch (Exception $e) {

      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/animal/excluir/{$iCodigo}");
    }
  }

  public function ver() {

    if (empty($this->getRequisicao()->getParametros())) {

      $this->getSessao()->setMensagemErro("Animal não informado.");
      $this->redireciona("/animal/lista");
    }
    $iCodigo = $this->getRequisicao()->getParametros()[0];

    $oDao = new AnimalEntidadeDao();
    $sWhere = "usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oAnimal = $oDao->buscarPorCodigo($iCodigo, $sWhere);

    if ($oAnimal === false) {

      $this->getSessao()->setMensagemErro("Animal não encontrado.");
      $this->redireciona("/animal/lista");
    }
    $this->aDados["oAnimal"] = $oAnimal;
  }

  public function lista() {

    $sWhere     = "";
    $iPagina    = 1;
    $iPorPagina = 10;
    $oDao = new AnimalEntidadeDao();
    try {

      if ($this->getRequisicao()->isSetGet("busca")) {

        $sBuscaNome = trim($this->getRequisicao()->getGet("nomeBusca"));
        $this->aDados['sBuscaNome'] = $sBuscaNome;

        $sWherePesquisa = str_replace(" ", "%' or nome like '%", $sBuscaNome);
        $sWherePesquisa = " nome like '%{$sWherePesquisa}%' ";
      }

      $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();

      if (!empty($sWherePesquisa)) {
        $sWhere .= " and ($sWherePesquisa)";
      }

      $iTotal = $oDao->contar($sWhere);
      if (count($this->getRequisicao()->getParametros()) > 0) {

        $iPagina = $this->getRequisicao()->getParametros()[0];
        if (empty($iPagina) || $iPagina < 1) {
          $iPagina = 1;
        }
      }
      $oPaginacao = new PaginacaoSimples("animal", $iPorPagina, $iTotal, $iPagina);
      if ($this->getRequisicao()->isSetGet("busca")) {

        $aBuscaNome = array();
        $aBuscaNome['nomeBusca'] = trim($this->getRequisicao()->getGet("nomeBusca"));
        $oPaginacao->setParametros($aBuscaNome);
      }

      $aAnimais = $oDao->buscar("*", $sWhere, $oPaginacao);

      $this->aDados['selecao'] = false;
      $this->aDados['aAnimais'] = $aAnimais;
      $this->aDados['oPaginacao'] = $oPaginacao;

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}