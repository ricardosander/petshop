<div style="text-align: left; padding-bottom: 10px;">
    <a class="btn btn-default" href="/animal/lista">Voltar</a>
    <a class="btn btn-primary" href="/animal/editar/<?= $oAnimal->getCodigo() ?>">Editar</a>
    <a class="btn btn-danger" href="/animal/excluir/<?= $oAnimal->getCodigo() ?>">Excluir</a>
</div>
<div class="col-lg-4">
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
            <td><?= $oAnimal->getPeso() ?></td>
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
            <td>Sexo:</td>
            <td><?= $oAnimal->getSexo() ?></td>
        </tr>
    </table>
</div>