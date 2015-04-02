<?php

require "BASEV2/basev2.php";

getBaseV2("php");

/**
 * Created by PhpStorm.
 * User: linda
 * Date: 02/04/15
 * Time: 14:56
 */

if($_GET["acao"] == "updateConfigTerminal") {

    $_SESSION["IMPRESSORA_NOME"] = $_GET["nome_impressora"];
    $_SESSION["SERVER_MASTER"] = $_GET["ip_server_master"];

    echo "1";

}
else if($_GET["acao"] == "updateRodape") {

    $text = null;
    if($_SESSION["IMPRESSORA_NOME"]) {
        $text .="IMPRESSORA NOME: <b>" . $_SESSION["IMPRESSORA_NOME"] . "</b><br/>";
    }
    $text .= "MEU IP: ".getIPByHost("gabrielbarbosa.local");
    $text .= "<br>";
    if($_SESSION["SERVER_MASTER"]) {


        if(ping($_SESSION["SERVER_MASTER"])) {
            $color = "greenyellow";
            $ping_msg = "connectado!";
        } else {
            $color = "red";
            $ping_msg = "Fail!";
        }

        $text .= "CONNECTADO SERVER IP: <b style='color:".$color."'>" . $_SESSION["SERVER_MASTER"]." - $ping_msg</b>";
    } else {
        $text .= "Sem conexão com servidor master";
    }
    echo $text;
}