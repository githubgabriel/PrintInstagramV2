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

    <? include_JS("js/site.js"); ?>


</head>
<body>

<? $mi = "status";
require("require/menu.php"); ?>


<div class="container">


    <div class="col-md-12" style="margin-top:30px;">
        <b>Printer destination (lpstat -d): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -d 2>&1") . "</pre>";
        ?>
    </div>


    <div class="col-md-12" style="margin-top:30px;">
        <b>Printer destination (lpstat -a): </b>
        <?
        echo "<pre>" . shell_exec("lpstat -a 2>&1") . "</pre>";
        ?>
    </div>


</div>

<? require "require/rodape.php"; ?>
</body>
</html>