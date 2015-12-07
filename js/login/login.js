function validarLogin() {

  var sUsuario = document.getElementById("usuario");
  var sSenha   = document.getElementById("senha");

  if (!sUsuario.value) {
    alert("Campo Usuário é de preenchimento obrigatório.");
    return false;
  }

  if (!sSenha.value) {
    alert("Campo Senha é de preenchimento obrigatório.");
    return false;
  }
  return true;
}
