<h1>Lista de Animais</h1>
  <table class="table table-bordered table-striped table-hover">
    <?php
      foreach ($aAnimais as $oAnimal) {
    ?>
        <tr>
          <td>
            <?= $oAnimal->getCodigo() ?> - <?= $oAnimal->getNome() ?>
          </td>
        </tr>
    <?php
      }
    ?>
  </table>