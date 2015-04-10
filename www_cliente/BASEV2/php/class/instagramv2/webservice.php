<?php
namespace base\instagramv2;

class webservice
{

    var $_path = "/2015/GABRIEL/Pessoal/InstagramV2/www_master/webservice/";


    public function checkWebService()
    {
        if ($_SESSION["SERVER_MASTER"]) {
            $rs = $this->getCurl("http://" . $_SESSION["SERVER_MASTER"] . $this->_path . "index.php?senha=senha1313");
            if ($rs) {
                return "1";
            }
        }
        return "0";
    }

    public function impressoraUpdateStatus()
    {
        if ($_SESSION["IMPRESSORA_NOME"]) {
            $rs = $this->getCurl("http://" . $_SESSION["SERVER_MASTER"] . $this->_path . "terminal_cliente/impressoraUpdateStatus.php?impressora_nome=" . $_SESSION["IMPRESSORA_NOME"] . "&senha=senha1313");
            return $rs;
        }

    }


    public function getJsonRequisicoes()
    {
        if ($_SESSION["IMPRESSORA_NOME"]) {
            $rs = $this->getCurl("http://" . $_SESSION["SERVER_MASTER"] . $this->_path . "terminal_cliente/getRequisicoes.php?impressora_nome=" . $_SESSION["IMPRESSORA_NOME"] . "&senha=senha1313");
            return $rs;
        }

    }

    public function requisicaoUpdateStatus($id,$novoStatus)
    {
            $rs = $this->getCurl("http://" . $_SESSION["SERVER_MASTER"] . $this->_path . "terminal_cliente/requisicaoUpdateStatus.php?id=" . $id . "&status=" . $novoStatus . "&senha=senha1313");
            return $rs;
    }

    public function getCurl($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_CONNECTTIMEOUT => 2
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }


}