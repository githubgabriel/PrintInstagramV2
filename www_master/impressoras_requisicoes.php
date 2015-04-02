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

    <? include_JS("js/site.js"); ?>


</head>
<body>

<? $mi = "impressoras_requisicoes"; require("require/menu.php");?>


<div class="container">


<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Ação <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#">Pausar Impressão</a></li>
        <li><a href="#">Retormar Impressão </a></li>

        <li class="divider"></li>
        <li><a href="#">Remover Impressão</a></li>
    </ul>
</div>


<table class="table">
    <thead>
    <tr>
        <th width="25">  <input type="checkbox" id="check" name="check[]" value="1" />  </th>
        <th width="60">Id</th>
        <th>Impressora Nome</th>
        <th>Imagem ID</th>
        <th> Data Pedido</th>
        <th> Status</th>

    </tr>
    </thead>
    <tbody>
    <tr class="success">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">1</th>
        <td>Printer01</td>
        <td>314</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:green;">Aguardando..</b> </td>

    </tr>
    <tr class="success">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">1</th>
        <td>Printer01</td>
        <td>344</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:green;">Aguardando..</b> </td>

    </tr>

    <tr class="danger">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">1</th>
        <td>Printer01</td>
        <td>3424</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:red;">Erro..</b> </td>

    </tr>

    <tr class="active">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">2</th>
        <td>Printer02</td>
        <td>214</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:gray;"> Inativo </b> </td>

    </tr><tr class="active">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">2</th>
        <td>Printer02</td>
        <td>121</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:gray;"> Inativo </b> </td>

    </tr><tr class="active">
        <th>  <input type="checkbox" id="check" name="check[]" value="1" /> </th>
        <th scope="row">2</th>
        <td>Printer02</td>
        <td>321</td>
        <td>10/20/30 10:23</td>
        <td align="center">  <b style="color:gray;"> Inativo </b> </td>

    </tr>


    </tbody>

</table>

    </div>


<? require "require/rodape.php"; ?>

</body>
</html>