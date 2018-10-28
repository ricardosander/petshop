<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 08/01/17
 * Time: 21:17
 */

namespace PetShop\Entidade;


class Telefone extends Entidade
{
    protected $sClasse = "\\PetShop\\Model\\Telefone";
    protected $sTabela = "telefone";

    protected $aConfiguracoes = array(
        'id'              => array(
            'coluna'            => 'id',
            'atributo'          => 'codigo',
            'tipo'              => TipoDado::INTEIRO,
            'nulo'              => false,
            'chave_primaria'    => true,
            'chave_estrangeira' => false
        ),
        'nome'            => array(
            'coluna'            => 'nome',
            'atributo'          => 'nome',
            'tipo'              => TipoDado::STRING,
            'nulo'              => true,
            'chave_primaria'    => false,
            'chave_estrangeira' => false
        ),
        'ddd' => array(
            'coluna'            => 'ddd',
            'atributo'          => 'ddd',
            'tipo'              => TipoDado::STRING,
            'nulo'              => false,
            'chave_primaria'    => false,
            'chave_estrangeira' => false
        ),
        'numero'        => array(
            'coluna'            => 'numero',
            'atributo'          => 'numero',
            'tipo'              => TipoDado::STRING,
            'nulo'              => false,
            'chave_primaria'    => false,
            'chave_estrangeira' => false
        ),
        'cliente'         => array(
            'coluna'            => 'cliente',
            'atributo'          => 'codigoCliente',
            'tipo'              => TipoDado::INTEIRO,
            'nulo'              => false,
            'chave_primaria'    => false,
            'chave_estrangeira' => true
        )
    );

}