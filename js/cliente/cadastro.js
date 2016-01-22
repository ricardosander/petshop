jQuery(function ($) {

    $("#telefone").mask("9999-9999");
    $("#telefone2").mask("9999-9999");
    $("#telefone3").mask("9999-9999");
    $("#telefone4").mask("9999-9999");
    $("#telefone5").mask("9999-9999");
});

function validarTelefone(sTelefone) {

    if (!sTelefone) {
        return true;
    }

    sTelefone = sTelefone.replace("-", "");

    if (sTelefone.length != 8) {
        return false;
    }

    return !isNaN(sTelefone);
}

function validarCadastroCliente() {

    var oNome         = document.getElementById("nome");
    var oEndereco     = document.getElementById("endereco");
    var oBairro       = document.getElementById("bairro");
    var oTelefone     = document.getElementById("telefone");
    var oTelefone2    = document.getElementById("telefone2");
    var oTelefone3    = document.getElementById("telefone3");
    var oTelefone4    = document.getElementById("telefone4");
    var oTelefone5    = document.getElementById("telefone5");
    var oSaldoDevedor = document.getElementById("saldo_devedor");

    if (!oNome.value) {

        alert("O campo Nome é de preenchimento obrigatório.");
        oNome.focus();
        return false;
    }

    if (!oEndereco.value) {

        alert("O campo Endereço é de preenchimento obrigatório.");
        oEndereco.focus();
        return false;
    }

    if (!oBairro.value) {

        alert("O campo Bairro é de preenchimento obrigatório.");
        oBairro.focus();
        return false;
    }

    if (!oTelefone.value) {

        alert("O campo Telefone é de preenchimento obrigatório.");
        oTelefone.focus();
        return false;
    }

    if (!validarTelefone(oTelefone.value)) {

        alert("O campo Telefone deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone.focus();
        return false;
    }

    if (oTelefone2.value && !validarTelefone(oTelefone2.value)) {

        alert("O campo Telefone 2 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone2.focus();
        return false;
    }

    if (oTelefone3.value && !validarTelefone(oTelefone3.value)) {

        alert("O campo Telefone 3 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone3.focus();
        return false;
    }

    if (oTelefone4.value && !validarTelefone(oTelefone4.value)) {

        alert("O campo Telefone 4 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone4.focus();
        return false;
    }

    if (oTelefone5.value && !validarTelefone(oTelefone5.value)) {

        alert("O campo Telefone 5 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone5.focus();
        return false;
    }

    var sSaldoDevedor = oSaldoDevedor.value.replace(".", "#").replace(",", ".");
    if (isNaN(sSaldoDevedor)) {

        alert("O campo Saldo Devedor deve ser um valor numérico válido.");
        oSaldoDevedor.focus();
        return false;
    }

    return true;
}