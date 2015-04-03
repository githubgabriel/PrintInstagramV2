<?php
/**
 * Base PHP, Javascript, CSS.
 * @author Gabriel A. Barbosa
 * @access Public
 * @version 1.0.0
 *
 */
session_start();



/* deixar restrito */
if($_GET["senha"] == "senha1313") {
    $_SESSION["instagramv2_senha"] = "senha1313";
}
if($_SESSION["instagramv2_senha"] != "senha1313") {
    echo "silence is god :)";
    die();
}



/*
    Funcoes Essenciais
*/
require "funcoes_essenciais.php";
/*
    Carrega Configurações Define
*/
require "config.inc.php";

/**
 *  Cria Conexao PDO para acessar Banco de Dados
 */
try {
    $conexao = new PDO("mysql:host=".DATABASE_HOST.";dbname=".DATABASE_DB, DATABASE_LOGIN, DATABASE_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (Exception $e) {
    echo $e->getMessage(); die();
}


/*
    Função para pegar BASE
*/
function getBaseV2($tipo,$dir = "") {
    $tipo = strtolower($tipo);
    switch($tipo) {
        case "php":
            $tmp = $tipo;
            break;
        case "javascript":
            $tmp = $tipo;
            break;
        case "css":
            $tmp = $tipo;
            break;
        default:
            $tmp = false;
    }
    if($tmp) {
        $arq = $dir."./BASEV2/".$tmp."/$tmp.php";
        if(file_exists($arq))
            { include $arq; }
        else
            { echo "FileExists Fail : $arq"; }
    } else {
        echo "GetRequireBase() > Tipo não existe!";
    }
}
