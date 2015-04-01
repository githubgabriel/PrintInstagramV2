
function redirecionarAjax(url) {
    ajaxLoadPage(null, "get", url, null);
}

function ajaxLoadPage(obj, method, page, data) {

    var div_ajax_conteudo = $("div#conteudo-box div#conteudo");
    var div_ajax_loading = $("div#conteudo-box div#ajax_loader");
    var class_active_menu = "active";
    var div_menu_id = $("div#menu-box ul li");

    if(!method) { console.log('ajaxLoadPage: Method não definido.'); return; }
    if(!page) { console.log('ajaxLoadPage: Página não definida.'); return; }

    $.ajax({
        url: page,
        data: data,
        type: method,
        async: false,
        processData: false,
        contentType: false,
        beforeSend: function() {
            /* Ajax loading show div */
            div_ajax_loading.show();

            /* Esconde div Conteudo */
            div_ajax_conteudo.hide();

            /* desativa menu */
            if(obj != null) { div_menu_id.removeClass(class_active_menu); }
        },
        success: function( data ) {
            /* Alimenta div aonde receberá conteudo */
            div_ajax_conteudo.html(data);
        },
        complete: function() {
            /* Esconde div de loading .. */
            div_ajax_loading.hide();

            /* Mostra div conteudo */
            div_ajax_conteudo.fadeIn(700);

            /* ativa menu */
            if(obj != null) { $(obj).addClass(class_active_menu); }
        },
        statusCode: {
            404: function() {
                console.log("ajaxLoadPage: Pagina: "+ page +" Erro 404.");
                $.get("ajax/404.php", function(data,status) {  div_ajax_conteudo.html(data);  });

            }
        }

    });
}