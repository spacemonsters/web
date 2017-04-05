<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 4.04.2017
 * Time: 22:21
 */
class linkobject extends http
{
    var $baseurl = false;
    var $delimiter = '&amp;';
    var $eq = '=';
    var $protocol = 'http://';
    function __construct()
    {
        parent::__construct(); //http konstruktor tuleb tööle
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }
    //andmete paari lisamine kujul: asi=väärtus&asi=väärtus
    function addtolink(&$link, $nimi, $val){
        if($link != ''){
            $link = $link.$this->delimiter;
        }
        $link = $link.fixurl($nimi).$this->eq.fixurl($val);
    }
    function getlink($add = array()){
        $link = '';
        foreach($add as $nimi=>$val){
            $this->addtolink($link, $nimi, $val);
        }
        if ($link!=''){
            $link=$this->baseurl.'?'.$link;
        }
        else{
            $link=$this->baseurl;
        }
        return $link;
    }
}