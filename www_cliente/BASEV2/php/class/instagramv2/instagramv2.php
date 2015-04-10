<?php

namespace base\instagramv2;

use base\instagramv2\webservice;

class instagramv2
{

    var $table_imagens = "imagens";

    var $client_id = null;
    var $secret_id = null;
    var $hashtag = null;
    var $count = 20;


    public function cliente_ShowRodape()
    {
        $webservice = new webservice();
        $txt = null;
        if ($_SESSION["IMPRESSORA_NOME"]) {
            $txt .= "IMPRESSORA NOME: <b>" . $_SESSION["IMPRESSORA_NOME"] . "</b><br/>";
        }
        $txt .= "MEU IP: " . getIPByHost("gabrielbarbosa.local");
        $txt .= "<br>";
        if ($_SESSION["SERVER_MASTER"]) {

            if ($webservice->checkWebService()) {
                $color = "greenyellow";
                $ping_msg = "connectado!";
            } else {
                $color = "red";
                $ping_msg = "Fail!";
            }

            $txt .= "CONNECTADO SERVER IP: <b style='color:" . $color . "'>" . $_SESSION["SERVER_MASTER"] . " - $ping_msg</b>";

        } else {
            $txt .= "Sem conexão com servidor master";
        }
        echo $txt;
    }


    function __construct($cId, $sId)
    {
        $this->client_id = $cId;
        $this->secret_id = $sId;
    }

    public function get_client_id()
    {
        return $this->client_id;
    }

    public function get_secret_id()
    {
        return $this->secret_id;
    }

    public function set_hashtag($hs)
    {
        $this->hashtag = $hs;
    }

    public function get_hashtag()
    {
        return $this->hashtag;
    }

    public function set_count($cc)
    {
        $this->count = $cc;
    }

    public function get_count()
    {
        return $this->count;
    }


    public function _generatePDF($idImage) {

        $tempFile = "~/terminal_temp";
        exec("/bin/mkdir ".$tempFile."");

        $program = "/usr/local/bin/wkhtmltopdf";
        $url = "http://localhost:8888/2015/GABRIEL/Pessoal/Instagram%20Api%20Examples/template.php?id=" . $idImage;
        $tmp_cache = "~/terminal_temp/" . $idImage . ".pdf";
        exec("$program $url $tmp_cache");
        echo "[Temp File dir: ".$tmp_cache."]";
        return $tmp_cache;

    }

    public function _print($iamgemid) {


        if($iamgemid) {

                /* GERANDO PDF .... */
                $link = $this->_generatePDF($iamgemid);

            echo $link;

                /* Imprimindo... */
                $re = exec('lp ' . $link);

                echo " - [ Exec lp ".$re." ]";

        } else {
            return "Erro ao criar pedido de impressão.. :/";
        }


    }

    public function update_coluna_table($table,$id,$coluna,$novovalor) {
        $sql = "update ".$table." set $coluna = '$novovalor' where id = '".$id."';";
        return $sql;
    }



}