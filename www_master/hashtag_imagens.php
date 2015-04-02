<?php

require "BASEV2/basev2.php";

getBaseV2("php");

getBaseV2("javascript");


use base\instagramv2\instagramv2;


?>
<html>
<head>
    <meta charset="UTF-8">

    <title>InstagramV2</title>

    <link rel="stylesheet" href="css/site.css" type="text/css" />

    <? getPluginJS("Jquery"); ?>


    <? getPluginJS("BootStrap"); ?>


    <? getPluginJS("Chosen"); ?>

    <? include_JS("js/site.js"); ?>



</head>
<body>

<? $mi = "hashtag_imagens"; require("require/menu.php");?>


<div class="container">


<form style="max-width: 500px;">
<div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Selecione #Hashtag</label>
                <select name="select_hash" class="form-control">
                    <option>#Dilma</option>
                    <option>#Cocacola</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <button type="submit" style="margin-top:20px;" class="btn btn-default">Enviar</button>
        </div>
    </div>
</form>



<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Ação <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#">Bloquear Imagem </a></li>
        <li><a href="#">Pausar Impressão</a></li>
        <li class="divider"></li>
        <li><a href="#">Remover Impressão</a></li>
    </ul>
</div>


<ul class="row" id="imagem_box">
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" style="position:relative;">
        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-174908-rocking-the-night-away-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-287182-blah-blah-blah-yellow-road-sign-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-460760-colors-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" style="position:relative;">
        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-174908-rocking-the-night-away-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-287182-blah-blah-blah-yellow-road-sign-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-460760-colors-xs.jpg">
        </a>
    </li><li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" style="position:relative;">
        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-174908-rocking-the-night-away-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-287182-blah-blah-blah-yellow-road-sign-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-460760-colors-xs.jpg">
        </a>
    </li><li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" style="position:relative;">
        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-174908-rocking-the-night-away-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-287182-blah-blah-blah-yellow-road-sign-xs.jpg">
        </a>
    </li>
    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">

        <input type="checkbox" id="check" name="check[]" value="1" />
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="http://demo.fearlessflyer.com/html/demo/bootstrap-photo-gallery/images/photodune-460760-colors-xs.jpg">
        </a>
    </li>
</ul>

    </div>

<script> $("select").chosen(); </script>

<? require "require/rodape.php"; ?>
</body>
</html>