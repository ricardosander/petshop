<?php

namespace PetShop\Model;

use PetShop\Model\Cliente;
use PetShop\Entidade\Telefone as Entidade;
use PetShop\Utils;

class Telefone
{

    /**
     * @var int
     */
    private $codigo;

    /**
     * @var int
     */
    private $codigoCliente;

    /**
     * @var string
     */
    private $ddd;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var Cliente
     */
    private $cliente;

    /**
     * @param integer $codigo
     * @throws \Exception
     */
    public function __construct($codigo = null) {

        if (!empty($codigo)) {

            $dao = new Entidade();
            $retorno   = $dao->buscarPorCodigo($codigo, "", $this);

            if ($retorno === false) {
                throw new \Exception("Telefone não encontrado.");
            }
        }
    }

    /**
     * @return int
     */
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * @param int $codigo
     */
    public function setCodigo(int $codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return int
     */
    public function getCodigoCliente(): int
    {
        return $this->codigoCliente;
    }

    /**
     * @param int $codigoCliente
     */
    public function setCodigoCliente(int $codigoCliente)
    {
        $this->codigoCliente = $codigoCliente;
    }

    /**
     * @return string
     */
    public function getDdd(): string
    {
        return $this->ddd;
    }

    /**
     * @param string $ddd
     */
    public function setDdd(string $ddd)
    {
        $this->ddd = $ddd;
    }

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return \PetShop\Model\Cliente
     */
    public function getCliente(): \PetShop\Model\Cliente
    {

        if (empty($this->cliente) && !empty($this->codigoCliente)) {
            $this->cliente = new Cliente($this->codigoCliente);
        }
        return $this->cliente;    }

    /**
     * @param \PetShop\Model\Cliente $cliente
     */
    public function setCliente(\PetShop\Model\Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function getTelefoneFormatado() {
        return Utils::getTelefoneFormatado($this->ddd . $this->numero);
    }

    public function getNumeroFormatado()
    {
        return Utils::getTelefoneFormatado($this->numero);
    }
}