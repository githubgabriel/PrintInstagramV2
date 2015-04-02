<?php
namespace base\ambiente_restrito;
class ambiente_restrito {

    var $table_users = "usuarios";

    static function isLogged($logado = null) {
        if($logado == "sim") { $_SESSION["painel_logado"] = "sim";  }
        if($logado == "nao") {  $_SESSION["painel_logado"] = "nao";  }
        if($_SESSION["painel_logado"] == "nao" and $logado == null) { die("Sessão foi finalizada.. por favor logar novamente!"); }
    }
    static function statusLogged() {
        return $_SESSION["painel_logado"];
    }

    /**
     * Validar Login e Senha recebidos com o Banco de dados
     * @param $login
     * @param $senha
     * @return bool
     */
    static function  validarLoginSenha($login,$senha) {
        if($login and $senha) {
            self::isLogged("sim");
            return true;
        } else {
            self::isLogged("nao");
            return false;
        }
    }

}