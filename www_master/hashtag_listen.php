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

<? $mi = "hashtag_listen"; require("require/menu.php");?>


<div class="container">


<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Ação <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#">Ligar </a></li>
        <li><a href="#">Desligar</a></li>
    </ul>
</div>


<table class="table">
    <thead>
    <tr>
        <th width="25">  <input type="checkbox" id="check" name="check[]" value="1" />  </th>
        <th width="60">Id</th>
        <th># HashTag</th>
        <th width="230">Data Inicio</th>
        <th width="230">Data Fim </th>
        <th width="140"> Qtd Imagens</th>
        <th width="150"> Cron Status </th>
    </tr>
    </thead>
    <tbody>


    <?

    $sql = $instagramv2->hashtag_selectListens("","datetime_fim asc");
    $re = $conexao->query($sql);

    if(!$re->rowCount()) {
        ?>  <tr class="success">
            <td align="center" colspan="7">  <b style="color:green;">Nenhuma HashTag registrada.</b> </td>
        </tr> <?
    }

    while($row = $re->fetchObject()) {

        /* pega quantidade de fotos obtidas ..*/
        $sql = $instagramv2->hashtag_selectImagens($row->id);
        $re2 = $conexao->query($sql);

        if($row->status == "1") {
            $row->status = "Ligado"; $color = "green"; $class = "success";
        } else {
            $row->status = "Desligado"; $color = "red"; $class = "danger";
        }

        if(!$row->datetime_fim) { $row->datetime_fim = " -- "; }

        ?>

        <tr class="<?=$class?>">
            <th> <input type="checkbox" id="check" name="check[]" value="<?=$row->id;?>" /></th>
            <th scope="row"><?=$row->id;?></th>
            <td><a href="consulta_hashtag.php?hashtag=<?=$row->hashtag;?>">#<?=$row->hashtag;?></a></td>
            <td><?=$row->datetime_inicio;?></td>
            <td> <?=$row->datetime_fim;?> </td>
            <td align="center"> <a href="hashtag_imagens.php?hashtag=<?=$row->hashtag;?>"><?=$re2->rowCount();?></a> </td>
            <td align="center">  <b style="color:<?=$color?>;"><?=$row->status;?></b> </td>
        </tr>


    <? } ?>


    </tbody>

</table>

    </div>

<? require "require/rodape.php"; ?>
</body>
</html>