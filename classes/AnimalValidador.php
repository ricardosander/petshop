<?php

class AnimalValidador implements Validador {

    /**
     * @var Animal
     */
    private $oAnimal;

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

        if (!is_double($this->oAnimal->getPeso())) {
            $aMensagemErro[] = "O campo Peso deve ser preenchido com valor numérico.";
        }

        if ($this->oAnimal->getPeso() <= 0) {
            $aMensagemErro[] = "O campo Peso do animal é de preenchimento obrigatório e deve ser maior que zero.";
        }

        if (empty($this->oAnimal->getNascimento())) {
            $aMensagemErro[] = "O campo Nascimento do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getCadastro())) {
            $aMensagemErro[] = "O campo Cadastro do animal é de preenchimento obrigatório.";
        }

        if (empty($this->oAnimal->getSexo())) {
            $aMensagemErro[] = "O campo Sexo do animal é de preenchimento obrigatório.";
        }

        if (!empty($aMensagemErro)) {
            throw new Exception(implode("<br>", $aMensagemErro));
        }
    }

    /**
     * @param $oAnimao
     */
    public function setDados($oAnimao) {
        $this->oAnimal = $oAnimao;
    }
}