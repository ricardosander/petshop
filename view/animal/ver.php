<div style="text-align: left; padding-bottom: 10px;" xmlns="http://www.w3.org/1999/html">
    <a class="btn btn-default" href="/animal/lista">Voltar</a>
    <a class="btn btn-primary" href="/animal/editar/<?= $oAnimal->getCodigo() ?>">Editar</a>
    <a class="btn btn-danger" href="/animal/excluir/<?= $oAnimal->getCodigo() ?>">Excluir</a>
</div>
<div class="col-lg-5">
    <table class="table">
        <thead>
        <tr>
            <th colspan="2">Informações do Animal</th>
        </tr>
        </thead>
        <tr>
            <td>Código:</td>
            <td><?= $oAnimal->getCodigo() ?></td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><?= $oAnimal->getNome() ?></td>
        </tr>
        <tr>
            <td>Espécie:</td>
            <td><?= $oAnimal->getEspecie() ?></td>
        </tr>
        <tr>
            <td>Raça:</td>
            <td><?= $oAnimal->getRaca() ?></td>
        </tr>
        <tr>
            <td>Pelo:</td>
            <td><?= $oAnimal->getPelo() ?></td>
        </tr>
        <tr>
            <td>Pelagem:</td>
            <td><?= $oAnimal->getPelagem() ?></td>
        </tr>
        <tr>
            <td>Porte:</td>
            <td><?= $oAnimal->getPorte() ?></td>
        </tr>
        <tr>
            <td>Peso:</td>
            <td><?= Utils::floatToString($oAnimal->getPeso()) ?></td>
        </tr>
        <tr>
            <td>Nascimento:</td>
            <td><?= $oAnimal->getNascimentoFormatado("d/m/Y") ?></td>
        </tr>
        <tr>
            <td>Cadastro:</td>
            <td><?= $oAnimal->getCadastroFormatado("d/m/Y") ?></td>
        </tr>
        <tr>
            <td>Observações:</td>
            <td><?= $oAnimal->getObservacoes() ?></td>
        </tr>
        <tr>
            <td>Castrado:</td>
            <td><?= $oAnimal->isCastrado() ? "Sim" : "Não" ?></td>
        </tr>
        <tr>
            <td>Cliente com pacote:</td>
            <td><?= $oAnimal->isClientePacote() ? "Sim" : "Não" ?></td>
        </tr>
        <tr>
            <td>Sexo:</td>
            <td><?= $oAnimal->getSexo() ?></td>
        </tr>
    </table>
</div>
<div class="col-lg-5">
    <table class="table">
        <thead>
        <tr>
            <th>Informações do Cliente</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($oAnimal->getCliente())) { ?>
            <tr>
                <td>
                    <span class="text-danger">Sem cliente cadastrado</span><br>
                    <a href="/cliente/cadastro?animal=<?= $oAnimal->getCodigo() ?>" class="btn btn-primary">Cadastrar Novo</a><br>
                    <a href="/cliente/selecionar/animal/<?= $oAnimal->getCodigo() ?>" class="btn btn-default">Selecionar </a>
                </td>
            </tr>
        <?php } ?>
        <?php if (!empty($oAnimal->getCliente())) { ?>
            <tr>
                <td>Nome:</td>
                <td><?= $oAnimal->getCliente()->getNome() ?></td>
            </tr>
            <tr>
                <td>Endereço:</td>
                <td><?= $oAnimal->getCliente()->getEndereco() ?></td>
            </tr>
            <tr>
                <td>Telefone Principal:</td>
                <td><?= $oAnimal->getCliente()->getTelefone() ?></td>
            </tr>
            <tr>
                <td>Saldo Devedor:</td>
                <td><?= Utils::floatToString($oAnimal->getCliente()->getSaldoDevedor()) ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn btn-primary" href="/cliente/ver/<?= $oAnimal->getCliente()->getCodigo() ?>">Ver Cliente</a>
                    <a href="/cliente/selecionar/animal/<?= $oAnimal->getCodigo() ?>" class="btn btn-default">Alterar Cliente </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>