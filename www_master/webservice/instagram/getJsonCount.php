<?php

    require "../../BASEV2/basev2.php";

    getBaseV2("php","../.");

    use base\instagramv2\instagramApi;


    if(!$_GET["hashtag"] or !$_GET["tipo"]) {
        echo "Falta Parametros...";
        die();
    }

    $_SESSION["hashtag"] = $_GET["hashtag"];


    $obj = new instagramApi(CLIENTE_ID,SECRET_ID);

    $obj->setHashtag($_GET["hashtag"]);


    if($_GET["tipo"] == 1) {

        echo $obj->getJsonCount();

    }
    else if($_GET["tipo"] == 2) {

        $obj->decodeCountJson($obj->getJsonCount());

    } else {

        echo "Parametro Tipo Incorreto.";

    }