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

$a = $_REQUEST["acao"];

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

            $saida_hash = "";
            $hashing = explode(",",$row->hashtag);
            foreach($hashing as $hashi) {
                $saida_hash .= "#".$hashi." ";
            }

        ?>

        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" onclick="return checkImage(this);event.cancelBubble=true;" style="position:relative;">
            <input type="checkbox" id="check" name="check[]" value="<?=$row->id?>" />
            <a href="#" class="thumbnail" style="height:160px">
                <img class="img-responsive" src="<?=$row->json_images_thumbnail?>">
            </a>
       <? if(!$row->visible) { ?>
            <div class="image_blocked" style="padding-top:20px;padding-bottom:20px;">BLOQUEADO</div>
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
else if($a == "ligarHashtag_selecionadas") {

    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_update($json_decode[$i], "status = '1'");
        $re = $conexao->query($sql);

    }

    echo "1";

}
else if($a == "desligarHashtag_selecionadas") {


    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_update($json_decode[$i], "status = '0'");
        $re = $conexao->query($sql);

    }

    echo "1";

} else if($a == "deletarHashtag_selecionadas") {


    $json = $_GET["json"];
    $json_decode = json_decode($json, true);

    for($i=0;$i<count($json_decode);$i++) {

        $sql = $instagramv2->hashtag_delete($json_decode[$i]);
        $re = $conexao->query($sql);

    }

    echo "1";

} else if($a == "refreshHashtagListen") {


    $sql = $instagramv2->hashtag_selectListens("","status desc");
    $re = $conexao->query($sql);

    if(!$re->rowCount()) {
        ?>  <tr class="success">
            <td align="center" colspan="7">  <b style="color:green;">Nenhuma HashTag registrada.</b> </td>
        </tr> <?
    }

    while($row = $re->fetchObject()) {

        /* pega quantidade de fotos obtidas ..*/
        $sql = $instagramv2->hashtag_selectImagens($row->id);
        $re2 = $conexao->query($sql);

        if($row->status == "1") {
            $row->status = "Ligado"; $color = "green"; $class = "success";
        } else {
            $row->status = "Desligado"; $color = "red"; $class = "danger";
        }

        if(!$row->datetime_fim) { $row->datetime_fim = " -- "; }

        ?>

        <tr class="<?=$class?>">
            <th> <input type="checkbox" id="check" name="check[]" value="<?=$row->id;?>" /></th>
            <th scope="row"><?=$row->id;?></th>
            <td><a href="consulta_hashtag.php?hashtag=<?=$row->hashtag;?>">#<?=$row->hashtag;?></a></td>
            <td align="center">
                <button type="button" onclick="return modal_layoutImpressao(<?=$row->id;?>);" class="btn btn-info">Layout</button>
</td>
            <td><?=$row->datetime_inicio;?></td>
            <td align="center"> <a href="hashtag_imagens.php?hashtag=<?=$row->hashtag;?>"><?=$re2->rowCount();?></a> </td>
            <td align="center">  <b style="color:<?=$color?>;"><?=$row->status;?></b> </td>
        </tr>


    <?
    }
} else if($a == "impressoraRequisicoes_refresh") {


    $sql = $instagramv2->cliente_selectImpressorasRequisicoes("*, hashtag_impressoras_pedido.id as hashtag_pedido_id,hashtag_impressoras_pedido.status as impressora_status, hashtag_listen.status as hashtag_status", "hashtag_listen ON hashtag_id = hashtag_listen.id INNER JOIN hashtag_impressoras_online ON impressoras_id = hashtag_impressoras_online.id INNER JOIN hashtag_imagens ON imagens_id = hashtag_imagens.id", "impressora_status asc");

    $re = $conexao->query($sql);

    if(!$re->rowCount()) {
        ?>  <tr class="success">
            <td align="center" colspan="7">  <b style="color:green;">Nenhuma requisição registrada.</b> </td>
        </tr> <?
    }

    while($row = $re->fetchObject()) {


        if($row->impressora_status == "0") {
            $row->impressora_status = "Aguardando na Fila..."; $color = "gray"; $class = "success";
            $row->impressora_nome = "<b>".$row->impressora_nome."</b>";
        } else if($row->impressora_status == "1") {
            $row->impressora_status = "Impressão OK :D"; $color = "green"; $class = "active";
        }else if($row->impressora_status == "-1") {
            $row->impressora_status = "Imprimindo..."; $color = "orange"; $class = "info";
        }else {
            $row->impressora_status = "Erro ao Imprimir"; $color = "red"; $class = "active";
        }

        if(!$row->time) { $row->time = " --- ";}

        ?>


        <tr class="<?=$class?>">
            <th style="vertical-align: middle;" scope="row"><?=$row->hashtag_pedido_id?></th>
            <td style="vertical-align: middle;" ><?=$row->impressora_nome;?> <span class="badge"> #<?=$row->hashtag;?> </span></td>
            <td style="vertical-align: middle;">

                <img src="<?=$row->json_images_low_resolution;?>" width="50" class="img-thumbnail">

            </td>
            <td style="vertical-align: middle;"><?=$row->time?></td>
            <td align="center" style="vertical-align: middle;">  <b style="color:<?=$color?>;"><?=$row->impressora_status;?></b> </td>

        </tr>


    <?
    }
} else if($a == "modal_layoutImpressao") {

    $id = $_REQUEST["hashtag_id"];
    $sql = $instagramv2->hashtag_selectListens("id = '$id'","");

    $re = $conexao->query($sql);
    $html = $re->fetchObject();

    $html_final = ($html->layout_impressao_html);

    echo $html_final;

} else if($a == "modal_layoutImpressao_salvar") {

    $html = $_REQUEST["html"];
    $id = $_REQUEST["hashtag_id"];

    $sql = $instagramv2->hashtag_update($id, "layout_impressao_html = '".$html."'");

    $re = $conexao->query($sql);

    echo "1";

}else if($a == "new_hashtagListen_salvar") {

    $hashtag = $_REQUEST["hashtag"];
    $status = $_REQUEST["status"];

    $sql = $instagramv2->hashtag_insert("(hashtag, datetime_inicio, status)", "('".$hashtag."', NOW(), ".$status.")");

    $re = $conexao->query($sql);

    echo "1";

}