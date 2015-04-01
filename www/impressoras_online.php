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

    <? include_JS("js/site.js"); ?>


</head>
<body>

<? $mi = "impressoras_online"; require("require/menu.php");?>


Impressoras Online



</body>
</html>