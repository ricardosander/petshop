<?php

class ClienteValidator implements Validador {

    /**
     * @var Cliente
     */
    private $oCliente;

    public function validar() {

        $aMensagemErro = array();

        if (empty($this->oCliente->getNome())) {
            $aMensagemErro[] = "Campo Nome é de preenchimento obrigatório.";
        }

        if (empty($this->oCliente->getEndereco())) {
            $aMensagemErro[] = "Campo Enredeço é de prenechimento obrigatório.";
        }

        if (empty($this->oCliente->getBairro())) {
            $aMensagemErro[] = "Campo Bairro é de preenchimento obrigatório.";
        }

        if (empty($this->oCliente->getTelefone())) {
            $aMensagemErro[] = "Campo Telefone é de preenchimento obrigatório.";
        }

        $aTelefonesValidar = array();

        if (!empty($this->oCliente->getTelefone())) {
            $aTelefonesValidar["Telefone"] = $this->oCliente->getTelefone();
        }

        if (!empty($this->oCliente->getTelefone2())) {
            $aTelefonesValidar["Telefone 2"] = $this->oCliente->getTelefone2();
        }

        if (!empty($this->oCliente->getTelefone3())) {
            $aTelefonesValidar["Telefone 3"] = $this->oCliente->getTelefone3();
        }

        if (!empty($this->oCliente->getTelefone4())) {
            $aTelefonesValidar["Telefone 4"] = $this->oCliente->getTelefone4();
        }

        if (!empty($this->oCliente->getTelefone5())) {
            $aTelefonesValidar["Telefone 5"] = $this->oCliente->getTelefone5();
        }

        foreach ($aTelefonesValidar as $sLabel => $sTelefone) {

            if (!is_numeric($sTelefone) || strlen($sTelefone) != 8) {
                $aMensagemErro[] = "O campo {$sLabel} deve ser um número de telefone válido, contendo 8 caractéres numéricos.";
            }
        }

        if (!is_numeric($this->oCliente->getSaldoDevedor())) {
            $aMensagemErro[] = "Campo Saldo Devedor deve ser um valor numérico válido.";
        }

        if (!empty($aMensagemErro)) {
            throw new Exception(implode("<br>", $aMensagemErro));
        }
    }

    public function setDados($aDados) {
        $this->oCliente = $aDados['cliente'];
    }
}