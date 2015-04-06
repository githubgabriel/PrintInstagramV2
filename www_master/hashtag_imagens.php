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

    <? getPluginJS("ToastMessage"); ?>

    <? getPluginJS("Chosen"); ?>

    <? include_JS("js/site.js"); ?>


    <?
        $hashtag = $_GET["hashtag"];

        /* alimenta options ... */

        $sql = $instagramv2->hashtag_selectListens();
        $re = $conexao->query($sql);
        if($re->rowCount()) {

            $option = "";
            while($row = $re->fetchObject()) {

                /* seta paremetro get com id encontrada */
                if($row->hashtag == $hashtag) { $hashtag = $row->id; }

                $option .= '<option value="'.$row->id.'"> '.$row->hashtag.' </option>';

            }

        }


    ?>


</head>
<body>

<? $mi = "hashtag_imagens"; require("require/menu.php");?>


<div class="container">


<form style="max-width: 500px;">
<div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Selecione #Hashtag</label>
                <select name="select_hash" class="form-control">
                  <?=$option?>
                    <option value=""> Todas imagens.. </option>
                </select>

                <script>
                    <? if($hashtag) { ?>
                        $("select[name=select_hash]").val("<?=$hashtag?>");
                    <? } ?>
                </script>
            </div>
        </div>

        <div class="col-md-4">
            <button type="submit" style="margin-top:20px;" onclick="return hashtag_getImasges()" class="btn btn-default">Selecionar</button>
        </div>

    </div>
</form>



<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Ação <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li onclick="return bloquearImagens_selecionadas()"><a href="#">Bloquear Imagens </a></li>
        <li onclick="return desbloquearImagens_selecionadas()"><a href="#">Desbloquear Imagens </a></li>
        <li onclick="return deletarImagens_selecionadas()"><a href="#">Deletar Imagens </a></li>
        <li class="divider"></li>
        <li onclick="return checkAllImages();"><a href="#">Selecionar Todos</a></li>
    </ul>
</div>


<ul class="row" id="imagem_box">


</ul>

    </div>

<script> $("select").chosen(); </script>

<script>

        hashtag_getImasges();

</script>

<? require "require/rodape.php"; ?>
</body>
</html>