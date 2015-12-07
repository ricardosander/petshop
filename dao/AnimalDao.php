<?php

class AnimalDao {

    private $oBanco;

    public function __construct() {
        $this->oBanco = new MySQLBanco();
    }

    /**
     * TODO método intermediário, será removido em breve
     * @param $sString
     * @return string
     */
    public function escapeString($sString) {

        $this->oBanco->conectar();
        return $this->oBanco->escapeStrings($sString);
    }

    public function buscarTodos($iCodigoUsuario, $sWhere) {

        $this->oBanco->conectar();
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);
        $sSqlBuscar = "select * from animal where usuario = {$iCodigoUsuario} and ({$sWhere})";
        $rsAnimais = $this->oBanco->query($sSqlBuscar);
        $iNumeroAnimais = $this->oBanco->numeroLinhas($rsAnimais);

        $aRegistros = array();
        for ($i = 0; $i < $iNumeroAnimais; $i++) {
            $aRegistros[] = $this->oBanco->getResgitro($rsAnimais, $i);
        }

        $aAnimais = array();
        foreach ($aRegistros as $oRegistro) {
            $aAnimais[] = $this->preencheAnimal($oRegistro);
        }
        return $aAnimais;
    }

    public function buscarPorCodigo($iCodigo, $iCodigoUsuario) {


        $this->oBanco->conectar();
        $iCodigo        = $this->oBanco->escapeStrings($iCodigo);
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);
        $sSqlBuscar = "select * from animal where id = {$iCodigo} and usuario = {$iCodigoUsuario} ";
        $rsAnimais = $this->oBanco->query($sSqlBuscar);
        $iNumeroAnimais = $this->oBanco->numeroLinhas($rsAnimais);

        if ($iNumeroAnimais == 0) {
            return false;
        }

        $oRegistro = $this->oBanco->getResgitro($rsAnimais, 0);
        return $this->preencheAnimal($oRegistro);
    }

    public function inserir(Animal $oAnimal, $iCodigoUsuario) {

        $this->oBanco->conectar();

        $sNome = $this->oBanco->escapeStrings($oAnimal->getNome());
        $sEpecie = $this->oBanco->escapeStrings($oAnimal->getEspecie());
        $sRaca = $this->oBanco->escapeStrings($oAnimal->getRaca());
        $sPelo = $this->oBanco->escapeStrings($oAnimal->getPelo());
        $sPelagem = $this->oBanco->escapeStrings($oAnimal->getPelagem());
        $sPorte = $this->oBanco->escapeStrings($oAnimal->getPorte());
        $nPeso = $this->oBanco->escapeStrings($oAnimal->getPeso());
        $sNascimento = $this->oBanco->escapeStrings($oAnimal->getNascimentoFormatado());
        $sCadastro = $this->oBanco->escapeStrings($oAnimal->getCadastroFormatado());

        $sObservacoes = "null";
        if (!empty($oAnimal->getObservacoes())) {
            $sObservacoes = "'" . $this->oBanco->escapeStrings($oAnimal->getObservacoes()) . "'";
        }
        $sSexo = $this->oBanco->escapeStrings($oAnimal->getSexo());
        $lCastrado = $oAnimal->isCastrado() ? 'true' : 'false';
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);

        $sSql = "insert into animal ";
        $sSql .= "(nome, especie, raca, pelo, pelagem, porte, peso, nascimento, cadastro, castrado, observacoes, sexo, usuario) ";
        $sSql .= " values ";
        $sSql .= " ('{$sNome}', '{$sEpecie}', '{$sRaca}', '{$sPelo}', '{$sPelagem}', '{$sPorte}', {$nPeso}, ";
        $sSql .= "  '{$sNascimento}', '{$sCadastro}', {$lCastrado}, {$sObservacoes}, '{$sSexo}', {$iCodigoUsuario});";

        return $this->oBanco->query($sSql);
    }

    /**
     * @param $oStd
     * @return Animal
     */
    private function preencheAnimal($oStd) {

        $oAnimal = new Animal();
        $oAnimal->setCodigo($oStd->id);
        $oAnimal->setNome($oStd->nome);
        $oAnimal->setEspecie($oStd->especie);
        $oAnimal->setRaca($oStd->raca);
        $oAnimal->setPelo($oStd->pelo);
        $oAnimal->setPelagem($oStd->pelagem);
        $oAnimal->setPorte($oStd->porte);
        $oAnimal->setPeso($oStd->peso);
        $oAnimal->setNascimento(new DateTime($oStd->nascimento));
        $oAnimal->setCadastro(new DateTime($oStd->cadastro));
        $oAnimal->setCastrado($oStd->castrado);
        $oAnimal->setObservacoes($oStd->observacoes);
        $oAnimal->setSexo($oStd->sexo);

        return $oAnimal;
    }

    public function atualizar(Animal $oAnimal, $iCodigoUsuario) {

        $this->oBanco->conectar();

        $iCodigo = $this->oBanco->escapeStrings($oAnimal->getCodigo());
        $sNome = $this->oBanco->escapeStrings($oAnimal->getNome());
        $sEpecie = $this->oBanco->escapeStrings($oAnimal->getEspecie());
        $sRaca = $this->oBanco->escapeStrings($oAnimal->getRaca());
        $sPelo = $this->oBanco->escapeStrings($oAnimal->getPelo());
        $sPelagem = $this->oBanco->escapeStrings($oAnimal->getPelagem());
        $sPorte = $this->oBanco->escapeStrings($oAnimal->getPorte());
        $nPeso = $this->oBanco->escapeStrings($oAnimal->getPeso());
        $sNascimento = $this->oBanco->escapeStrings($oAnimal->getNascimentoFormatado());
        $sCadastro = $this->oBanco->escapeStrings($oAnimal->getCadastroFormatado());

        $sObservacoes = "null";
        if (!empty($oAnimal->getObservacoes())) {
            $sObservacoes = "'" . $this->oBanco->escapeStrings($oAnimal->getObservacoes()) . "'";
        }
        $sSexo = $this->oBanco->escapeStrings($oAnimal->getSexo());
        $lCastrado = $oAnimal->isCastrado() ? 'true' : 'false';
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);

        $sSql = "update animal set ";
        $sSql .= " nome = '{$sNome}', especie = '{$sEpecie}', raca = '{$sRaca}', pelo = '{$sPelo}', ";
        $sSql .= " pelagem = '{$sPelagem}', porte = '{$sPorte}', peso = {$nPeso}, nascimento = '{$sNascimento}', ";
        $sSql .= " cadastro = '{$sCadastro}', castrado = {$lCastrado}, observacoes = {$sObservacoes}, ";
        $sSql .= " sexo = '{$sSexo}' where id = {$iCodigo} and usuario = {$iCodigoUsuario} ;";

        return $this->oBanco->query($sSql);
    }

    public function excluir(Animal $oAnimal, $iCodigoUsuario) {

        $iCodigo = $oAnimal->getCodigo();
        if (empty($iCodigo)) {
            throw new Exception("Código do Animal não informado.");
        }

        $this->oBanco->conectar();

        $iCodigo        = $this->oBanco->escapeStrings($iCodigo);
        $iCodigoUsuario = $this->oBanco->escapeStrings($iCodigoUsuario);

        $sSql = " delete from animal where id = {$iCodigo} and usuario = {$iCodigoUsuario} ;";
        return $this->oBanco->query($sSql);
    }
}