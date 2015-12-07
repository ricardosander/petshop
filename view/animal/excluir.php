<form action="/animal/excluir/" method="post">
    <input type="hidden" name="codigo" value="<?= $oAnimal->getCodigo() ?>">

    <p class="alert">Tem certeza que quer excluir este animal?<br>
    <?= $oAnimal->getCodigo() . " - " . $oAnimal->getNome() ?>
    </p>

    <a href="<?= $sUri == $sUltimaUri ? "/animal/lista" : $sUltimaUri ?>" class="btn btn-default">Cancelar</a>
    <button class="btn btn-danger">Sim</button>
</form>