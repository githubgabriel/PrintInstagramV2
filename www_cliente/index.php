<?php

    require "BASEV2/basev2.php";

    getBaseV2("php");

    getBaseV2("javascript");


    use base\instagramv2\instagramv2;


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Terminal Cliente - InstagramV2</title>

    <link rel="stylesheet" href="css/site.css" type="text/css" />

    <? getPluginJS("Jquery"); ?>

    <? getPluginJS("BootStrap"); ?>

    <? getPluginJS("ToastMessage"); ?>

    <? getPluginJS("Mask"); ?>

    <? include_JS("js/site.js"); ?>

    <script>

        $(function() {
       /*     $().toastmessage('showToast', {
                text     : 'Bem vindo ao sistema InstagramV2!',
                sticky   : false,
                type     : 'notice',
                position: 'top-center'
            });
       */


            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                }
            });

        });
    </script>




</head>

<body>

    <? $mi = "home"; require("require/menu.php");?>


    <div class="container">


        <h1>Terminal Impressora - Instagram <span class="label label-default">V2</span> </h1>
        <p>
          <small>  Created by Gabriel A. Barbosa </small>
        </p>



        <div class="col-md-6" style="margin-top:10px;">

            <form class="form-horizontal" id="form1" onsubmit="return updateConfigTerminal()">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-12">Nome impressora:</label>
                    <div class="col-sm-12">
                        <input type="text" name="nome_impressora" value="<?=$_SESSION["IMPRESSORA_NOME"]?>" class="form-control" placeholder="Impressora01">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-12">IP SERVER MASTER:</label>
                    <div class="col-sm-12">
                        <input type="text" name="ip_server_master" value="<?=$_SESSION["SERVER_MASTER"]?>" class="form-control ip_address" placeholder="127.0.0.1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default">Atualizar Terminal</button>
                    </div>
                </div>
            </form>


        </div>




        <div class="col-md-12" style="margin-top:30px;">
            <b>Impressora Padrão: </b>
            <?
            echo "<pre>".shell_exec("lpstat -d 2>&1")."</pre>";
            ?>
        </div>





    </div>


         <? require "require/rodape.php"; ?>

</body>
</html>