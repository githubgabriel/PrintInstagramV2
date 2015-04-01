<?php
namespace base\upload;

use base\log\log;

class upload {


    static function upload($novoNome, $FILE, $dir_save, $exValidos) {

        /* Caso File não exista.. ou nao seja Array .. retorna vazio .. */
        if(!$FILE or !is_array($FILE)) { log::logJs("UPLOAD: variavel FILE vazia ou não é Array."); return ""; }

        /* Caso seja uma array mais venha com filename vazia .. */
        if($FILE["name"] == "") { log::logJs("UPLOAD: variavel FILENAME vazia."); return ""; }

        /* Verifica se existe diretorio ... */
        if(file_exists($dir_save)) {

            /* Caso novoNome venha vazio.. chamar randomName */
            if(!$novoNome) { $novoNome = self::getRandomName(); }

            /* Recebe extensao do arquivo na variavel extension .. */
            $fileName = $FILE["name"];
            $extension = self::getExtensionByName($fileName);

            /* Recebe dir temporaria do upload ... */
            $TMP_NAME = $FILE["tmp_name"];

            /* Verifica se extensao é valida */
            $permitidos = explode(",",$exValidos);
            if(in_array($extension, $permitidos) )
            {

                $nomeFinal = $novoNome.".".$extension;

                // Monta url local aonde arquivo será salvo
                $pathAndName = $dir_save.$nomeFinal;

                $moveResult = move_uploaded_file($TMP_NAME, $pathAndName);

                if ($moveResult == true) {
                    chmod($pathAndName, 0777);
                    return $nomeFinal;
                } else {
                    log::logJs("UPLOAD: Não foi possivel mover arquivo... ");
                    return "";
                }

            } else {
                log::logJs("UPLOAD: Extensão não permitida");
                return "";
            }

        } else {
            log::logJs("UPLOAD: Caminho nao existe: ".$dir_save);
            return "";
        }

    }

    static function getRandomName() {
        $val1 = rand(10000000,99999999);
        $val2 = time();
        $name = $val1.$val2;
        return $name;
    }

    static function getExtensionByName($fileName) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        return $ext;
    }

}