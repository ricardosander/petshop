<fieldset>
  <legend>Login</legend>
  <form action="/login/login" method="post" onsubmit="return validarLogin();">

    <div class="form-group row">
      <label for="usuario" class="col-sm-2 form-control-label">Usuário:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuário">
      </div>
    </div>

    <div class="form-group row">
      <label for="senha" class="col-sm-2 form-control-label">Senha:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="senha" name="senha" placeholder="senha">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</fieldset>