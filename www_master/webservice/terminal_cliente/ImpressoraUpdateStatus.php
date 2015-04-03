<?php

require "../../BASEV2/basev2.php";

getBaseV2("php","../.");

//use base\instagramv2\instagramApi;
use base\instagramv2\instagramv2;
//use base\instagramv2\webservice;

if(!$_GET["impressora_nome"]) {
    echo "Falta Parametros...";
    die();
}

$obj = new instagramv2();

/**
 *
 * CHECA SE EXISTE
 *
 * CASO NAO EXISTA
 *       > ADD IMPRESSORA REGISTRO
 * CASO EXISTA
 *       > UPDATE IMPRESSORA REGISTRO
 *
 */
/* Checa se impressora já existe... */
$sql = $obj->cliente_checkImpressoraExists($_GET["impressora_nome"]);
$re = $conexao->query($sql);

if($re->rowCount()) {

    /* Update no registro ;D */
    $sql = $obj->cliente_ImpressoraUpdate($_GET["impressora_nome"]);
    $re = $conexao->query($sql);
    echo $re->rowCount();

} else {

    /* insert no registro :D */
    $sql = $obj->cliente_ImpressoraInsert($_GET["impressora_nome"]);
    $re = $conexao->query($sql);
    echo $re->rowCount();

}
/** end */


/*

    Verificar se existe alguma requisição de impressão.....
    logo abaixo...

*/