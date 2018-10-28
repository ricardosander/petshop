<?php

namespace PetShop\DAO;

use PetShop\DataBase\Factory;
use PetShop\Model\Sessao as Model;
use \stdClass;

class Sessao
{

    private $oBanco;

    public function __construct()
    {
        $this->oBanco = Factory::getBanco();
    }

    public function buscaPorToken($sToken)
    {

        $this->oBanco->conectar();

        $sSql = " SELECT * FROM sessao WHERE skey = \"" . $this->oBanco->escapeStrings($sToken) . "\"";
        $rsSessao = $this->oBanco->query($sSql);

        $iNumeroSessoes = $this->oBanco->numeroLinhas($rsSessao);

        if ($iNumeroSessoes == 0) {
            return false;
        }

        $oRegistro = $this->oBanco->getResgitro($rsSessao, 0);

        $this->oBanco->fecharConexao();

        return $this->preencher($oRegistro);
    }

    public function inserir(Model $oModel)
    {

        $this->oBanco->conectar();

        $iUsuario = $this->oBanco->escapeStrings($oModel->getIdUsuario());
        $sToken = "\"" . $this->oBanco->escapeStrings($oModel->getToken()) . "\"";

        $sSql = " insert into  sessao (usuario, token) values ({$iUsuario}, {$sToken}) ;";

        $lResultado =  $this->oBanco->query($sSql);

        $this->oBanco->fecharConexao();

        return $lResultado;
    }

    public function excluir(\PetShop\Model\Usuario $oUsuario)
    {
        $this->oBanco->conectar();

        $iUsuario = $oUsuario->getCodigo();
        if (empty($iUsuario)) {
            throw new \Exception("Código do Usuário da Sessão não informado.");
        }

        $this->oBanco->conectar();

        $iUsuario = $this->oBanco->escapeStrings($iUsuario);

        $sSql = " delete from sessao where usuario = {$iUsuario} ;";

        $lResultado =  $this->oBanco->query($sSql);

        $this->oBanco->fecharConexao();

        return $lResultado;
    }

    private function preencher(stdClass $oRegistro)
    {

        $oSessao = new Model();
        $oSessao->setId($oRegistro->id);
        $oSessao->setIdUsuario($oRegistro->usuario);
        $oSessao->setToken($oRegistro->token);

        return $oSessao;
    }

}