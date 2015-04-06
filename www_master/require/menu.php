
<?


/* Verificando quantidade de Impressoras Online */
$sql = $instagramv2->cliente_selectImpressoras();
$re = $conexao->query($sql);
$qtd_impressoras_online = $re->rowCount();


/* Verificando quantidade de Requisicoes Impressoras */
$sql = $instagramv2->cliente_selectImpressorasRequisicoes();
$re = $conexao->query($sql);
$qtd_impressoras_req = $re->rowCount();

/* verifica quantidade de hashtag listen */
$sql = $instagramv2->hashtag_selectListens("status = '1'");
$re = $conexao->query($sql);
$qtd_hashtag_listen = $re->rowCount();


/* verifica quantidade de hashtag listen */
$sql = $instagramv2->hashtag_selectListens("status = '0'");
$re = $conexao->query($sql);
$qtd_hashtag_listen_inativo = $re->rowCount();


/* verifica quantidade de imagens */
$sql = $instagramv2->hashtag_selectImagens();
$re = $conexao->query($sql);
$qtd_imagens = $re->rowCount();



?>


<nav class="navbar navbar-inverse" style="position:fixed;top:0px;width:100%;z-index:999;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color:white;">InstagramV2</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
            <ul class="nav navbar-nav">
                <li class="<?=($mi=="home")?"active":null;?>"><a href="./index.php">Home </a></li>
                <li class="<?=($mi=="consulta_hashtag")?"active":null;?>"><a href="./consulta_hashtag.php">Consultar Hashtag </a></li>
                <li class="<?=($mi=="hashtag_listen")?"active":null;?>"><a href="./hashtag_listen.php"> Hashtag Listen <span class="badge"><?=$qtd_hashtag_listen?></span> </a></li>
                <li class="<?=($mi=="hashtag_imagens")?"active":null;?>"> <a href="./hashtag_imagens.php">Hashtag Imagens </a></li>
                <li class="<?=($mi=="impressoras_online")?"active":null;?>"><a href="./impressoras_online.php"> Impressoras Online <span class="badge"><?=$qtd_impressoras_online?></span></a></li>
                <li class="<?=($mi=="impressoras_requisicoes")?"active":null;?>"> <a href="./impressoras_requisicoes.php">Impressoras Requisições <span class="badge"><?=$qtd_impressoras_req?></span></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
