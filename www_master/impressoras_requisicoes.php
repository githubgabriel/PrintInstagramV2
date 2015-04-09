<?php

require "BASEV2/basev2.php";

getBaseV2("php");

getBaseV2("javascript");


use base\instagramv2\instagramv2;

$instagramv2 = new instagramv2();

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>InstagramV2</title>

    <link rel="stylesheet" href="css/site.css" type="text/css" />

    <? getPluginJS("Jquery"); ?>

    <? getPluginJS("BootStrap"); ?>

    <? include_JS("js/site.js"); ?>


</head>
<body>

<? $mi = "impressoras_requisicoes"; require("require/menu.php");?>


<div class="container">

    <div style="margin-top:10px;margin-bottom:11px;height:20px;">
        <div id="loadingImg" style="display:none;">
            <img src="images/icon-refresh.gif"/> <small>Atualizando..</small>
        </div>
    </div>

    <script src="js/check.js"> </script>
    <script>

        $(function() {

            $("input#checkBtn").checkAllBox({ checkBoxDiv: "input[type=checkbox]", debug: true });

        });

    </script>

<table class="table">
    <thead>
    <tr>
        <!--
        <th width="25">  <input type="checkbox" id="checkBtn" name="check[]" value="1" />  </th>
        -->
        <th width="60">Id</th>
        <th>Impressora Nome</th>
        <th>Imagem ID</th>
        <th> Data Pedido</th>
        <th> Status</th>

    </tr>
    </thead>
    <tbody>

    </tbody>

</table>


    <script>

        impressoraRequisicoes_refresh();


    </script>


</div>


<? require "require/rodape.php"; ?>

</body>
</html>