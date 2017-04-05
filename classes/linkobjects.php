<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 4.04.2017
 * Time: 22:21
 */
class linkobject extends http
{// klassi algus
    // klassi muutujad - omadused
    var $baseUrl = false;
    var $delim = '&amp;';
    var $eq = '=';
    var $protocol = 'http://';
    // klassi meetodid
    // klassi konstruktor
    function __construct(){
        parent::__construct(); // kutsume tööle http konstruktor
        // loome põhilink
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }// konstruktor

    // andmete paari koostamine kujul
    // nimi=väärtus&nimi1=väärtus1 jne
    function addToLink(&$link, $name, $val){
        if($link != ''){
            $link = $link.$this->delim;
        }
        $link = $link.fixUrl($name).$this->eq.fixUrl($val);
    }// addToLink
    // saame täislink valmis
    function getLink($add = array()){
        $link = '';
        foreach($add as $name=>$val){
            $this->addToLink($link, $name, $val);
        }
        if($link != ''){
            $link = $this->baseUrl.'?'.$link;
        } else {
            $link = $this->baseUrl;
        }
        return $link;
    }// getLink
}// klassi lõpp