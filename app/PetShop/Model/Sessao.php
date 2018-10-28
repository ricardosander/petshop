<?php

namespace PetShop\Model;

class Sessao {

    private $iId;

    private $iIdUsuario;

    private $sToken;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->iId;
    }

    /**
     * @param mixed $iId
     */
    public function setId($iId)
    {
        $this->iId = $iId;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->iIdUsuario;
    }

    /**
     * @param mixed $iIdUsuario
     */
    public function setIdUsuario($iIdUsuario)
    {
        $this->iIdUsuario = $iIdUsuario;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->sToken;
    }

    /**
     * @param mixed $sToken
     */
    public function setToken($sToken)
    {
        $this->sToken = $sToken;
    }

}