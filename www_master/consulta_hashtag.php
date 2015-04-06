<?php

require "BASEV2/basev2.php";

getBaseV2("php");

getBaseV2("javascript");


use base\instagramv2\instagramv2;

$instagramv2 = new instagramv2();

if ($_GET["hashtag"]) {

    $_SESSION["hashtag"] = $_GET["hashtag"];

}

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

<? $mi = "consulta_hashtag";
require("require/menu.php"); ?>



<div id="configure_hashtag">

    <span style="position:relative;top:6px;left:-4px;">#</span><input type="text" name="set_hashtag"
                                                                      value="<?= $_SESSION["hashtag"] ?>"/>

    <div id="desc"></div>
    <div id="desc2"></div>

</div>


<div id="preview_images" style="text-align:center;">


</div>


<script>$(function () {

        $("input[name=set_hashtag]").change(function () {

            var hashtag = $("input[name=set_hashtag]").val();


            getJsonCount(hashtag);

            getJsonImages(hashtag);


        });

    });

    function getJsonCount(hashtag) {
        $.ajax({
            type: 'GET',
            url: 'webservice/instagram/getJsonCount.php',
            data: {
                hashtag: hashtag,
                tipo: 2
            }, beforeSend: function () {

                $("#configure_hashtag #desc").html("Verificando quantidade de registros...");
                $("#configure_hashtag #desc").css("color", "gray");

            }, success: function (data) {
                $("#configure_hashtag #desc").html("Total Registros: " + data);
                $("#configure_hashtag #desc").css("color", "green");
            }
        });

    }

    function getJsonImages(hashtag) {
        $.ajax({
            type: 'GET',
            url: 'webservice/instagram/getJsonImages.php',
            data: {
                hashtag: hashtag,
                tipo: 2
            }, beforeSend: function () {

                $("#configure_hashtag #desc2").html("Carregando Images...");
                $("#configure_hashtag #desc2").css("color", "gray");

            }, success: function (data) {
                $("#configure_hashtag #desc2").html("...");

                $("#preview_images").html(data);
            }
        });
    }


</script>


<? if ($_GET["hashtag"]) {
    ?>
    <script>
        getJsonCount('<?=$_GET["hashtag"]?>');

        getJsonImages('<?=$_GET["hashtag"]?>');
    </script>
<? } ?>

<? require "require/rodape.php"; ?>
</body>
</html>