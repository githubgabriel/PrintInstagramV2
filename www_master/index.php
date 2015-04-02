<?php

    require "BASEV2/basev2.php";

    getBaseV2("php");

    getBaseV2("javascript");


    use base\instagramv2\instagramv2;


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>InstagramV2</title>

    <link rel="stylesheet" href="css/site.css" type="text/css" />

    <? getPluginJS("Jquery"); ?>

    <? getPluginJS("BootStrap"); ?>

    <? getPluginJS("ToastMessage"); ?>

    <? include_JS("js/site.js"); ?>

    <script>

        $(function() {
       /*     $().toastmessage('showToast', {
                text     : 'Bem vindo ao sistema InstagramV2!',
                sticky   : false,
                type     : 'notice',
                position: 'top-center'
            });
       */ });
    </script>


</head>

<body>

    <? $mi = "home"; require("require/menu.php");?>


    <div class="container">


        <h1>Instagram <span class="label label-default">V2</span></h1>
        <p>
          <small>  Created by Gabriel A. Barbosa </small>
        </p>

<div class="col-md-4" style="margin-top:30px;">
        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <span class="badge">1</span>
               <b> Hashtags Ativo</b>
            </li>
            <li class="list-group-item">
                <span class="badge">3</span>
                Hashtags Inativo
            </li>
            <li class="list-group-item">
                <span class="badge">932</span>
                Imagens Registradas (Total)
            </li>
        </ul>


        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <span class="badge">1</span>
                <b>Impressoras Ativas</b>
            </li>
            <li class="list-group-item">
                <span class="badge">15</span>
                Impressoras Requisições
            </li>
        </ul>

        </div>



        <div class="col-md-4" style="margin-top:30px;">
            <ul class="list-group">
                <li class="list-group-item list-group-item-warning">
                    <span class="badge">ATIVO</span>
                    <b> Crontab Status</b>
                </li>
                <li class="list-group-item list-group-item-warning">
                    <span class="badge">ATIVO</span>
                    <b>SSH Status</b>
                </li>
                <li class="list-group-item list-group-item-warning">
                    <span class="badge">ATIVO</span>
                    <b> MYSQL Status (Total)</b>
                </li>
            </ul>

        </div>
        <div class="col-md-4" style="margin-top:30px;">
        <?
            echo "<pre>".shell_exec("ifconfig en1 2>&1")."</pre>";
        ?>
        </div>

    </div>


    <? require "require/rodape.php"; ?>

</body>
</html>