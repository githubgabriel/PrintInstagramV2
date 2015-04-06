<?php

namespace base\instagramv2;

use base\mysqltools\mysqltools;
use base\instagramv2\instagramApi;

class instagramv2 {

    var $table_listen = "hashtag_listen";
    var $table_imagens = "hashtag_imagens";
    var $table_impressoras = "hashtag_impressoras_online";
    var $table_impressoras_req = "hashtag_impressoras_pedido";
    var $table_hashtag_listen = "hashtag_listen";
    var $table_hashtag_images = "hashtag_imagens";

    var $crontab_file = "~/crontab.txt";

    var $mysqltools = null;
    var $instagramApi = null;

    public function __construct() {
        $this->mysqltools = new mysqltools();
        $this->instagramApi = new instagramApi();
    }


    public function crontabSalvar($txt) {

        $tmp = shell_exec("cat <<EOF > ".$this->crontab_file."
        ".$txt);
        return $tmp;

    }
    public function crontabRestart() {
        $this->crontabStop();
        $this->crontabStart();
        $tmp = $this->crontabStatus();
        return $tmp;
    }

    public function crontabStop() {
        shell_exec("crontab -r 2>&1");
        $tmp = $this->crontabStatus();
        return $tmp;
    }
    public function crontabStatus() {
        $tmp =  shell_exec("crontab -l 2>&1");
        return $tmp;
    }
    public function crontabStart() {
        shell_exec("crontab ".$this->crontab_file." 2>&1");
        $tmp = $this->crontabStatus();
        return $tmp;
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
    public function cliente_selectImpressorasRequisicoes() {
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras_req);
        return $this->mysqltools->selectSQL();
    }
    public function cliente_selectImpressoras() {
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras);
        return $this->mysqltools->selectSQL();
    }
    public function cliente_deleteImpressora($id) {

        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_impressoras);
        $this->mysqltools->setWhere("id = '".$id."'");
        return $this->mysqltools->deleteSQL();

    }

    public function hashtag_deleteImage($id) {

        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_images);
        $this->mysqltools->setWhere("id = '".$id."'");
        return $this->mysqltools->deleteSQL();

    }

    public function hashtag_updateImage($id,$set) {
        $time = time();
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_images);
        $this->mysqltools->setWhere("id = '$id'");
        $this->mysqltools->setSet($set);
        return $this->mysqltools->updateSQL();
    }

    public function hashtag_selectImagens($hashtag = 0)
    {
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_images);
        if ($hashtag) {
            $this->mysqltools->setWhere("hashtag_id = '" . $hashtag . "'");
        }
        return $this->mysqltools->selectSQL();
    }
    public function hashtag_selectListens($where = 0, $order = 0) {
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_listen);
        if($where) {
            $this->mysqltools->setWhere($where);
        }
        if($order) {
            $this->mysqltools->setOrder($order);
        }
        return $this->mysqltools->selectSQL();
    }

    public function hashtag_checkImageId($jsonid) {
        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_images);
        $this->mysqltools->setWhere("json_id = '".$jsonid."'");
        return $this->mysqltools->selectSQL();
    }

    public function hashtag_insertImageData($hashtag_id, $item) {

        $hashtag = implode(",",$item["tags"]);
        $created_time = $item["created_time"];
        $link = $item["link"];
        $likes_count = $item["likes"]["count"];
        $likes_data = $item["likes"]["data"];
        $images_low_resolution = $item["images"]["low_resolution"]["url"];
        $images_thumbnail = $item["images"]["thumbnail"]["url"];
        $images_standard_resolution = $item["images"]["standard_resolution"]["url"];
        $caption_text = $item["caption"]["text"];
        $caption_id = $item["caption"]["id"];
        $type = $item["type"];
        $id = $item["id"];
        $user_username = $item["user"]["username"];
        $user_profile_picture = $item["user"]["profile_picture"];
        $user_id = $item["user"]["id"];
        $user_full_name = $item["user"]["full_name"];

        // echo "<pre>";print_r($item);

        $this->mysqltools->clear();
        $this->mysqltools->setTabela($this->table_hashtag_images);
        $this->mysqltools->setPreValues("(hashtag_id, hashtag, json_type, json_id, json_link, json_user_id, json_user_profile_picture, json_user_username, json_user_full_name, json_images_low_resolution, json_images_standard_resolution, json_images_thumbnail, json_caption_text, json_created_time, visible)");
        $this->mysqltools->setValues("('{$hashtag_id}','{$hashtag}','{$type}','{$id}','{$link}','{$user_id}','{$user_profile_picture}','{$user_username}','{$user_full_name}','{$images_low_resolution}','{$images_standard_resolution}','{$images_thumbnail}','{$caption_text}','{$created_time}', 1)");
        return $this->mysqltools->insertSQL();

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