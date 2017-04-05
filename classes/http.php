<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 4.04.2017
 * Time: 22:17
 */
class http{
    var $vars = array();
    var $server = array();
    function __construct(){
        $this->init();
        $this->initCont();
    }
    function init(){
        $this->vars = array_merge($_GET, $_POST, $_FILES);
        $this->server = $_SERVER;
    }
    function initCont(){
        $consts = array('REMOTE_ADDR', 'HTTP_HOST', 'PHP_SELF', 'SCRIPT_NAME');
        foreach ($consts as $const){
            if(!defined($const) and isset($this->server[$const])){
                define($const, $this->server[$const]);
            }
        }
    }
}
