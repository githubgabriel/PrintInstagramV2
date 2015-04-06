<?php

require "../BASEV2/basev2.php";

getBaseV2("php",".");

use base\instagramv2\instagramv2;
use base\instagramv2\instagramApi;

//shell_exec("say k 2>&1");

$instagramv2 = new instagramv2();

$instagramApi = new instagramApi(CLIENTE_ID,SECRET_ID);

/* seleciona todos listen ativos ... */
$sql = $instagramv2->hashtag_selectListens("status = '1'");
$re = $conexao->query($sql);

while($row = $re->fetchObject()) {

    $hashtag = $row->hashtag;
    $hashtag_id = $row->id;

    getDataRecursive($hashtag, $hashtag_id, "");

}

function getDataRecursive($hashtag, $hashtag_id, $url) {

    $GLOBALS["instagramApi"]->setHashtag($hashtag);
    $json = $GLOBALS["instagramApi"]->getJsonImagens($url);
    $json_inArray = json_decode($json, true);

    echo $hashtag." -> ".$url;

    foreach($json_inArray['data'] as $item){

        if($item['images']['low_resolution']["url"]) {

            /* Verifica no banco de dados se ja existe imagem com este ID  */
            $sql = $GLOBALS["instagramv2"]->hashtag_checkImageId($item["id"]);
            $re2 = $GLOBALS["conexao"]->query($sql);

            if(!$re2->rowCount()) {
                /* Insert image Data array */
                $sql = $GLOBALS["instagramv2"]->hashtag_insertImageData($hashtag_id, $item);
                $re3 = $GLOBALS["conexao"]->query($sql);
            }

        }

    }

    if($json_inArray['pagination']["next_url"] != "") {

        getDataRecursive($hashtag, $hashtag_id, $json_inArray['pagination']["next_url"]);

    } else { echo "cabo..";}

}

//echo "1";







//$IMPRESSORA_TIMEOUT = 30; // 30

/*
$sql = $instagramv2->cliente_selectImpressoras();

$re = $conexao->query($sql);

while($row = $re->fetchObject()) {

    $time_atual = time();
    $resultado = ($time_atual - $row->time);
    // echo " (".$row->time." - ".$time_atual." = ".$resultado.") ";

    if($resultado > $IMPRESSORA_TIMEOUT) {

        $sql = $instagramv2->cliente_deleteImpressora($row->id);
        $conexao->query($sql);

    }

}
*/