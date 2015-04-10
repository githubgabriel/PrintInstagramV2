<?php

require "../../BASEV2/basev2.php";

getBaseV2("php","../.");

//use base\instagramv2\instagramApi;
use base\instagramv2\instagramv2;
//use base\instagramv2\webservice;

if(!$_GET["id"]) {
    echo "Falta Parametros...";
    die();
}

$obj = new instagramv2();

/**
 *
 * CHECA SE EXISTE REQUISICAO
 *
 * CASO NAO EXISTA
 *       > Return false;
 * CASO EXISTA
 *       > PEGAR REGISTRO COM LAYOUT HTML, CONVERTER EM PDF E IMPRIMIR.
 *        > return
 *
 */
/* Checa se impressora já existe... */
$sql = $obj->cliente_requisicoesUpdateStatus($_GET["id"],$_GET["status"]);
//echo($sql);
$re = $conexao->query($sql);

echo "1";

