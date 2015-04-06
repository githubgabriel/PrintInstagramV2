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

<? $mi = "impressoras_online"; require("require/menu.php");?>


<div class="container">



<table class="table">
    <thead>
    <tr>
        <th width="60">Id</th>
        <th>Impressora Nome</th>
        <th> Time</th>
        <th> Status</th>
    </tr>
    </thead>
    <tbody>

    <?

    $sql = $instagramv2->cliente_selectImpressoras();
    $re = $conexao->query($sql);

    if(!$re->rowCount()) {
    ?>  <tr class="success">
            <td align="center" colspan="4">  <b style="color:green;">Nenhuma impressora online.</b> </td>
        </tr> <?
    }

    while($row = $re->fetchObject()) {

    ?>

    <tr class="success">
        <th scope="row"><?=$row->id;?></th>
        <td><?=$row->impressora_nome;?></td>
        <td><?=$row->time;?></td>
        <td align="center">  <b style="color:green;">Ativo</b> </td>
    </tr>

    <? } ?>



    </tbody>

</table>

    </div>

<? require "require/rodape.php"; ?>

</body>
</html>