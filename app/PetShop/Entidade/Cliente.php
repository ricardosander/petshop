<?php

namespace PetShop\Entidade;

use PetShop\Entidade\TipoDado;

class Cliente extends Entidade {

    protected $sClasse = "\\PetShop\\Model\\Cliente";
    protected $sTabela = "cliente";

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
                              'nulo'              => false,
                              'chave_primaria'    => false,
                              'chave_estrangeira' => false
                             ),
        'nome_secundario' => array(
                              'coluna'            => 'nome_secundario',
                              'atributo'          => 'nomeSecundario',
                              'tipo'              => TipoDado::STRING,
                              'nulo'              => true,
                              'chave_primaria'    => false,
                              'chave_estrangeira' => false
                             ),
        'endereco'        => array(
                              'coluna'            => 'endereco',
                              'atributo'          => 'endereco',
                              'tipo'              => TipoDado::STRING,
                              'nulo'              => true,
                              'chave_primaria'    => false,
                              'chave_estrangeira' => false
                             ),
        'bairro'          => array(
                              'coluna'            => 'bairro',
                              'atributo'          => 'bairro',
                              'tipo'              => TipoDado::STRING,
                              'nulo'              => false,
                              'chave_primaria'    => false,
                              'chave_estrangeira' => false
                             ),
        'observacao'      => array(
                                'coluna'            => 'observacao',
                                'atributo'          => 'observacao',
                                'tipo'              => TipoDado::STRING,
                                'nulo'              => true,
                                'chave_primaria'    => false,
                                'chave_estrangeira' => false
                             ),
        'saldo_devedor'   => array(
                                'coluna'            => 'saldo_devedor',
                                'atributo'          => 'saldoDevedor',
                                'tipo'              => TipoDado::DOUBLE,
                                'nulo'              => false,
                                'chave_primaria'    => false,
                                'chave_estrangeira' => false
                             ),
        'usuario'         => array(
                                'coluna'            => 'usuario',
                                'atributo'          => 'usuario',
                                'tipo'              => TipoDado::INTEIRO,
                                'nulo'              => false,
                                'chave_primaria'    => false,
                                'chave_estrangeira' => false
                             )
    );
}