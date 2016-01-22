<form action="/cliente/excluir" method="post">
  <input type="hidden" name="codigo" value="<?= $oCliente->getCodigo() ?>">

  <p class="alert">Tem certeza que quer excluir este cliente?<br>
    <?= $oCliente->getCodigo() . " - " . $oCliente->getNome() ?>
  </p>

  <input type="checkbox" name="excluirAnimais"/> Também Excluir Animais do Cliente<br>
  <a href="/cliente/lista" class="btn btn-default">Cancelar</a>
  <button class="btn btn-danger">Sim</button>
</form>