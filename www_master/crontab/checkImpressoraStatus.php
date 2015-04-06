<?php

require "../BASEV2/basev2.php";

getBaseV2("php",".");

use base\instagramv2\instagramv2;

//shell_exec("say impressora 2>&1");

$instagramv2 = new instagramv2();

$IMPRESSORA_TIMEOUT = 30; // 30

$sql = $instagramv2->cliente_selectImpressoras();
$re = $conexao->query($sql);

while($row = $re->fetchObject()) {

    $time_atual = time();
    $resultado = ($time_atual - $row->time);
    // echo " (".$row->time." - ".$time_atual." = ".$resultado.") ";

    if($resultado > $IMPRESSORA_TIMEOUT) {

        $sql = $instagramv2->cliente_deleteImpressora($row->id);
        $conexao->query($sql);

    }

}

echo "1";
