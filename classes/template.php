<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 22.03.2017
 * Time: 12:11
 */
class template
{
    var $file = '';
    var $content = false;
    var $vars = array();
    function __construct($f){
        $this->file=$f;
        $this->loadFile();
    }
    function loadFile(){
        $f = $this->file;
        if(!is_dir(TMPL_DIR)){
            echo 'Kataloogi '.TMPL_DIR.'ei ole leitud.<br>';
            exit;
        }
        if (file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        $f = TMPL_DIR.$this->file;
        if (file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        $f = TMPL_DIR.$this->file.'.html';
        if (file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        $f = TMPL_DIR.str_replace('.','/', $this->file).'.html';
        if (file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        if ($this->content === false){
            echo 'Ei suutnud lugeda failis '.$this->file.'<br>';
        }
    }
    function readFile($f){
        $this->content = file_get_contents($f);
    }
    function set($name, $val){
        $this->vars[$name] = $val;
    }// set
    function add($name, $val){
        if(!isset($this->vars[$name])){
            $this->set($name, $val);
        }else{
            $this->vars[$name] = $this->vars[$name],$val;
        }
    }
    function parse(){
        $str = $this->content;
        foreach ($this->vars as $name=>$val){
            $str = str_replace('{'.$name.'}', $val, $str);
        }
        // return template content with real values
        return $str;
    }// parse
}
?>