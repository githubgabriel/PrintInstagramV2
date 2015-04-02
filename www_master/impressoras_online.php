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

<? $mi = "impressoras_online"; require("require/menu.php");?>


<div class="container">

<table class="table">
    <thead>
    <tr>
        <th width="60">Id</th>
        <th>Impressora Nome</th>
        <th> Status</th>
    </tr>
    </thead>
    <tbody>
    <tr class="success">
        <th scope="row">1</th>
        <td>Printer01</td>
        <td align="center">  <b style="color:green;">Ativo</b> </td>

    </tr>

    <tr class="success">
        <th scope="row">2</th>
        <td>Printer02</td>
        <td align="center">  <b style="color:green;">Ativo</b> </td>

    </tr>


    </tbody>

</table>

    </div>

<? require "require/rodape.php"; ?>

</body>
</html>