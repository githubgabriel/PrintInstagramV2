<?php

require "BASEV2/basev2.php";

getBaseV2("php");

getBaseV2("javascript");


use base\instagramv2\instagramv2;

$instagramv2 = new instagramv2();


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>InstagramV2</title>

    <link rel="stylesheet" href="css/site.css" type="text/css" />

    <? getPluginJS("Jquery"); ?>

    <? getPluginJS("BootStrap"); ?>


    <? getPluginJS("ToastMessage"); ?>

    <? include_JS("js/site.js"); ?>



</head>
<body>

<? $mi = "hashtag_listen"; require("require/menu.php");?>


<div class="container">


<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Ação <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">

        <li onclick="return ligarHashtag_selecionadas()"><a href="#">Ligar HashTag </a></li>
        <li onclick="return desligarHashtag_selecionadas()"><a href="#">Desligar HashTag </a></li>
        <li class="divider"></li>
        <li onclick="return deletarHashtag_selecionadas()"><a href="#">Deletar Hashtag </a></li>
    </ul>
</div>


    <button type="button" onclick="return new_hashtagListen();" class="btn btn-primary">Novo Registro</button>


    <script src="js/check.js"> </script>
    <script>

        $(function() {

            $("input#checkBtn").checkAllBox({ checkBoxDiv: "input[type=checkbox]", debug: true });

        });

    </script>
<table class="table" style="margin-top:15px;">
    <thead>
    <tr>
        <th width="25">  <input type="checkbox" id="checkBtn" name="check[]" value="1" />  </th>
        <th width="60">Id</th>
        <th width="220"># HashTag</th>
        <th width="120">Layout HTML</th>
        <th width="230">Data Inicio</th>
        <th width="140"> Qtd Imagens</th>
        <th width="150"> Cron Status </th>
    </tr>
    </thead>
    <tbody>

    </tbody>

</table>


    <script>

        hashtagListen_refresh();

    </script>


</div>

<? require "require/rodape.php"; ?>

<div class="modal fade" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novo Registro</h4>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">#Hashtag Nome</label>
                        <input type="text" class="form-control" name="hashtag">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Status Cron</label>
                        <select class="form-control" name="status">
                            <option value="1">Ligado</option>
                            <option value="0">Desligado</option>
                        </select>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" onclick="return new_hashtagListen_salvar();" class="btn btn-primary">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bs-example-modal-lg" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Layout Impressão</h4>
                <small class="modal-title">Este é o resultado final que irá ser impresso.</small>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <button type="button" onclick="return layout_preVisualizar(true);" class="btn btn-primary">Pré-Visualizar</button>
                        <br />
                        <br />
                        <b>Tags:</b> {{json_images_standard_resolution}} {{json_images_thumbnail}} {{hashtag}} {{json_user_full_name}} {{json_images_low_resolution}}
                       <input type="hidden" name="hashtagId_hidden" value="" />
                        <textarea style="margin-top:15px;" class="form-control" rows="15">


                            <!-- DEMO Layout PRINT -->
                                <div style="width:450px;background-color:black;min-height:200px;padding-top:20px;padding-bottom:20px;">
                                    <div style="width:350px;margin:0 auto;background-color:yellow;">

                                        <img src="http://www.instagramtakipcisiteleri.net/blog/upload/makale/ucretsiz-instagram-takipci-kasma-3557.png" width="100%" />

                                    </div>
                                    <div style="width:330px;font-size:22px; margin: 0 auto;padding-top:5px;color:white;"> {{hashtag}} </div>
                                    <div style="width:330px;margin: 0 auto; font-size:12px; padding-top:5px;color:white;"> {{json_user_username}} </div>
                                    <div style="width:330px;margin: 0 auto;font-size:11px;padding-top:5px;color:white;"> text Text texttexttexttext text text <br> text text text text </div>

                                    <div style="width:100%; margin-top:30px; text-align:center; font-size:10px; color:white;"> Criado By Gabriel A. Barbosa </div>
                                </div>
                            <!-- DEMO Layout PRINT -->

                        </textarea>
                    </div>
                </form>

                <div id="preView">
                    <button type="button" onclick="return layout_preVisualizar(false);" class="btn btn-primary">Editar</button>
                    <div id="html">

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" onclick="return modal_layoutImpressao_salvar();" class="btn btn-primary">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

</body>
</html>