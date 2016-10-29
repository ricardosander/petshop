<?php

namespace PetShop\Validador;

use PetShop\Validador\Validador;
use PetShop\Model\Animal as Model;
use \DateTime;
use \Exception;

class Animal implements Validador {

    /**
     * @var Model
     */
    private $oAnimal;
    private $sDataNascimento;
    private $sDataCadastro;

    public function validar() {

        $aMensagemErro = array();
        if (empty($this->oAnimal->getNome())) {
            $aMensagemErro[] = "O campo Nome do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getEspecie())) {
            $aMensagemErro[] = "O campo Espécie do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getRaca())) {
            $aMensagemErro[] = "O campo Raça do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getPelo())) {
            $aMensagemErro[] = "O campo Pelo do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getPelagem())) {
            $aMensagemErro[] = "O campo Pèlagem do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getPorte())) {
            $aMensagemErro[] = "O campo Porte do animal é de preenchimento obrigatório.";
        }

        if (!is_numeric($this->oAnimal->getPeso())) {
            $aMensagemErro[] = "O campo Peso deve ser preenchido com valor numérico.";
        }

        if ($this->oAnimal->getPeso() <= 0) {
            $aMensagemErro[] = "O campo Peso do animal é de preenchimento obrigatório e deve ser maior que zero.";
        }

        if (empty($this->sDataNascimento)) {
            $aMensagemErro[] = "O campo Nascimento do animal é de preenchimento obrigatório.";
        }

        $aDataNascimento = explode("-", $this->sDataNascimento);
        if (count($aDataNascimento) != 3 || !checkdate($aDataNascimento[1], $aDataNascimento[2], $aDataNascimento[0])) {
            $aMensagemErro[] = "O campo Nascimento deve ser uma data válida.";
        } else {
            $this->oAnimal->setNascimento(new DateTime($this->sDataNascimento));
        }

        if (empty($this->sDataCadastro)) {
            $aMensagemErro[] = "O campo Cadastro do animal é de preenchimento obrigatório.";
        }

        $aDataCadastro  = explode("-", $this->sDataCadastro);
        if (count($aDataCadastro) != 3 || !checkdate($aDataCadastro[1], $aDataCadastro[2], $aDataCadastro[0])) {
            $aMensagemErro[] = "O campo Cadastro deve ser uma data válida.";
        } else {
            $this->oAnimal->setCadastro(new DateTime($this->sDataCadastro));
        }

        if (empty($this->oAnimal->getSexo())) {
            $aMensagemErro[] = "O campo Sexo do animal é de preenchimento obrigatório.";
        }

        if (!empty($aMensagemErro)) {
            throw new Exception(implode("<br>", $aMensagemErro));
        }
    }

    /**
     * @param $aDados
     */
    public function setDados($aDados) {

        $this->oAnimal         = isset($aDados['animal'])          ? $aDados['animal']          : "";
        $this->sDataCadastro   = isset($aDados['data_cadastro'])   ? $aDados['data_cadastro']   : "";
        $this->sDataNascimento = isset($aDados['data_nascimento']) ? $aDados['data_nascimento'] : "";
    }
}