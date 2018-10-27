<div class="col-lg-4">
    <form method="get" action="/animal/lista">
        <fieldset>
            <legend>Buscar Animais</legend>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nomeBusca">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" name="nomeBusca" id="nomeBusca" class="form-control form-group"
                           value="<?= isset($sBuscaNome) ? $sBuscaNome : "" ?>">
                </div>
            </div>
            <input type="hidden" name="busca" value="1"/>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </fieldset>
    </form>
</div>


<div class="col-sm-12" ng-app="myApp" ng-controller="pets">
    <div ng-show="show_pets">
        <h1>Lista de Animais</h1>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>Animal</td>
                <td>Proprietário</td>
                <td>Espécie</td>
                <td>Raça</td>
                <td>Ações</td>
            </tr>
            <tr ng-repeat="pet in pets">
                <td>{{pet.name}}</td>
                <td>{{pet.owner}}</td>
                <td>{{pet.species}}</td>
                <td>{{pet.breed}}</td>
                <td>
                    <?php if ($selecao) { ?>
                        <a class="btn btn-default"
                           href="/animal/seleciona/{{pet.id}}/<?= $vinculo ?>/<?= $codigoVinculo ?>">Selecionar</a>
                    <?php } else { ?>
                        <a class="btn btn-success" href="/animal/ver/{{pet.id}}">Ver</a>
                        <a class="btn btn-primary" href="/animal/editar/{{pet.id}}">Editar</a>
                        <a class="btn btn-danger" href="/animal/excluir/{{pet.id}}">Excluir</a>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?= isset($oPaginacao) ? $oPaginacao->getPaginacao() : "" ?>
    </div>
    <div ng-show="show_no_pets">
        <p class="text-info">Nenhum animal encontrado!</p>
    </div>
    <a class="btn btn-primary" href="/animal/lista">Voltar a lista completa</a>
</div>