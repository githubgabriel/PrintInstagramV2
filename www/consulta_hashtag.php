<?php

    require "BASEV2/basev2.php";

    getBaseV2("php");

    getBaseV2("javascript");


    use base\instagramv2\instagramv2;

    $tagram = new instagramv2(CLIENTE_ID,SECRET_ID);

    /* AJAX  FIND AND SET HASHTAG */
    if($_GET["set_hashtag"] != "") {

        $_SESSION["hashtag"] = $_GET["set_hashtag"];

        $tagram->set_hashtag($_SESSION["hashtag"]);
        $count = $tagram->get_json_count();

        echo "Registros encontrados: ".$count["data"]["media_count"];

        die();
    }

    /* Recebe quantidade de reg da hashtag na sessao ... */
    $tagram->set_hashtag($_SESSION["hashtag"]);
    $count = $tagram->get_json_count();


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

    <? $mi = "consulta_hashtag"; require("require/menu.php");?>



<div id="configure_hashtag">

    <span style="position:relative;top:6px;left:-4px;">#</span><input type="text" name="set_hashtag" value="<?=$_SESSION["hashtag"]?>" />
    <div id="desc"> Registros encontrados: <?=$count["data"]["media_count"]?> </div>

</div>



</body>
</html>