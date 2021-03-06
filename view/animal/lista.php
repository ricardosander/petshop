<div class="col-lg-4">
    <form method="get" action="/animal/lista">
        <fieldset>
            <legend>Buscar Animais</legend>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nomeBusca">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" name="nomeBusca" id="nomeBusca" class="form-control form-group" value="<?= isset($sBuscaNome) ? $sBuscaNome : "" ?>">
                </div>
            </div>
            <input type="hidden" name="busca" value="1" />
            <button type="submit" class="btn btn-primary">Buscar</button>
        </fieldset>
    </form>
</div>


<div class="col-sm-12">
    <?php if(count($aAnimais) > 0)  { ?>
        <h1>Lista de Animais</h1>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>Animal</td>
                <td>Proprietário</td>
                <td>Espécie</td>
                <td>Raça</td>
                <td>Ações</td>
            </tr>
            <?php
            foreach ($aAnimais as $oAnimal) {
                ?>
                <tr>
                    <td>
                        <?= $oAnimal->getNome() ?>
                    </td>
                    <td>
                        <?= empty($oAnimal->getCliente()) ? "" : $oAnimal->getCliente()->getNome() ?>
                    </td>
                    <td>
                        <?= $oAnimal->getEspecie() ?>
                    </td>
                    <td>
                        <?= $oAnimal->getRaca() ?>
                    </td>
                    <td>
                        <?php if ($selecao) { ?>
                            <a class="btn btn-default" href="/animal/seleciona/<?= $oAnimal->getCodigo() ?>/<?= $vinculo ?>/<?= $codigoVinculo ?>">Selecionar</a>
                        <?php } else { ?>
                            <a class="btn btn-success" href="/animal/ver/<?= $oAnimal->getCodigo() ?>">Ver</a>
                            <a class="btn btn-primary" href="/animal/editar/<?= $oAnimal->getCodigo() ?>">Editar</a>
                            <a class="btn btn-danger" href="/animal/excluir/<?= $oAnimal->getCodigo() ?>">Excluir</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?= isset($oPaginacao) ? $oPaginacao->getPaginacao() : "" ?>
    <?php } else { ?>
        <p class="text-info">Nenhum animal encontrado!</p>
    <?php } ?>
    <a class="btn btn-primary" href="/animal/lista">Voltar a lista completa</a>
</div>