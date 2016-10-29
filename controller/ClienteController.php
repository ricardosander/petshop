<?php

use PetShop\Paginacao\PaginacaoSimples;
use PetShop\Model\Animal;
use PetShop\Model\Cliente;
use PetShop\Validador\Cliente as Validador;
use PetShop\Entidade\Cliente as Entidade;
use PetShop\Entidade\Animal as EntidadeAnimal;
use PetShop\Utils;

class ClienteController extends Controller {

  public function __construct() {

    parent::__construct();
    if (!$this->getSessao()->isUsuarioLogado()) {

      header("Location: /login/login/");
      die;
    }
    $this->sDiretorioView = "cliente";
  }

  public function lista() {

    $iPagina    = 1;
    $iPorPagina = 10;
    try {

      $oDao = new Entidade();
      $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
      $iTotal = $oDao->contar($sWhere);

      if (count($this->getRequisicao()->getParametros()) > 0) {

        $iPagina = $this->getRequisicao()->getParametros()[0];
        if (empty($iPagina) || $iPagina < 1) {
          $iPagina = 1;
        }
      }
      $oPaginacao = new PaginacaoSimples("cliente", $iPorPagina, $iTotal, $iPagina);

      $aClientes = $oDao->buscar("*", $sWhere, "nome", $oPaginacao);

      $this->aDados['selecao']    = false;
      $this->aDados['aClientes']  = $aClientes;
      $this->aDados['oPaginacao'] = $oPaginacao;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function selecionar() {


    if (count($this->getRequisicao()->getParametros()) < 2) {

      $this->getSessao()->setMensagemErro("Parâmetros não informados.");
      $this->redireciona("/animal/lista");
    }

    $sVinculo = $this->getRequisicao()->getParametros()[0];//animal
    $iCodigoAnimal = $this->getRequisicao()->getParametros()[1];//id do animal

    try {

      $oDao = new Entidade();
      $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
      $aClientes = $oDao->buscar("*", $sWhere, "nome");

      $this->aDados['selecao'] = true;
      $this->aDados['vinculo'] = $sVinculo;
      $this->aDados['codigoVinculo'] = $iCodigoAnimal;
      $this->aDados['aClientes'] = $aClientes;
      $this->setView("lista");
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function seleciona() {

    if (count($this->getRequisicao()->getParametros()) < 3) {

      $this->getSessao()->setMensagemErro("Parâmetros não informados.");
      $this->redireciona("/cliente/lista");
    }

    $iCodigoCliente = $this->getRequisicao()->getParametros()[0];//id do cliente
    $sVinculo       = $this->getRequisicao()->getParametros()[1];//vínculo animal
    $iCodigoAnimal  = $this->getRequisicao()->getParametros()[2];//id do animal

    try {

      $oAnimal  = new Animal($iCodigoAnimal);
      $oCliente = new Cliente($iCodigoCliente);

      $this->aDados['oAnimal']  = $oAnimal;
      $this->aDados['oCliente'] = $oCliente;
      $this->setView("seleciona_" . $sVinculo);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function selecionaPost() {

    $iCodigoCliente = $this->getRequisicao()->getPost("codigo_cliente");
    $iCodigoAnimal  = $this->getRequisicao()->getPost("codigo_animal");

    $oDaoAnimal = new EntidadeAnimal();
    $oDaoAnimal->iniciaTransacao();

    try {

      $oAnimal  = new Animal($iCodigoAnimal);
      $oCliente = new Cliente($iCodigoCliente);

      $oAnimal->setCliente($oCliente);
      if (!$oDaoAnimal->salvar($oAnimal)) {
        throw new Exception("O vínculo enter Animal e Cliente não pode ser feito. Contate o suporte.");
      }
      $oDaoAnimal->encerraTransacao(false);

      $this->getSessao()->setMensagemSucesso("Cliente vínculado ao animal com sucesso.");
      $this->redireciona("/animal/ver/{$iCodigoAnimal}");
    } catch (Exception $e) {

      $oDaoAnimal->encerraTransacao(true);
      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/animal/ver/{$iCodigoAnimal}");
    }
  }

  public function ver() {

    if (empty($this->getRequisicao()->getParametros())) {

      $this->getSessao()->setMensagemErro("Cliente não informado.");
      $this->redireciona("/cliente/lista");
    }
    $iCodigo = $this->getRequisicao()->getParametros()[0];

    $oDaoCliente = new Entidade();
    $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oCliente = $oDaoCliente->buscarPorCodigo($iCodigo, $sWhere);
    $aAnimais = $oCliente->getAnimais();

    if ($oCliente == false) {

      $this->getSessao()->setMensagemErro("Cliente não encontrado.");
      $this->redireciona("/cliente/lista");
    }
    $this->aDados["oCliente"] = $oCliente;
    $this->aDados["aAnimais"] = $aAnimais;
  }

  public function cadastro() {

    if ($this->getSessao()->getObjeto("cliente")) {

      $this->aDados['oCiente'] = $this->getSessao()->getObjeto("cliente");
      $this->getSessao()->removeObjeto("cliente");
    }

    if ($this->getRequisicao()->isSetGet("animal")) {

      $iCodigoAnimal = trim($this->getRequisicao()->getGet("animal"));
      $this->aDados['codigo_animal'] = $iCodigoAnimal;
    }

    $this->aScripts[] = "../../js/jquery.maskedinput.js";
  }

  public function cadastroPost() {

    if (!$this->getRequisicao()->isPost()) {
      $this->redireciona("/animal/cadastro");
    }

    try {

      $nSaldoDevedor = Utils::stringToFloat($this->getRequisicao()->getPost('saldo_devedor'));
      if (empty($nSaldoDevedor)) {
        $nSaldoDevedor = 0;
      }

      $sDDD1 = $this->getRequisicao()->getPost("ddd1");
      $sDDD2 = $this->getRequisicao()->getPost("ddd2");
      $sDDD3 = $this->getRequisicao()->getPost("ddd3");
      $sDDD4 = $this->getRequisicao()->getPost("ddd4");
      $sDDD5 = $this->getRequisicao()->getPost("ddd5");

      $sTelefone  = $sDDD1 . str_replace("-", "", $this->getRequisicao()->getPost("telefone"));
      $sTelefone2 = !empty($this->getRequisicao()->getPost("telefone2")) ? $sDDD2 . str_replace("-", "", $this->getRequisicao()->getPost("telefone2")) : null;
      $sTelefone3 = !empty($this->getRequisicao()->getPost("telefone3")) ? $sDDD3 . str_replace("-", "", $this->getRequisicao()->getPost("telefone3")) : null;
      $sTelefone4 = !empty($this->getRequisicao()->getPost("telefone4")) ? $sDDD4 . str_replace("-", "", $this->getRequisicao()->getPost("telefone4")) : null;
      $sTelefone5 = !empty($this->getRequisicao()->getPost("telefone5")) ? $sDDD5 . str_replace("-", "", $this->getRequisicao()->getPost("telefone5")) : null;

      $oCliente = new Cliente();
      $oCliente->setNome($this->getRequisicao()->getPost("nome"));
      $oCliente->setNomeSecundario($this->getRequisicao()->getPost("nome_secundario"));
      $oCliente->setEndereco($this->getRequisicao()->getPost("endereco"));
      $oCliente->setBairro($this->getRequisicao()->getPost("bairro"));
      $oCliente->setTelefone($sTelefone);
      $oCliente->setTelefone2($sTelefone2);
      $oCliente->setTelefone3($sTelefone3);
      $oCliente->setTelefone4($sTelefone4);
      $oCliente->setTelefone5($sTelefone5);
      $oCliente->setObservacao($this->getRequisicao()->getPost("observacao"));
      $oCliente->setSaldoDevedor($nSaldoDevedor);
      $oCliente->setUsuario($this->getSessao()->getUsuarioLogado()->getCodigo());

      $oValidador  = new Validador();
      $oDaoCliente = new Entidade();
      $oDaoCliente->iniciaTransacao();

      $oValidador->setDados(array('cliente' => $oCliente));
      $oValidador->validar();

      if (!$oDaoCliente->salvar($oCliente)) {
        throw new Exception("Houve um erro ao tentar inserir o cliente. Contate suporte.");
      }

      $sDestino = "/cliente/cadastro";
      if ($this->getRequisicao()->isSetPost("codigo_animal")
        && !empty($this->getRequisicao()->getPost("codigo_animal"))
      ) {

        $iCodigoAnimal = $this->getRequisicao()->getPost("codigo_animal");
        $oAnimal = new Animal($iCodigoAnimal);
        $oAnimal->setCliente($oCliente);

        $oDaoAnimal = new EntidadeAnimal();
        if (!$oDaoAnimal->salvar($oAnimal)) {
          throw new Exception("Houve um erro ao tentar atualizar animal. Contate suporte.");
        }
        $sDestino = "/cliente/ver/{$oCliente->getCodigo()}";
      }
      $oDaoCliente->encerraTransacao(false);

      $this->getSessao()->setMensagemSucesso("Cliente adicionado com sucesso.");
      $this->redireciona($sDestino);

    } catch (Exception $e) {

      $oDaoCliente->encerraTransacao(true);
      $this->getSessao()->setObjeto("cliente", $oCliente);
      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/cliente/cadastro");
    }
  }

  public function editar() {

    if (empty($this->getRequisicao()->getParametros())) {

      $this->getSessao()->setMensagemErro("Cliente não informado.");
      $this->redireciona("/cliente/lista");
    }
    $iCodigo = $this->getRequisicao()->getParametros()[0];

    $oDao = new Entidade();

    $sWhere = "usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oCliente = $oDao->buscarPorCodigo($iCodigo, $sWhere);
    if ($oCliente === false) {

      $this->getSessao()->setMensagemErro("Cliente não encontrado.");
      $this->redireciona("/cliente/lista");
    }
    $this->aDados["oCliente"] = $oCliente;
    $this->aDados["sAcao"] = "editar";
    $this->aDados["sAcaoBotao"] = "Atualizar";
    $this->aScripts[] = "../../js/jquery.maskedinput.js";
    $this->setView("cadastro");
  }

  public function editarPost() {

    if (!$this->getRequisicao()->isPost()) {
      $this->redireciona("/cliente/editar/");
    }

    $nSaldoDevedor = Utils::stringToFloat($this->getRequisicao()->getPost('saldo_devedor'));
    if (empty($nSaldoDevedor)) {
      $nSaldoDevedor = 0;
    }

    $sDDD1 = $this->getRequisicao()->getPost("ddd1");
    $sDDD2 = $this->getRequisicao()->getPost("ddd2");
    $sDDD3 = $this->getRequisicao()->getPost("ddd3");
    $sDDD4 = $this->getRequisicao()->getPost("ddd4");
    $sDDD5 = $this->getRequisicao()->getPost("ddd5");

    $sTelefone  = $sDDD1 . str_replace("-", "", $this->getRequisicao()->getPost("telefone"));
    $sTelefone2 = !empty($this->getRequisicao()->getPost("telefone2")) ? $sDDD2 . str_replace("-", "", $this->getRequisicao()->getPost("telefone2")) : null;
    $sTelefone3 = !empty($this->getRequisicao()->getPost("telefone3")) ? $sDDD3 . str_replace("-", "", $this->getRequisicao()->getPost("telefone3")) : null;
    $sTelefone4 = !empty($this->getRequisicao()->getPost("telefone4")) ? $sDDD4 . str_replace("-", "", $this->getRequisicao()->getPost("telefone4")) : null;
    $sTelefone5 = !empty($this->getRequisicao()->getPost("telefone5")) ? $sDDD5 . str_replace("-", "", $this->getRequisicao()->getPost("telefone5")) : null;

    $oCliente = new Cliente();
    $oCliente->setCodigo($this->getRequisicao()->getPost("id"));
    $oCliente->setNome($this->getRequisicao()->getPost("nome"));
    $oCliente->setNomeSecundario($this->getRequisicao()->getPost("nome_secundario"));
    $oCliente->setEndereco($this->getRequisicao()->getPost("endereco"));
    $oCliente->setBairro($this->getRequisicao()->getPost("bairro"));
    $oCliente->setTelefone($sTelefone);
    $oCliente->setTelefone2($sTelefone2);
    $oCliente->setTelefone3($sTelefone3);
    $oCliente->setTelefone4($sTelefone4);
    $oCliente->setTelefone5($sTelefone5);
    $oCliente->setObservacao($this->getRequisicao()->getPost("observacao"));
    $oCliente->setSaldoDevedor($nSaldoDevedor);
    $oCliente->setUsuario($this->getSessao()->getUsuarioLogado()->getCodigo());

    try {

      $oValidador = new Validador();
      $oDao       = new Entidade();
      $oDao->iniciaTransacao();


      $oValidador->setDados(array('cliente' => $oCliente));
      $oValidador->validar();

      if (empty($oCliente->getCodigo())) {
        throw new Exception("Cliente não identificado para a edição.");
      }

      if (!$oDao->salvar($oCliente)) {
        throw new Exception("Houve um erro ao tentar atualizar o cliente. Contate suporte.");
      }
      $oDao->encerraTransacao(false);

      $this->getSessao()->setMensagemSucesso("Cliente atualizado com sucesso.");
      $this->redireciona("/cliente/lista");

    } catch (Exception $e) {

      $oDao->encerraTransacao(true);
      $this->getSessao()->setObjeto("cliente", $oCliente);
      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/cliente/editar/{$oCliente->getCodigo()}");
    }
  }

  public function excluir() {

    if (empty($this->getRequisicao()->getParametros())) {

      $this->getSessao()->setMensagemErro("Cliente não informado.");
      $this->redireciona("/cliente/lista");
    }
    $iCodigo = $this->getRequisicao()->getParametros()[0];

    $oDao = new Entidade();
    $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    $oCliente = $oDao->buscarPorCodigo($iCodigo, $sWhere);

    if ($oCliente === false) {

      $this->getSessao()->setMensagemErro("Cliente não encontrado.");
      $this->redireciona("/cliente/lista");
    }
    $this->aDados["oCliente"] = $oCliente;
  }

  public function excluirPost() {

    if (!$this->getRequisicao()->isPost()) {
      $this->redireciona("/cliente/lista");
    }

    $iCodigo = $this->getRequisicao()->getPost("codigo");
    $lExcluiAnimais = $this->getRequisicao()->getPost("excluirAnimais");

    $oDao = new Entidade();
    $oDaoAnimal = new EntidadeAnimal();
    $sWhere = " usuario = " . $this->getSessao()->getUsuarioLogado()->getCodigo();
    try {

      $oDao->iniciaTransacao();
      $oCliente = $oDao->buscarPorCodigo($iCodigo, $sWhere);

      if ($oCliente === false || empty($oCliente->getCodigo())) {
        throw new Exception("Cliente não encontrada para exclusão.");
      }

      $aAnimais = $oCliente->getAnimais();

      if ($aAnimais === false) {
        throw new Exception("Houve um erro ao buscar os animais do Cliente. Contate o suporte.");
      }

      foreach ($aAnimais as $oAnimal) {

        if ($lExcluiAnimais) {

          if (!$oDaoAnimal->excluir($oAnimal)) {
            throw new Exception("Houve um problema ao excluir o Animal do Cliente. Contate o suporte.");
          }
          continue;
        }
        $oAnimal->setCliente(null);

        if (!$oDaoAnimal->salvar($oAnimal)) {
          throw new Exception("Houve um erro ao desvincular o Cliente e o Animal. Contate o suporte.");
        }
      }

      if (!$oDao->excluir($oCliente)) {
        throw new Exception("Não foi possível excluir o Cliente. Contate o suporte.");
      }

      $oDao->encerraTransacao(false);
      $this->getSessao()->setMensagemSucesso("Cliente excluido com sucesso.");
      $this->redireciona("/cliente/lista");

    } catch (Exception $e) {

      $oDao->encerraTransacao(true);
      $this->getSessao()->setMensagemErro($e->getMessage());
      $this->redireciona("/cliente/excluir/{$iCodigo}");
    }
  }
}