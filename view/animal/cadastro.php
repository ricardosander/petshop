<fieldset>
  <legend>Cadastro de Animal</legend>
  <form method="post" action="/animal/<?= isset($sAcao) ? $sAcao : "cadastro" ?>" onsubmit="return validarCadastroAnimal();">

      <?php if (isset($oAnimal) && !empty($oAnimal->getCodigo())) { ?>
          <input type="hidden" name="id" value="<?= $oAnimal->getCodigo() ?>" />
      <?php } ?>

    <div class="form-group row">
      <label for="nome" class="col-sm-2 form-control-label">Nome:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" value="<?= isset($oAnimal) ? $oAnimal->getNome() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="especie" class="col-sm-2 form-control-label">Espécie:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="especie" name="especie" placeholder="espécie" value="<?= isset($oAnimal) ? $oAnimal->getEspecie() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="raca" class="col-sm-2 form-control-label">Raça:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="raca" name="raca" placeholder="raça" value="<?= isset($oAnimal) ? $oAnimal->getRaca() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="pelo" class="col-sm-2 form-control-label">Pelo:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="pelo" name="pelo" placeholder="pelo" value="<?= isset($oAnimal) ? $oAnimal->getPelo() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="pelagem" class="col-sm-2 form-control-label">Pelagem:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="pelagem" name="pelagem" placeholder="pelagem" value="<?= isset($oAnimal) ? $oAnimal->getPelagem() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="porte" class="col-sm-2 form-control-label">Porte:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="porte" name="porte" placeholder="porte" value="<?= isset($oAnimal) ? $oAnimal->getPorte() : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="peso" class="col-sm-2 form-control-label">Peso:</label>
      <div class="col-sm-10">
        <input type="text" step="any" class="form-control" id="peso" name="peso" placeholder="peso" value="<?= isset($oAnimal) ? Utils::floatToString($oAnimal->getPeso()) : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="nascimento" class="col-sm-2 form-control-label">Nascimento:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nascimento" name="nascimento" placeholder="nascimento" value="<?= isset($oAnimal) ? $oAnimal->getNascimentoFormatado("d/m/Y") : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="cadatro" class="col-sm-2 form-control-label">Cadastro:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cadastro" name="cadastro" placeholder="cadastro" value="<?= isset($oAnimal) ? $oAnimal->getCadastroFormatado("d/m/Y") : "" ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="observacoes" class="col-sm-2 form-control-label">Observações:</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="observacoes" name="observacoes"><?= isset($oAnimal) ? $oAnimal->getObservacoes() : "" ?></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2">Castrado</label>
      <div class="col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="castrado" <?= isset($oAnimal) && $oAnimal->isCastrado() ? "checked" : "" ?> > Castrado
          </label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2">Sexo</label>
      <div class="col-sm-10">
        <div class="radio">
          <label>
            <input type="radio" name="sexo" id="sexoM" value="m" <?= isset($oAnimal) && $oAnimal->getSexo() == "m" ? "checked" : "" ?> >Macho
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="sexo" id="sexoF" value="f" <?= isset($oAnimal) && $oAnimal->getSexo() == "f" ? "checked" : "" ?> >Fêmea
          </label>
        </div>
      </div>
    </div>

    <a href="<?= $sUltimaUri == $sUri ? "/animal/lista" : $sUltimaUri ?>" class="btn btn-default">Voltar</a>
    <button type="submit" class="btn btn-primary"> <?= isset($sAcaoBotao) ? $sAcaoBotao : "Cadastrar"?></button>
  </form>
</fieldset>