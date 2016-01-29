<div class="col-sm-12">
    <?php if(count($aClientes) > 0)  { ?>
        <h1>Lista de Cliente</h1>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>Nome</td>
                <td>Telefone Principal</td>
                <td>Saldo Devedor</td>
                <td>Ações</td>
            </tr>
            <?php
            foreach ($aClientes as $oCliente) {
                ?>
                <tr>
                    <td>
                        <?= $oCliente->getNome() ?>
                    </td>
                    <td>
                        <?= $oCliente->getTelefone() ?>
                    </td>
                    <td>
                        <?= $oCliente->isDevedor() ? $oCliente->getSaldoDevedor() : "Não" ?>
                    </td>
                    <td>
                        <?php if ($selecao) { ?>
                            <a class="btn btn-default" href="/cliente/seleciona/<?= $oCliente->getCodigo() ?>/<?= $vinculo ?>/<?= $codigoVinculo ?>">Selecionar</a>
                        <?php } else {?>
                        <a class="btn btn-success" href="/cliente/ver/<?= $oCliente->getCodigo() ?>">Ver</a>
                        <a class="btn btn-primary" href="/cliente/editar/<?= $oCliente->getCodigo() ?>">Editar</a>
                        <a class="btn btn-danger" href="/cliente/excluir/<?= $oCliente->getCodigo() ?>">Excluir</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?= isset($oPaginacao) ? $oPaginacao->getPaginacao() : "" ?>
    <?php } else { ?>
        <p class="text-info">Nenhum cliente encontrado!</p>
    <?php } ?>
    <a class="btn btn-primary" href="/cliente/lista">Voltar a lista completa</a>
</div>