<div id="rodape">

    <div class="container">
        <?php

                if($_SESSION["IMPRESSORA_NOME"]) {
                    echo "IMPRESSORA NOME: <b>" . $_SESSION["IMPRESSORA_NOME"] . "</b><br/>";
                }

            echo "MEU IP: ".getIPByHost("gabrielbarbosa.local");
            echo "<br>";
            if($_SESSION["SERVER_MASTER"]) {

                if(ping($_SESSION["SERVER_MASTER"])) {
                    $color = "greenyellow";
                    $ping_msg = "connectado!";
                } else {
                    $color = "red";
                    $ping_msg = "Fail!";
                }

                echo "CONNECTADO SERVER IP: <b style='color:".$color."'>" . $_SESSION["SERVER_MASTER"]." - $ping_msg</b>";

            } else {
                echo "Sem conexão com servidor master";
            }
        ?>
    </div>

    </div>