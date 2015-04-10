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

    <link rel="stylesheet" href="css/site.css" type="text/css"/>

    <? getPluginJS("Jquery"); ?>

    <? getPluginJS("BootStrap"); ?>

    <? getPluginJS("ToastMessage"); ?>


    <? include_JS("js/site.js"); ?>


</head>
<body>

<? $mi = "status";
require("require/menu.php"); ?>


<div class="container">

<? if($_GET["clear"] == "1") { shell_exec("lprm - 2>&1"); echo "<script>aviso('Todos jobs foram <br> Cancelados!','notice');</script>";} ?>


    <div class="col-md-6" style="margin-top:30px;">
        <b>Shell Exec (lpstat -d): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -d 2>&1") . "</pre>";
        ?>
    </div>

    <div class="col-md-6" style="margin-top:30px;">
        <b>Shell Exec (lpstat -p): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -p 2>&1") . "</pre>";
        ?>
    </div>

    <div class="col-md-6" style="margin-top:30px;">
        <b>Shell Exec (lpstat -a): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -a 2>&1") . "</pre>";
        ?>
    </div>


    <div style="display:none;" class="col-md-6" style="margin-top:30px;">
        <b>Shell Exec (lpstat -a): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -a 2>&1") . "</pre>";
        ?>
    </div>




    <div class="col-md-12" style="margin-top:10px;">
        <div style="margin-top:10px;margin-bottom:11px;height:20px;">
            <div id="loadingImg" style="display:none;">
                <img src="images/icon-refresh.gif"/> <small>Atualizando..</small>
            </div>
        </div>
        <b>Shell Exec (lpq): <a href="?clear=1"><button class="btn btn-default"> Cancelar todos Jobs </button></a> </b>
        <?
        echo "<pre style='margin-top:10px;' id='lpqhtml'>" . shell_exec("lpq 2>&1") . "</pre>";
        ?>
    </div>


    <script>

        lpqSystemRefresh();


    </script>


</div>

<? require "require/rodape.php"; ?>
</body>
</html>