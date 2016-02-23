function AjaxRequest (sURL, oParametros, fnCallback) {

    this.sURL        = sURL;
    this.oParametros = oParametros;
    this.fnCallback  = fnCallback;
    this.type        = "get";
}

AjaxRequest.prototype.setType = function(sType) {

    this.type = sType;
    return this;
};

AjaxRequest.prototype.executar = function() {

    if (["get", "post"].indexOf(this.type) == -1) {

        console.log("Tipo de requisição inválida.");
        return false;
    }

    var self = this;

    $.ajax({
        url: this.sURL,
        data: self.oParametros,
        success: function(sRetorno) {

            var oRetorno = JSON.parse(sRetorno);
            self.fnCallback(oRetorno, true);
        },//TODO usar .fail (falha) .done (segundo sucesso), .always (sempre executa).
        type: self.type
    });
};