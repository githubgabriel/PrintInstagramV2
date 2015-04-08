<?php

    require "BASEV2/basev2.php";

    getBaseV2("php");

    getBaseV2("javascript");


    use base\instagramv2\instagramv2;

    $instagramv2 = new instagramv2();


/* Verificando quantidade de Impressoras Online */
$sql = $instagramv2->cliente_selectImpressoras();
$re = $conexao->query($sql);
$qtd_impressoras_online = $re->rowCount();



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

<div class="col-md-6" style="margin-top:30px;">
        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <span class="badge"><?=$qtd_hashtag_listen;?></span>
                <a href="hashtag_listen.php">  <b> Hashtags Ativo</b> </a>
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$qtd_hashtag_listen_inativo;?></span>
                Hashtags Inativo
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$qtd_imagens?></span>
                <a href="hashtag_imagens.php">  Imagens Registradas (Total) </a>
            </li>
        </ul>


        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <span class="badge"><?=$qtd_impressoras_online?></span>
                <a href="impressoras_online.php"><b>Impressoras Ativas</b></a>
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$qtd_impressoras_req?></span>
                <a href="impressoras_requisicoes.php">  Impressoras Requisições </a>
            </li>
        </ul>

        </div>



       <!-- <div class="col-md-6" style="margin-top:30px;">
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

        </div> -->
        <div class="col-md-6" style="margin-top:5px;">
            <b style="margin-right:10px;">Crontab ativos: </b>

            <button onclick="crontab_restart()" class="btn btn-info"> Restart </button>
            <button onclick="crontab_start()" class="btn btn-success"> Start </button>
            <button onclick="crontab_stop()" class="btn btn-danger"> Stop </button>
            <button onclick="crontab_edit(this)" class="btn btn-warning"> Editar </button>
            <?
                echo "<pre style='margin-top:10px;' id='pre-crontab'>".$instagramv2->crontabStatus()."</pre>";
            ?>
        </div>

    </div>


    <? require "require/rodape.php"; ?>

</body>
</html>