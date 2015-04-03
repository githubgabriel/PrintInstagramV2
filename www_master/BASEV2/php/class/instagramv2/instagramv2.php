<?php

namespace base\instagramv2;

use base\mysqltools\mysqltools;

class instagramv2 {

    var $table_listen = "hashtag_listen";
    var $table_imagens = "hashtag_imagens";
    var $table_impressoras = "hashtag_impressoras_online";
    var $table_impressoras_req = "hashtag_impressoras_pedido";

    var $mysqltools = null;

    public function __construct() {
        $this->mysqltools = new mysqltools();
    }

    public function cliente_ImpressoraUpdate($nome) {
        $time = time();
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras);
        $this->mysqltools->setWhere("impressora_nome = '$nome'");
        $this->mysqltools->setSet("time = '$time'");
        return $this->mysqltools->updateSQL();
    }
    public function cliente_ImpressoraInsert($nome) {
        $time = time();
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras);
        $this->mysqltools->setPreValues("(impressora_nome, time)");
        $this->mysqltools->setValues("('$nome','$time')");
        return $this->mysqltools->insertSQL();
    }
    public function cliente_checkImpressoraExists($nome) {

        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras);
        $this->mysqltools->setWhere("impressora_nome = '$nome'");
        return $this->mysqltools->selectSQL();

    }

    public function get_client_id() {
        return $this->client_id;
    }
    public function get_secret_id() {
        return $this->secret_id;
    }
    public function set_hashtag($hs) {
        $this->hashtag = $hs;
    }
    public function get_hashtag() {
        return $this->hashtag;
    }
    public function set_count($cc) {
        $this->count = $cc;
    }
    public function get_count() {
        return $this->count;
    }





    public function showImages_($url = "") {


        $images_array = $this->get_json_imagens($url);

        $this->show_images_data($images_array);

        if($images_array['pagination']["next_url"] != "") {
            $this->showImages_($images_array['pagination']["next_url"]);
        } else { echo "ok";}


    }


    public function mysql_register_imagem($item) {

        if($this->mysql_check_existe_idd($item["id"]) == "0") {

            $sql = "insert into " . $this->table_imagens . " (hashtag,idd,usuario,imagem) values
        ('" . $this->hashtag . "','" . $item['id'] . "','" . $item['user']["username"] . "','" . $item['images']['low_resolution']["url"] . "')";
            conexao::query($sql);

        }
    }
    public function mysql_check_existe_idd($idd) {
        $sql = "select idd from ".$this->table_imagens." where idd = '".$idd."';";
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        if($num > 0) {
            return "1";
        } else {
            return "0";
        }
    }


    public function get_db_image_array_byId($id) {
        $sql = "select * from ".$this->table_imagens." where id = '".$id."';";
        $re = conexao::query($sql);
        $aw  = conexao::fetch_array($re);
        return $aw;
    }

    public function print_() {

        $sql = "select * from ".$this->table_imagens." where imprimir = '0';";
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        if($num > 0) {

            /* somente 2 registros por pedido */
            if($num > 2) { $num = 1; }

            for ($i = 0; $i < $num; $i++) {
                $aw = conexao::fetch_array($re);

                echo "Pedido para impressão: ID:" . $aw["id"];


                /* GERANDO PDF .... */
                $program = "/usr/local/bin/wkhtmltopdf";
                $url = "http://localhost:8888/2015/GABRIEL/Pessoal/Instagram%20Api%20Examples/template.php?id=" . $aw["id"];
                $tmp_cache = "/Users/linda/" . $aw["id"] . ".pdf";
                exec("$program $url $tmp_cache");

                /* Imprimindo... */
                exec('lpr ' . $tmp_cache);

                $this->update_coluna_table($this->table_imagens, $aw["id"], "imprimir", "1");


            }

        } else {
            echo "Nenhum pedido de impressão no momento... :/";
        }


    }


    public function update_coluna_table($table,$id,$coluna,$novovalor) {
        $sql = "update ".$table." set $coluna = '$novovalor' where id = '".$id."';";
        conexao::query($sql);
    }




}