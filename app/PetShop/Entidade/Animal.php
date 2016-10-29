<?php

namespace PetShop\Entidade;

use PetShop\Entidade\TipoDado;

class Animal extends Entidade {

  protected $sClasse = "\\PetShop\\Model\\Animal";
  protected $sTabela = "animal";

  protected $aConfiguracoes = array(

    'id'             => array(
      'coluna'            => 'id',
      'atributo'          => 'codigo',
      'tipo'              => TipoDado::INTEIRO,
      'nulo'              => false,
      'chave_primaria'    => true,
      'chave_estrangeira' => false
    ),
    'nome'           => array(
      'coluna'            => 'nome',
      'atributo'          => 'nome',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'especie'        => array(
      'coluna'            => 'especie',
      'atributo'          => 'especie',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'raca'           => array(
      'coluna'            => 'raca',
      'atributo'          => 'raca',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'pelo'           => array(
      'coluna'            => 'pelo',
      'atributo'          => 'pelo',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'pelagem'        => array(
      'coluna'            => 'pelagem',
      'atributo'          => 'pelagem',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'porte'          => array(
      'coluna'            => 'porte',
      'atributo'          => 'porte',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'peso'           => array(
      'coluna'            => 'peso',
      'atributo'          => 'peso',
      'tipo'              => TipoDado::DOUBLE,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'nascimento'     => array(
      'coluna'            => 'nascimento',
      'atributo'          => 'nascimento',
      'tipo'              => TipoDado::DATA,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'cadastro'       => array(
      'coluna'            => 'cadastro',
      'atributo'          => 'cadastro',
      'tipo'              => TipoDado::DATA,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'castrado'       => array(
      'coluna'            => 'castrado',
      'atributo'          => 'castrado',
      'tipo'              => TipoDado::BOOLEAN,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'observacoes'    => array(
      'coluna'            => 'observacoes',
      'atributo'          => 'observacoes',
      'tipo'              => TipoDado::STRING,
      'nulo'              => true,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'sexo'           => array(
      'coluna'            => 'sexo',
      'atributo'          => 'sexo',
      'tipo'              => TipoDado::STRING,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'usuario'        => array(
      'coluna'            => 'usuario',
      'atributo'          => 'usuario',
      'tipo'              => TipoDado::INTEIRO,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'cliente_pacote' => array(
      'coluna'            => 'cliente_pacote',
      'atributo'          => 'clientePacote',
      'tipo'              => TipoDado::BOOLEAN,
      'nulo'              => false,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    ),
    'cliente'        => array(
      'coluna'            => 'cliente',
      'atributo'          => 'codigoCliente',
      'tipo'              => TipoDado::INTEIRO,
      'nulo'              => true,
      'chave_primaria'    => false,
      'chave_estrangeira' => false
    )
  );

}