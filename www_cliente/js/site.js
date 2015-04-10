var STATS_SERVER = false;
var intervalTime = null;

function initServer() {

    if ($("input[name=nome_impressora]").val() == "") {
        aviso("Precisa colocar nome da impressora.", "notice");
        $("input[name=nome_impressora]").focus();
        return false;
    }
    if ($("input[name=ip_server_master]").val() == "") {
        aviso("Precisa colocar IP do Servidor Master..", "notice");
        $("input[name=ip_server_master]").focus();
        return false;
    }


    $("button#initServer").attr("disabled", true);

    /* Checando se está webservice connected ;D */
    checkWebService(function (result) {
        if (result == "0") {

            aviso("O sistema não conseguiu connectar no webservice...", "error");
            $("input[name=ip_server_master]").focus();

        } else {


            $("input[name=nome_impressora]").attr("disabled", true);
            $("input[name=ip_server_master]").attr("disabled", true);
            $("button[type=submit]").attr("disabled", true);

            if (STATS_SERVER == false) {

                aviso("Server Cliente Ligado.", "notice");

                STATS_SERVER = true;
                setClienteServerStatus(1);

                $("#initServer").html("<b>Desligar Server Cliente</b>");
                $("#initServer").attr("style", 'color:red;');


                impressoraUpdateStatus();

                /* Loop */
                intervalTime = setInterval(function () {

                    impressoraUpdateStatus();

                }, 5000);

            } else {


                $("input[name=nome_impressora]").attr("disabled", false);
                $("input[name=ip_server_master]").attr("disabled", false);
                $("button[type=submit]").attr("disabled", false);

                STATS_SERVER = false;
                setClienteServerStatus(0);
                aviso("Server Cliente Desligado.", "notice");


                $("#initServer").html("Iniciar Server Cliente");
                $("#initServer").attr("style", 'color:black;');

                clearInterval(intervalTime);

            }


        }

        $("button#initServer").attr("disabled", false);

    });

}


function checkWebService(callback) {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=checkWebService",
        success: function (re) {
            callback(re);
            console.log("Call Ajax: checkWebService >> retorno: " + re);
        }
    });
}


function setClienteServerStatus(modo) {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=setClienteServerStatus&valor=" + modo,
        success: function (retorno) {
            console.log("Call Ajax: setClienteServerStatus, valor = " + modo + " >> retorno: " + retorno);
        }
    });
}

function impressoraUpdateStatus() {
    $("#loading_initServer").show().delay(2500).queue(function (n) {
        $(this).hide();
        n();
    });
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        async: false,
        data: "acao=impressoraUpdateStatus_and_JsonRequisicoes",
        success: function (retorno) {
            console.log("Call Ajax: impressoraUpdateStatus_and_JsonRequisicoes >> retorno: " + retorno);
        }
    });
}

function updateRodape() {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=updateRodape",
        success: function (retorno) {
            $("#rodape .container").html(retorno);
        }
    });
}

function updateConfigTerminal() {


    if ($("input[name=nome_impressora]").val() == "") {
        aviso("Precisa colocar nome da impressora.", "notice");
        $("input[name=nome_impressora]").focus();
        return false;
    }
    if ($("input[name=ip_server_master]").val() == "") {
        aviso("Precisa colocar IP do Servidor Master..", "notice");
        $("input[name=ip_server_master]").focus();
        return false;
    }


    var data = "acao=updateConfigTerminal&" + $("form").serialize();

    console.log(data);

    $.ajax({
        type: 'get',
        data: data,
        url: 'ajax.php',
        beforeSend: function () {
            $("form button[type=submit]").attr("disabled", true);
            $("form button[type=submit]").html("Atualizando Configurações...");

        },
        success: function (retorno) {
            $("form button[type=submit]").attr("disabled", false);
            $("form button[type=submit]").html("Atualizar Terminal");
            if (retorno == "1") {
                aviso("Configurações Atualizadas!", "success");
            } else {
                aviso(retorno, "error");
            }
            updateRodape();
        }
    });


    return false;

}


function aviso(msg, tipo) {
    $().toastmessage('showToast', {
        text: msg,
        sticky: false,
        type: tipo,
        position: 'top-right',
        inEffectDuration: 1000
    });
}

