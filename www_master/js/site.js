function new_hashtagListen() {

    $('#modal1').modal();


}
function new_hashtagListen_salvar() {

    var hashtag = $("#modal1 input[name=hashtag]").val();
    var status = $("#modal1 select[name=status]").val();
    if(!hashtag) {   aviso("Digite nome da Hashtag!", "error"); }
    if(hashtag) {
        $.ajax({
            type: 'post',
            url: 'ajax.php',
            dataType: false,
            data: "acao=new_hashtagListen_salvar&hashtag=" + hashtag + "&status=" + status,
            beforeSend: function () {

            },
            success: function (html) {
                console.log("Call Ajax: new_hashtagListen_salvar >> retorno: " + html);
                aviso("Hashtag registrada com <br> sucesso", "success");
                hashtagListen_refresh();
                $('#modal1').modal("hide");
                $("#modal1 input[name=hashtag]").val("");
                $("#modal1 select[name=status]").val(1);
            }
        });
    }


}
function modal_layoutImpressao_salvar() {
    var data = $("textarea").val();
    var hashtagId = $("input[name=hashtagId_hidden]").val();
    if(hashtagId) {
        $.ajax({
            type: 'post',
            url: 'ajax.php',
            dataType: false,
            data: "acao=modal_layoutImpressao_salvar&hashtag_id=" + hashtagId + "&html=" + data,
            beforeSend: function () {
                $('#modal2').modal();
                $("input[name=hashtagId_hidden]").val(hashtagId);
            },
            success: function (html) {
                console.log("Call Ajax: modal_layoutImpressao_salvar >> retorno: " + hashtagId);
                aviso("Layout atualizado com <br> sucesso", "success");

            }
        });
    }
}

function modal_layoutImpressao(idHashtag) {

    if(idHashtag) {
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=modal_layoutImpressao&hashtag_id="+idHashtag,
        beforeSend: function() {
            $('#modal2').modal();
            $("input[name=hashtagId_hidden]").val(idHashtag);
        },
        success: function (html) {
            $("#modal2 form").show();
            $("#modal2 #preView").hide();

            console.log("Call Ajax: modal_layoutImpressao >> retorno: " + idHashtag);
            $("form textarea").val(html);
            $("#preView #html").html(html);

            layout_preVisualizar(true);

        }
    });
    }
}

function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function layout_preVisualizar(t) {


    if (t) {
        $("#modal2 form").hide();
        var conteudo =  $("form textarea").val();

        conteudo = replaceAll("{{json_images_standard_resolution}}", "images/demo.jpg", conteudo);
        conteudo = replaceAll("{{json_images_thumbnail}}", "images/demo.jpg", conteudo);
        conteudo = replaceAll("{{json_images_low_resolution}}", "images/demo.jpg", conteudo);
        conteudo = replaceAll("{{hashtag}}", "HashtagName", conteudo);
        conteudo = replaceAll("{{json_user_full_name}}", "Gabriel A. Barbosa", conteudo);
        conteudo = replaceAll("{{json_user_username}}", "gnomoverde", conteudo);
        conteudo = replaceAll("{{json_caption_text}}", "Text los amigos... on nice text :D..", conteudo);

        if(!conteudo) { conteudo = "<center> <h3>Clique em editar  <br>para começar... <br> <img src='images/cat.gif' width='80'> </h3> </center>"; }

        console.log(conteudo);

        $("#modal2 #preView #html").html(conteudo);
        $("#modal2 #preView").show();
    } else {
        $("#modal2 form").show();
        $("#modal2 #preView").hide();
    }
}


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

function impressoraRequisicoes_refresh(){

    $("#loadingImg").show();

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=impressoraRequisicoes_refresh",
        success: function (re) {
            console.log("Call Ajax: impressoraRequisicoes_refresh >> retorno: " + re);
            $(".table tbody").html(re);
            //aviso("Crontab foi reiniciado!", "notice");

            setTimeout(function() {

                $("#loadingImg").hide();

            }, 1000);

        }
    });

    setTimeout(function() {

        impressoraRequisicoes_refresh();

    }, 3000);

    return false;
}


function hashtagListen_refresh() {

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=refreshHashtagListen",
        success: function (re) {
            console.log("Call Ajax: hashtagListen_refresh >> retorno: " + re);
            $(".table tbody").html(re);
            //aviso("Crontab foi reiniciado!", "notice");
        }
    });

    return false;
}

function checkImage(obj) {
    var ss =    $(obj).children("input:checkbox").prop("checked");
    console.log(ss);
    if(ss == false) {
            $(obj).children("input:checkbox").prop('checked', true);
            $(obj).children("a.thumbnail").addClass("image_checked");
    } else {
            $(obj).children("input:checkbox").prop('checked',false);
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

function ligarHashtag_selecionadas() {

    var json = getAllCheckeds();
    if(json == "[]") { aviso("Nenhuma registro <br> selecionado!", "error"); return false; }

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=ligarHashtag_selecionadas&json="+json,
        success: function (re) {
            console.log("Call Ajax: ligarHashtag_selecionadas >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Registros ligados com <br> sucesso!", "success");
            hashtagListen_refresh();
        }
    });
    $("input[type=checkbox]").prop("checked",false);
    return false;
}
function desligarHashtag_selecionadas() {

    var json = getAllCheckeds();
    if(json == "[]") { aviso("Nenhuma registro <br> selecionado!", "error"); return false; }

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=desligarHashtag_selecionadas&json="+json,
        success: function (re) {
            console.log("Call Ajax: desligarHashtag_selecionadas >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Registros desligados com <br> sucesso!", "success");
            hashtagListen_refresh();
        }
    });
    $("input[type=checkbox]").prop("checked",false);

    return false;
}
function deletarHashtag_selecionadas() {

    var json = getAllCheckeds();
    if(json == "[]") { aviso("Nenhuma registro <br> selecionado!", "error"); return false; }

    var previa = JSON.parse(json);
    if(!confirm("Deseja realmente apagar "+previa.length+" registros ?")) { return false;}

    $.ajax({
        type: 'get',
        url: 'ajax.php',
        data: "acao=deletarHashtag_selecionadas&json="+json,
        success: function (re) {
            console.log("Call Ajax: deletarHashtag_selecionadas >> retorno: " + re);
            //$("#pre-crontab").html(re);
            aviso("Registros deletados com sucesso!", "success");
            hashtagListen_refresh();
        }
    });
    $("input[type=checkbox]").prop("checked",false);

    return false;
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

var type = true;

function scheckAllImages(obj, options) {

        var settings = $.extend({
           eventChecked: function() {
               console.log("eventChecked");
           },
           eventUnchecked: function() {
               console.log("eventUnchecked");
           }
       }, options );


    $('input[type=checkbox]').each(function () {$(this).attr('Checked',false);  $(this).removeAttr('Checked');  });

    if(window.type) {
        window.type = false;
        $('input[type=checkbox]').each(function () { $(this).attr('Checked', true); });
        settings.eventChecked();

    }
     else {
        window.type = true;
        $('input[type=checkbox]').each(function () { $(this).removeAttr('Checked'); $(this).attr('Checked', false); });
        settings.eventUnchecked();

    }

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
