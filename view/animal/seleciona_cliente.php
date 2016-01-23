<form action="/animal/seleciona" method="post">
    <input type="hidden" name="codigo_animal" value="<?= $oAnimal->getCodigo() ?>">
    <input type="hidden" name="codigo_cliente" value="<?= $oCliente->getCodigo() ?>">

    <p class="alert">Tem certeza que quer víncular o seguinte Animal ao seguinte Cliente?<br>
        Animal: <?= $oAnimal->getCodigo() . " - " . $oAnimal->getNome() ?><br>
        Cliente: <?= $oCliente->getCodigo() . " - " . $oCliente ->getNome() ?>
    </p>

    <a href="<?= $sUri == $sUltimaUri ? "/cliente/lista" : $sUltimaUri ?>" class="btn btn-default">Cancelar</a>
    <button class="btn btn-danger">Sim</button>
</form>