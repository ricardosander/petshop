<fieldset class="form-group">
    <legend>Cadastro de Cliente</legend>
    <form method="post" action="/cliente/<?= isset($sAcao) ? $sAcao : "cadastro" ?>" onsubmit="return validarCadastroCliente();">

        <input type="hidden" name="codigo_animal" value="<?= isset($codigo_animal) ? $codigo_animal : "" ?>" />
        <?php if (isset($oCliente) && !empty($oCliente->getCodigo())) { ?>
            <input type="hidden" name="id" value="<?= $oCliente->getCodigo() ?>" />
        <?php } ?>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 form-control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" value="<?= isset($oCliente) ? $oCliente->getNome() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="nome_secundario" class="col-sm-2 form-control-label">Nome Secundário:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome_secundario" name="nome_secundario" placeholder="nome secundário" value="<?= isset($oCliente) ? $oCliente->getNomeSecundario() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="endereco" class="col-sm-2 form-control-label">Endereço:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="endereço" value="<?= isset($oCliente) ? $oCliente->getEndereco() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="bairro" class="col-sm-2 form-control-label">Bairro:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro" value="<?= isset($oCliente) ? $oCliente->getBairro() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefone" class="col-sm-2 form-control-label">Telefone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="telefone" value="<?= isset($oCliente) ? $oCliente->getTelefone() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefone2" class="col-sm-2 form-control-label">Telefone 2:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="telefone 2" value="<?= isset($oCliente) ? $oCliente->getTelefone2() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefone3" class="col-sm-2 form-control-label">Telefone 3:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telefone3" name="telefone3" placeholder="telefone 3" value="<?= isset($oCliente) ? $oCliente->getTelefone3() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefone4" class="col-sm-2 form-control-label">Telefone 4:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telefone4" name="telefone4" placeholder="telefone 4" value="<?= isset($oCliente) ? $oCliente->getTelefone4() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefone5" class="col-sm-2 form-control-label">Telefone 5:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telefone5" name="telefone5" placeholder="telefone 5" value="<?= isset($oCliente) ? $oCliente->getTelefone5() : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="observacao" class="col-sm-2 form-control-label">Observações:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="observacao" name="observacao"><?= isset($oCliente) ? $oCliente->getObservacao() : "" ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="saldo_devedor" class="col-sm-2 form-control-label">Saldo Devedor:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="saldo_devedor" name="saldo_devedor" placeholder="saldo devedor" value="<?= isset($oCliente) ? Utils::floatToString($oCliente->getSaldoDevedor()) : "" ?>">
            </div>
        </div>

        <a href="/cliente/lista" class="btn btn-default">Voltar</a>
        <button type="submit" class="btn btn-primary"> <?= isset($sAcaoBotao) ? $sAcaoBotao : "Cadastrar"?></button>
    </form>
</fieldset>