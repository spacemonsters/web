<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 4.04.2017
 * Time: 22:17
 */
class http
{// klassi algus
    // klassi muutujad
    var $vars = array(); // http päringute andmed
    var $server = array(); // serveri (masina) andmed
    // klassi meetodid
    // klassi konstruktor
    function __construct(){
        $this->init();
        $this->initCont();
    }
    // paneme algandmed paika - initsialiseerime neid
    function init(){
        $this->vars = array_merge($_GET, $_POST, $_FILES);
        $this->server = $_SERVER;
    }// init
    //defineerime vajalikud konstandid
    function initCont(){
        $consts = array('REMOTE_ADDR', 'HTTP_HOST', 'PHP_SELF', 'SCRIPT_NAME');
        foreach ($consts as $const){
            if(!defined($const) and isset($this->server[$const])){
                define($const, $this->server[$const]);
            }
        }
    }// initConst
    // saame kätte veebis olevad andmed - nagu $_POST või $_GET - emulatsioon
    // tegelikult need andmed on lingi kaudu saadud
    function get($name){
        // kui vastava nimega element eksisteerib andmete massiivis
        if($this->vars[$name]){
            // tagastame selle väärtus
            return $this->vars[$name];
        }
        // muidu tagastame tühi väärtus
        return false;
    }// get
    // lisame vajalikud väärtused veebi kujul nimi=väärtus
    function set($name, $val){
        $this->vars[$name] = $val;
    }// set
    // eemaldame ebavajalikud andmed veebist
    function del($name){
        if(isset($this->vars[$name])){
            unset($this->vars[$name]);
        }
    }// del
    // suunamine
    function redirect($url = false){
        global $sess;
        $sess->flush();
        // kui $url on false - pealehele
        if($url == false){
            $url = $this->getLink();
        }
        $url = str_replace('&amp;', '&', $url);
        header('Location: '.$url);
        exit;
    }// redirect
}// klassi lõpp
?>