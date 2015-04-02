
    function updateRodape() {
        $.ajax({
            type: 'get',
            url: 'ajax.php',
            data: "acao=updateRodape",
            success: function(retorno){
              $("#rodape .container").html(retorno);
            }
        });
    }

    function updateConfigTerminal() {


        if($("input[name=nome_impressora]").val() == "") { aviso("Precisa colocar nome da impressora.","notice"); $("input[name=nome_impressora]").focus(); return false;  }
        if($("input[name=ip_server_master]").val() == "") { aviso("Precisa colocar IP do Servidor Master..","notice"); $("input[name=ip_server_master]").focus(); return false; }



        var data = "acao=updateConfigTerminal&"+$("form").serialize();

        console.log(data);

        $.ajax({
            type: 'get',
            data: data,
            url: 'ajax.php',
            beforeSend: function(){
                $("form button[type=submit]").attr("disabled",true);
                $("form button[type=submit]").html("Atualizando Configurações...");

            },
            success: function(retorno){
                $("form button[type=submit]").attr("disabled",false);
                $("form button[type=submit]").html("Atualizar Terminal");
                if(retorno == "1") {
                    aviso("Configurações Atualizadas!","success");
                } else {
                    aviso(retorno,"error");
                }
                updateRodape();
            }
        });




        return false;

    }


    function aviso(msg,tipo) {
        $().toastmessage('showToast', {
            text     : msg,
            sticky   : false,
            type     : tipo,
            position: 'top-right',
            inEffectDuration: 1000
        });
    }

