<?php

namespace PetShop\DAO;

use \MySQLBanco;
use \Cliente as Model;
use \stdClass;


class Cliente {

    /**
     * @var MySQLBanco
     */
    private $oBanco;

    public function __construct() {
        $this->oBanco = new MySQLBanco();
    }

    public function buscarTodos($iCodigoUsuario) {

        $this->oBanco->conectar();
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);
        $sSqlBuscar = "select * from cliente where usuario = {$iCodigoUsuario} ";

//        if (!empty($sWhere)) {
//            $sSqlBuscar .= " and ({$sWhere}) ";
//        }

//        if (!is_null($oPaginacao)) {
//            $sSqlBuscar .= $oPaginacao->getSql();
//        }

        $rsClientes = $this->oBanco->query($sSqlBuscar);
        $iNumeroClientes = $this->oBanco->numeroLinhas($rsClientes);

        $aRegistros = array();
        for ($i = 0; $i < $iNumeroClientes; $i++) {
            $aRegistros[] = $this->oBanco->getResgitro($rsClientes, $i);
        }

        $this->oBanco->fecharConexao();
        $aClientes = array();
        foreach ($aRegistros as $oRegistro) {
            $aClientes[] = $this->preencheCliente($oRegistro);
        }
        return $aClientes;
    }

    public function inserir(Model $oCliente, $iCodigoUsuario) {

        $this->oBanco->conectar();

        $aCampos  = array();
        $aValores = array();

        $aCampos[]   = "nome";
        $aValores[]  = "'" . $this->oBanco->escapeStrings($oCliente->getNome()) . "'";

        if (!empty($oCliente->getNomeSecundario())) {

            $aCampos[]  = "nome_secundario";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getNomeSecundario()) . "'";
        }

        $aCampos[]  = "endereco";
        $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getEndereco()) . "'";

        $aCampos[]  = "bairro";
        $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getBairro()) . "'";

        $aCampos[]  = "telefone";
        $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getTelefone()) . "'";

        if (!empty($oCliente->getTelefone2())) {

            $aCampos[]  = "telefone2";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getTelefone2()) . "'";
        }

        if (!empty($oCliente->getTelefone3())) {

            $aCampos[]  = "telefone3";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getTelefone3()) . "'";
        }

        if (!empty($oCliente->getTelefone4())) {

            $aCampos[]  = "telefone4";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getTelefone4()) . "'";
        }

        if (!empty($oCliente->getTelefone5())) {

            $aCampos[]  = "telefone5";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getTelefone5()) . "'";
        }

        if (!empty($oCliente->getObservacao())) {

            $aCampos[]  = "observacao";
            $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getObservacao()) . "'";
        }

        $aCampos[]  = "usuario";
        $aValores[] = "'" . $this->oBanco->escapeStrings($iCodigoUsuario) . "'";

        $aCampos[]  = "saldo_devedor";
        $aValores[] = "'" . $this->oBanco->escapeStrings($oCliente->getSaldoDevedor()) . "'";

        $sCampos  = implode(",", $aCampos);
        $sValores = implode(",", $aValores);

        $sSql = "insert into cliente ({$sCampos}) values ({$sValores})";

        $lRetorno = $this->oBanco->query($sSql);

        $this->oBanco->fecharConexao();

        return $lRetorno;
    }

    private function preencheCliente(stdClass $oRegistro) {

        $oCliente = new Model();
        $oCliente->setCodigo($oRegistro->id);
        $oCliente->setNome($oRegistro->nome);
        $oCliente->setNomeSecundario($oRegistro->nome_secundario);
        $oCliente->setEndereco($oRegistro->endereco);
        $oCliente->setBairro($oRegistro->bairro);
        $oCliente->setTelefone($oRegistro->telefone);
        $oCliente->setTelefone2($oRegistro->telefone2);
        $oCliente->setTelefone3($oRegistro->telefone3);
        $oCliente->setTelefone4($oRegistro->telefone4);
        $oCliente->setTelefone5($oRegistro->telefone5);
        $oCliente->setObservacao($oRegistro->observacao);
        $oCliente->setSaldoDevedor($oRegistro->saldo_devedor);

        return $oCliente;
    }

    public function buscarPorCodigo($iCodigo, $iCodigoUsuario) {

        $this->oBanco->conectar();
        $iCodigo        = $this->oBanco->escapeStrings($iCodigo);
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);
        $sSqlBuscar = "select * from cliente where id = {$iCodigo} and usuario = {$iCodigoUsuario} ";
        $rsClientes = $this->oBanco->query($sSqlBuscar);
        $iNumeroClientes = $this->oBanco->numeroLinhas($rsClientes);

        if ($iNumeroClientes== 0) {
            return false;
        }

        $oRegistro = $this->oBanco->getResgitro($rsClientes, 0);
        $this->oBanco->fecharConexao();
        return $this->preencheCliente($oRegistro);
    }

}