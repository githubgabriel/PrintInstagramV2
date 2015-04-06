function hashtag_getImasges() {

    var valor = $("select").chosen().val();

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=hashtag_getImages&hashtag_id="+valor,
        success: function (re) {
            console.log("Call Ajax: hashtag_getImages >> retorno: " + re);
            $("#imagem_box").html(re);
            //aviso("Crontab foi reiniciado!", "notice");
        }
    });


    return false;
}

function checkImage(obj) {
    var ss =    $(obj).children("input:checkbox").is(":checked");
    if(ss == false) {
            $(obj).children("input:checkbox").attr('Checked','Checked');
            $(obj).children("a.thumbnail").addClass("image_checked");
    } else {
            $(obj).children("input:checkbox").removeAttr('Checked');
            $(obj).children("a.thumbnail").removeClass("image_checked");
    }
    return false;
}

function bloquearImagens_selecionadas() {

    var json = getAllCheckeds();

    if(json == "[]") { aviso("Nenhuma imagem <br> selecionada!", "error"); return false; }

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=bloquearImagens&json="+json,
        success: function (re) {
            console.log("Call Ajax: bloquearImagens >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Imagens bloqueadas com sucesso!", "success");
            hashtag_getImasges();
        }
    });

}

function deletarImagens_selecionadas() {

    var json = getAllCheckeds();

    if(json == "[]") { aviso("Nenhuma imagem <br> selecionada!", "error"); return false; }

    var previa = JSON.parse(json);
    if(!confirm("Deseja realmente apagar "+previa.length+" registros ?")) { return false;}

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=deletarImagens&json="+json,
        success: function (re) {
            console.log("Call Ajax: deletarImagens >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Imagens deletadas com sucesso!", "success");
            hashtag_getImasges();
        }
    });

}


function desbloquearImagens_selecionadas() {

    var json = getAllCheckeds();

    if(json == "[]") { aviso("Nenhuma imagem <br> selecionada!", "error"); return false; }

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=desbloquearImagens&json="+json,
        success: function (re) {
            console.log("Call Ajax: desbloquearImagens >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Imagens desbloqueadas com sucesso!", "success");
            hashtag_getImasges();
        }
    });

}

function checkAllImages() {
    $('input[type=checkbox]').each(function () { $(this).attr('Checked','Checked'); });
    $("a.thumbnail").addClass("image_checked");
    return false;
}

function getAllCheckeds() {
    var myarray = [];
    $('input[type=checkbox]').each(function () {
        if($(this).is(":checked")) {
            var valor = $(this).val();
            myarray.push(valor);
        }
    });
    var inJson = JSON.stringify(myarray);
    return inJson;
}


function crontab_restart() {

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=crontabRestart",
        success: function (re) {
            console.log("Call Ajax: crontabRestart >> retorno: " + re);
            $("#pre-crontab").html(re);
            aviso("Crontab foi reiniciado!", "notice");
        }
    });

}
function crontab_stop() {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=crontabStop",
        success: function (re) {
            console.log("Call Ajax: crontabStop >> retorno: " + re);
            $("#pre-crontab").html(re);
            aviso("Crontab foi parado!", "notice");
        }
    });
}

function crontab_start() {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=crontabStart",
        success: function (re) {
            console.log("Call Ajax: crontabStart >> retorno: " + re);
            $("#pre-crontab").html(re);
            aviso("Crontab foi iniciado!", "notice");
        }
    });
}
var crontab_editting = false;
function crontab_edit(obj) {

    var crontab_acao = "crontabEdit";

    if(crontab_editting == false) {
        $(obj).html("Salvar");
        crontab_editting = true;
    } else {
        crontab_acao = "crontabSalvar";
        crontab_acao += "&valor="+encodeURIComponent($("pre textarea").val());
    }

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        dataType: "HTML",
        data: "acao="+crontab_acao,
        success: function (re) {
            console.log("Call Ajax: crontabEdit >> retorno: " + re);

            if(crontab_acao == "crontabEdit") {
                $("#pre-crontab").html("<textarea style='width:100%;min-height:200px;'> "+re+" </textarea>");
            } else {
                $("#pre-crontab").html(re);
                aviso("Crontab foi Atualizado!", "success");
                aviso("Crontab foi Reiniciado!", "notice");
                crontab_editting = false;
                $(obj).html("Editar");
            }

        }
    });



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
