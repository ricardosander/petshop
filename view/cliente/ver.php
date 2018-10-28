<?php use PetShop\Utils; ?>
<div style="text-align: left; padding-bottom: 10px;">
  <a class="btn btn-default" href="/cliente/lista">Voltar</a>
  <a class="btn btn-primary" href="/cliente/editar/<?= $oCliente->getCodigo() ?>">Editar</a>
  <a class="btn btn-danger" href="/cliente/excluir/<?= $oCliente->getCodigo() ?>">Excluir</a>
</div>
<div class="col-lg-4">
  <table class="table">
    <thead>
    <tr>
      <th colspan="2">Informações do Cliente</th>
    </tr>
    </thead>
    <tr>
      <td>Código:</td>
      <td><?= $oCliente->getCodigo() ?></td>
    </tr>
    <tr>
      <td>Nome:</td>
      <td><?= $oCliente->getNome() ?></td>
    </tr>
    <tr>
      <td>Nome Secundário:</td>
      <td><?= $oCliente->getNomeSecundario() ?></td>
    </tr>
    <tr>
      <td>Endereço:</td>
      <td><?= $oCliente->getEndereco() ?></td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><?= $oCliente->getBairro() ?></td>
    </tr>
    <?php
    $nome = "Telefone Principal:";
    $numero = 1;
    foreach ($oCliente->getTelefones() as $telefone) { ?>
      <tr>
        <td><?= $nome ?></td>
        <td><?= $telefone->getTelefoneFormatado() ?></td>
      </tr>
    <?php
      $numero++;
      $nome = "Telefone {$numero}:";
    }
    ?>
    <tr>
      <td>Observação:</td>
      <td><?= $oCliente->getObservacao() ?></td>
    </tr>
    <tr>
      <td>Saldo Devedor:</td>
      <td><?= $oCliente->isDevedor() ? $oCliente->getSaldoDevedor() : "Não" ?></td>
    </tr>
  </table>
</div>
<div class="col-lg-8">
  <table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
      <th colspan="5">Animais</th>
    </tr>
    <?php if (count($aAnimais) > 0) { ?>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Espécie</th>
        <th>Raça</th>
        <th>Ações</th>
      </tr>
    <?php } else { ?>
      <tr>
        <td>
          <span class="text-danger">Sem aniamis cadastrados</span>
        </td>
      </tr>
    <?php } ?>
    </thead>
    <tbody>
    <?php foreach ($aAnimais as $oAnimal) { ?>
      <tr>
        <td><?= $oAnimal->getCodigo() ?></td>
        <td><?= $oAnimal->getNome() ?></td>
        <td><?= $oAnimal->getEspecie() ?></td>
        <td><?= $oAnimal->getRaca() ?></td>
        <td>
          <a class="btn btn-success" href="/animal/ver/<?= $oAnimal->getCodigo() ?>">Ver</a>
          <a class="btn btn-primary" href="/animal/editar/<?= $oAnimal->getCodigo() ?>">Editar</a>
          <a class="btn btn-danger" href="/animal/excluir/<?= $oAnimal->getCodigo() ?>">Excluir</a>
        </td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="5">
        <a href="/animal/cadastro?cliente=<?= $oCliente->getCodigo() ?>" class="btn btn-primary">Cadastrar Novo</a>
        <a href="/animal/selecionar/cliente/<?= $oCliente->getCodigo() ?>" class="btn btn-default">Selecionar </a>
      </td>
    </tr>
    </tbody>
  </table>
</div>