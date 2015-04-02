<?php

    require "../../BASEV2/basev2.php";

    getBaseV2("php","../.");

    use base\instagramv2\instagramApi;


    if(!$_GET["hashtag"] or !$_GET["tipo"]) {
        echo "Falta Parametros...";
        die();
    }


    $obj = new instagramApi(CLIENTE_ID,SECRET_ID);

    $obj->setHashtag($_GET["hashtag"]);


    if($_GET["tipo"] == 1) {

        echo $obj->getJsonImagens();

    }
    else if($_GET["tipo"] == 2) {

        $obj->decodeImagesJson($obj->getJsonImagens());

    } else {

        echo "Parametro Tipo Incorreto.";

    }