<?php

require "BASEV2/basev2.php";

getBaseV2("php");

use base\instagramv2\instagramv2;
use base\instagramv2\webservice;

$instagramv2 = new instagramv2();
//$webservice = new webservice();

/**
 * Created by PhpStorm.
 * User: linda
 * Date: 02/04/15
 * Time: 14:56
 */

$a = $_GET["acao"];

if ($a == "crontabRestart") {

    echo $instagramv2->crontabRestart();


} else if ($a == "crontabStop") {

    echo $instagramv2->crontabStop();

} else if ($a == "crontabStart") {

    echo $instagramv2->crontabStart();

}else if ($a == "crontabEdit") {

    echo $instagramv2->crontabStatus();

}
else if ($a == "crontabSalvar") {

    $instagramv2->crontabSalvar(trim($_GET["valor"]));

    $instagramv2->crontabRestart();

    echo $instagramv2->crontabStatus();

} else if($a == "hashtag_getImages") {


    $_SESSION["images_hashtag"] = $_GET["hashtag_id"];

    $sql = $instagramv2->hashtag_selectImagens($_GET["hashtag_id"]);
    $re = $conexao->query($sql);
    if($re->rowCount()) {

        while($row = $re->fetchObject()) {

            $hashing = explode(",",$row->hashtag);
            foreach($hashing as $hashi) {
                $saida_hash .= "#".$hashi;
            }

        ?>

        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" onclick="return checkImage(this);event.cancelBubble=true;" style="position:relative;min-height:150px;">
            <input type="checkbox" id="check" name="check[]" value="<?=$row->id?>" />
            <a href="#" class="thumbnail">
                <img class="img-responsive" src="<?=$row->json_images_thumbnail?>">
            </a>
       <? if(!$row->visible) { ?>
            <div class="image_blocked">BLOQUEADO</div>
       <? } ?>
            <div class="image_obs"> <span> <a href="<?=$row->json_link?>" target="_blank"><b><?=$row->json_user_username?></b></a> <br><?=$saida_hash?> </span></div>
        </li>


        <?
        }

    } else {
        echo "<b style='text-align:center;display:block;margin-top:20px;'>Nenhuma imagem encontrada!</b>";
    }
} else if($a == "bloquearImagens") {

    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_updateImage($json_decode[$i], "visible = '0'");
        $re = $conexao->query($sql);

    }

    echo "1";
}  else if($a == "desbloquearImagens") {

    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_updateImage($json_decode[$i], "visible = '1'");
        $re = $conexao->query($sql);

    }

    echo "1";
} else if($a == "deletarImagens") {

    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_deleteImage($json_decode[$i]);
        $re = $conexao->query($sql);

    }

    echo "1";
}