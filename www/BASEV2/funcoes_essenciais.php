<?php


function parseDataBR($data) {
    $data = explode("-",$data);
    $data = $data[2]."/".$data[1]."/".$data[0];
    return $data;
}

function parseDataSQL($data) {
    $data = explode("/",$data);
    $data = $data[0]."-".$data[1]."-".$data[2];
    return $data;
}


function parseDataHoraBR($data) {
    $data_ = explode(" ",$data);
    $data = explode("-",$data_[0]);
    $data = $data[2]."/".$data[1]."/".$data[0]." ".$data_[1];
    return $data;
}

function parseDataHoraSQL($data) {
    $data_ = explode(" ",$data);
    $data = explode("/",$data_[0]);
    $data = $data[0]."-".$data[1]."-".$data[2]." ".$data_[1];
    return $data;
}

function include_JS($dirFileName) {
    echo '<script src="'.$dirFileName.'"> </script>';
}

function include_CSS($dirFileName) {
    echo '<link rel="stylesheet" href="'.$dirFileName.'" />';
}


function redirecionar($link) {
    echo "<script> window.location.href='".$link."'; </script>";
}


/* Funciona somente com  ajax-functions */
function redirecionarAjax($url) {
    echo "<script> redirecionarAjax('".$url."'); </script>";
}


/**
 * Retorna se a conexão foi feita por HTTP ou HTTPS :)
 * @return mixed
 */
function get_SERVER_PROTOCOL(){
    $tmp = $_SERVER["SERVER_PROTOCOL"];
    $tmp = explode("/", $tmp);
    return strtolower($tmp[0]);
}