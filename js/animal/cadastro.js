jQuery(function ($) {

    $("#cadastro").mask("99/99/9999");
    $("#nascimento").mask("99/99/9999");
});

function validaData(sValor) {

    var aData = sValor.split("/");

    if (!Array.isArray(aData) || aData.length != 3) {
        return false;
    }

    var sDia = aData[0],
        sMes = aData[1],
        sAno = aData[2];

    if (sDia.length != 2 || sMes.length != 2 || sAno.length != 4) {
        return false;
    }

    if (sDia < 1 || sDia > 31) {
        return false;
    }

    if (sMes < 1 || sMes > 12) {
        return false;
    }

    if (sAno < 1000 || sAno > 3000) {
        return false;
    }

    switch (sMes) {

        case "02":

            var lBisexto = ((sAno % 4 == 0 && sAno % 100 != 0 ) || sAno % 400 == 0);

            if (lBisexto && sDia > 29) {
                return false;
            }

            if (!lBisexto && sDia > 28) {
                return false;
            }
            break;

        case "04":
        case "06":
        case "09":
        case "11":

            if (sDia > 30) {
                return false;
            }
            break;
        default :
            if (sDia > 31) {
                return false;
            }
            break;
    }

    return true;
}

function validarCadastroAnimal() {

    var oNome       = document.getElementById("nome");
    var oEspecie    = document.getElementById("especie");
    var oRaca       = document.getElementById("raca");
    var oPelo       = document.getElementById("pelo");
    var oPelagem    = document.getElementById("pelagem");
    var oPorte      = document.getElementById("porte");
    var oPeso       = document.getElementById("peso");
    var oNascimento = document.getElementById("nascimento");
    var oCadastro   = document.getElementById("cadastro");
    var oSexoF      = document.getElementById("sexoF");
    var oSexoM      = document.getElementById("sexoM");

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

    var sPeso = oPeso.value.replace(".", "#").replace(",", ".");
    if (isNaN(sPeso)) {

        alert("O campo Peso deve ser um valor numérico válido.");
        oPeso.focus();
        return false;
    }

    var nPeso = new Number(sPeso);
    if (nPeso <= 0) {

        alert("O campo Peso deve ser maior que zero.");
        oPeso.focus();
        return false;
    }

    if (!oNascimento.value) {

        alert("O campo Nascimento é de preenchimento obrigatório.");
        oNascimento.focus();
        return false;
    }

    if (!validaData(oNascimento.value)) {

        alert("O campo Nascimento informado é inválido.");
        oNascimento.focus();
        return false;
    }

    if (!oCadastro.value) {

        alert("O campo Cadastro é de preenchimento obrigatório.");
        oCadastro.focus();
        return false;
    }

    if (!validaData(oCadastro.value)) {

        alert("O campo Cadastro  informado é inválido.");
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