<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

/**
 *   Configurações Gerais
 */
define("HOST_PROTOCOL", get_SERVER_PROTOCOL()."://");
define("IP_ROOT",$_SERVER['SERVER_ADDR']);
define("HOST_ROOT",$_SERVER['HTTP_HOST']);
define("HOST_ROOT_PATH", dirname($_SERVER["PHP_SELF"]));
define("HOST_ROOT_FULL", HOST_PROTOCOL.HOST_ROOT.HOST_ROOT_PATH);
//define("DIR_SYS","/Users/lucaspasquetto/Sites/sysbase/");

/**
 *   autoload
 */
define("AUTOLOAD_DIR_CLASS", "class");

/**
 *  Conexão com Banco de Dados
 */
if(HOST_ROOT == "localhost:8888" or HOST_ROOT == "localhost" or HOST_ROOT == "127.0.0.1" or HOST_ROOT == "127.0.0.1:8888") {
    define("DATABASE_HOST","localhost");
    define("DATABASE_LOGIN","root");
    define("DATABASE_PASS","root1313");
    define("DATABASE_DB","gabriel_instagramv2");
} else {
    define("DATABASE_HOST","localhost");
    define("DATABASE_LOGIN","root");
    define("DATABASE_PASS","root1313");
    define("DATABASE_DB","gabriel_instagramv2");
}

define("CLIENTE_ID", "1d12369666f64e0b90a6ac9364a02bd9");
define("SECRET_ID", "0a010ca1c774483c98a7f5b46ab8a97a");
define("COUNT_IMAGE_POR_SCRIPT", 20);