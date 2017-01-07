jQuery(function ($) {

    $("#telefone").mask("99999-9999");
    $("#telefone2").mask("99999-9999");
    $("#telefone3").mask("99999-9999");
    $("#telefone4").mask("99999-9999");
    $("#telefone5").mask("99999-9999");

    $("#ddd1").mask("99");
    $("#ddd2").mask("99");
    $("#ddd3").mask("99");
    $("#ddd4").mask("99");
    $("#ddd5").mask("99");
});

function validarTelefone(sTelefone) {

    if (!sTelefone) {
        return true;
    }

    sTelefone = sTelefone.replace("-", "");

    if (sTelefone.length != 9) {
        return false;
    }

    return !isNaN(sTelefone);
}

function validarDDD(sDDD) {

    if (!sDDD) {
        return true;
    }

    if (sDDD.length != 2) {
        return false;
    }

    return !isNaN(sDDD);
}

function validarCadastroCliente() {

    var oNome      = document.getElementById("nome");
    var oBairro    = document.getElementById("bairro");
    var oTelefone  = document.getElementById("telefone");
    var oTelefone2 = document.getElementById("telefone2");
    var oTelefone3 = document.getElementById("telefone3");
    var oTelefone4 = document.getElementById("telefone4");
    var oTelefone5 = document.getElementById("telefone5");
    var oDDD1      = document.getElementById("ddd1");
    var oDDD2      = document.getElementById("ddd2");
    var oDDD3      = document.getElementById("ddd3");
    var oDDD4      = document.getElementById("ddd4");
    var oDDD5      = document.getElementById("ddd5");
    var oSaldoDevedor = document.getElementById("saldo_devedor");

    if (!oNome.value) {

        alert("O campo Nome é de preenchimento obrigatório.");
        oNome.focus();
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

    if (!oDDD1.value) {

        alert("O campo DDD do Telefone 1 é preenchimento obrigatório.");
        oDDD1.focus();
        return false;
    }

    if (!validarDDD(oDDD1.value)) {

        alert("O campo DDD do Telefone 1 deve ser válido, contendo 2 caractéres numéricos.");
        oDDD1.focus();
        return false;
    }

    if (oTelefone2.value && !validarTelefone(oTelefone2.value)) {

        alert("O campo Telefone 2 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone2.focus();
        return false;
    }

    if (oTelefone2.value) {

        if (!oDDD2.value) {

            alert("O campo DDD do Telefone 2 é preenchimento obrigatório.");
            oDDD2.focus();
            return false;
        }

        if (!validarDDD(oDDD2.value)) {

            alert("O campo DDD do Telefone 2 deve ser válido, contendo 2 caractéres numéricos.");
            oDDD2.focus();
            return false;
        }
    }

    if (oTelefone3.value && !validarTelefone(oTelefone3.value)) {

        alert("O campo Telefone 3 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone3.focus();
        return false;
    }

    if (oTelefone3.value) {

        if (!oDDD3.value) {

            alert("O campo DDD do Telefone 3 é preenchimento obrigatório.");
            oDDD3.focus();
            return false;
        }

        if (!validarDDD(oDDD3.value)) {

            alert("O campo DDD do Telefone 3 deve ser válido, contendo 2 caractéres numéricos.");
            oDDD3.focus();
            return false;
        }
    }

    if (oTelefone4.value && !validarTelefone(oTelefone4.value)) {

        alert("O campo Telefone 4 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone4.focus();
        return false;
    }

    if (oTelefone4.value) {

        if (!oDDD4.value) {

            alert("O campo DDD do Telefone 4 é preenchimento obrigatório.");
            oDDD4.focus();
            return false;
        }

        if (!validarDDD(oDDD4.value)) {

            alert("O campo DDD do Telefone 4 deve ser válido, contendo 2 caractéres numéricos.");
            oDDD4.focus();
            return false;
        }
    }

    if (oTelefone5.value && !validarTelefone(oTelefone5.value)) {

        alert("O campo Telefone 5 deve ser um número de telefone válido, contendo 8 caractéres numéricos.");
        oTelefone5.focus();
        return false;
    }

    if (oTelefone5.value) {

        if (!oDDD5.value) {

            alert("O campo DDD do Telefone 5 é preenchimento obrigatório.");
            oDDD5.focus();
            return false;
        }

        if (!validarDDD(oDDD5.value)) {

            alert("O campo DDD do Telefone 2 deve ser válido, contendo 2 caractéres numéricos.");
            oDDD5.focus();
            return false;
        }
    }

    var sSaldoDevedor = oSaldoDevedor.value.replace(".", "#").replace(",", ".");
    if (isNaN(sSaldoDevedor)) {

        alert("O campo Saldo Devedor deve ser um valor numérico válido.");
        oSaldoDevedor.focus();
        return false;
    }

    return true;
}