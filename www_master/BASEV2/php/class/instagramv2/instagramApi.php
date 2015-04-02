<?php

namespace base\instagramv2;

class instagramApi {

    var $client_id = null;
    var $secret_id = null;
    var $hashtag = null;
    var $count = 20;


    function __construct($cId,$sId) {
        $this->setClientId($cId);
        $this->setSecretId($sId);
    }

    public function callInstagram($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getJsonImagens($url = "") {
        if($this->getHashtag()) {
            if($url == "") {
                $url_count = 'https://api.instagram.com/v1/tags/'.$this->getHashtag().'/media/recent?client_id='.$this->getClientId().'&count='.$this->getCount();
            } else { $url_count = $url; }
            $inst_stream = $this->callInstagram($url_count);
            $results = $inst_stream;
            // $results = json_decode($inst_stream, true);
            return $results;
        } else {
            return false;
        }
    }

    public function getJsonCount() {
        if($this->getHashtag()) {
            $url_count = 'https://api.instagram.com/v1/tags/'.$this->getHashtag().'/?client_id='.$this->getClientId().'';
            $inst_stream = $this->callInstagram($url_count);
            $results = $inst_stream;
            //$results = json_decode($inst_stream, true);
            return $results;
        } else {
            return false;
        }
    }

    public function decodeCountJson($results) {
        $results = json_decode($results, true);
        $saida = null;
        echo $results["data"]["media_count"];
    }

    public function decodeImagesJson($results) {
        $results = json_decode($results, true);
        $saida = null;
        foreach($results['data'] as $item){
            $image_link = $item['images']['low_resolution']["url"];
            $saida .= '<img src="'.$image_link.'" height="190" />';
        }
        echo $saida;
    }


    /**
     * @return null
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param null $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return null
     */
    public function getHashtag()
    {
        return $this->hashtag;
    }

    /**
     * @param null $hashtag
     */
    public function setHashtag($hashtag)
    {
        $this->hashtag = $hashtag;
    }

    /**
     * @return null
     */
    public function getSecretId()
    {
        return $this->secret_id;
    }

    /**
     * @param null $secret_id
     */
    public function setSecretId($secret_id)
    {
        $this->secret_id = $secret_id;
    }


}