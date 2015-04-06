<?php


function parseDataBR($data)
{
    $data = explode("-", $data);
    $data = $data[2] . "/" . $data[1] . "/" . $data[0];
    return $data;
}

function parseDataSQL($data)
{
    $data = explode("/", $data);
    $data = $data[0] . "-" . $data[1] . "-" . $data[2];
    return $data;
}


function parseDataHoraBR($data)
{
    $data_ = explode(" ", $data);
    $data = explode("-", $data_[0]);
    $data = $data[2] . "/" . $data[1] . "/" . $data[0] . " " . $data_[1];
    return $data;
}

function parseDataHoraSQL($data)
{
    $data_ = explode(" ", $data);
    $data = explode("/", $data_[0]);
    $data = $data[0] . "-" . $data[1] . "-" . $data[2] . " " . $data_[1];
    return $data;
}

function include_JS($dirFileName)
{
    echo '<script src="' . $dirFileName . '"> </script>';
}

function include_CSS($dirFileName)
{
    echo '<link rel="stylesheet" href="' . $dirFileName . '" />';
}

function getIPByHost($hostname)
{
    return gethostbyname($hostname);
}

function getIP()
{
    $variables = array(REMOTE_ADDR,
        HTTP_X_FORWARDED_FOR,
        HTTP_X_FORWARDED,
        HTTP_FORWARDED_FOR,
        HTTP_FORWARDED,
        HTTP_X_COMING_,
        HTTP_COMING_,
        HTTP_CLIENT_IP);
    $return = Unknown;
    foreach ($variables as $variable) {
        if (isset($_SERVER[$variable])) {
            $return .= $_SERVER[$variable] . " - ";
        }
    }
    return $return;
}


function redirecionar($link)
{
    echo "<script> window.location.href='" . $link . "'; </script>";
}


/* Funciona somente com  ajax-functions */
function redirecionarAjax($url)
{
    echo "<script> redirecionarAjax('" . $url . "'); </script>";
}

function ping($host)
{
    exec(sprintf('ping -c 1 -W 1 %s', escapeshellarg($host)), $res, $rval);
    if ($rval === 0) {
        return 1;
    } else {
        return 0;
    }
}


/**
 * Retorna se a conexão foi feita por HTTP ou HTTPS :)
 * @return mixed
 */
function get_SERVER_PROTOCOL()
{
    $tmp = $_SERVER["SERVER_PROTOCOL"];
    $tmp = explode("/", $tmp);
    return strtolower($tmp[0]);
}