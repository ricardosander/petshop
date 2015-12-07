function validarCadastroAnimal() {

  var oNome        = document.getElementById("nome");
  var oEspecie     = document.getElementById("especie");
  var oRaca        = document.getElementById("raca");
  var oPelo        = document.getElementById("pelo");
  var oPelagem     = document.getElementById("pelagem");
  var oPorte       = document.getElementById("porte");
  var oPeso        = document.getElementById("peso");
  var oNascimento  = document.getElementById("nascimento");
  var oCadastro    = document.getElementById("cadastro");
  var oObservacoes = document.getElementById("observacoes");
  var oSexoF       = document.getElementById("sexoF");
  var oSexoM       = document.getElementById("sexoM");

  if (!oNome.value) {

    alert("O campo Nome é de preenchimento obrigatório.");
    oNome.focus();
    return false;
  }

  if (!oEspecie.value) {

    alert("O campo Espécie é de preenchimento obrigatório.");
    oEspecie.focus();
    return false;
  }

  if (!oRaca.value) {

    alert("O campo Raça é de preenchimento obrigatório.");
    oRaca.focus();
    return false;
  }

  if (!oPelo.value) {

    oPelo.focus();
    alert("O campo Pelo é de preenchimento obrigatório.");
    return false;
  }

  if (!oPelagem.value) {

    alert("O campo Pelagem é de preenchimento obrigatório.");
    oPelagem.focus();
    return false;
  }

  if (!oPorte.value) {

    alert("O campo Porte é de preenchimento obrigatório.");
    oPorte.focus();
    return false;
  }

  if (!oPeso.value || oPeso.value <= 0) {

    alert("O campo Peso é de preenchimento obrigatório e deve ser maior que zero.");
    oPeso.focus();
    return false;
  }

  if (!oNascimento.value) {

    alert("O campo Nascimento é de preenchimento obrigatório.");
    oNascimento.focus();
    return false;
  }

  if (!oCadastro.value) {

    alert("O campo Cadastro é de preenchimento obrigatório.");
    oCadastro.focus();
    return false;
  }

  if (oSexoF.checked !== true && oSexoM.checked !== true) {

    alert("O campo Sexo deve ser selecionado.");
    oSexoM.focus();
    return false;
  }
  return true;
}