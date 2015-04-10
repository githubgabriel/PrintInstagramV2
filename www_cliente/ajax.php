<?php

require "BASEV2/basev2.php";

getBaseV2("php");

use base\instagramv2\instagramv2;
use base\instagramv2\webservice;

$instagramv2 = new instagramv2();
$webservice = new webservice();

/**
 * Created by PhpStorm.
 * User: linda
 * Date: 02/04/15
 * Time: 14:56
 */

$a = $_GET["acao"];

if ($a == "updateConfigTerminal") {

    $_SESSION["IMPRESSORA_NOME"] = $_GET["nome_impressora"];
    $_SESSION["SERVER_MASTER"] = $_GET["ip_server_master"];
    echo "1";

} else if ($a == "updateRodape") {


    $instagramv2->cliente_ShowRodape();


} else if ($a == "impressoraUpdateStatus_and_JsonRequisicoes") {

    $webservice->impressoraUpdateStatus();

    $json = $webservice->getJsonRequisicoes();

    if(!$json) { echo "Nenhuma requisição."; } else {

        $Array = json_decode($json, true);
        //print_r($Array);
        $instagramv2->_print($Array[0]["imagens_id"]);

        echo $webservice->requisicaoUpdateStatus($Array[0][0], "1");

    }

} else if ($a == "setClienteServerStatus") {

    $_SESSION["cliente_server_status"] = $_GET["valor"];
    echo "1";

} else if ($a == "checkWebService") {

    echo $webservice->checkWebService();

}