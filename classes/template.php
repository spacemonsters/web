<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 22.03.2017
 * Time: 12:11
 */
class template
{
    var $file = ''; // html faili malli nimi
    var $content = false; //html malli faili sisu
    var $vars = array(); //html malli vaade sisu
    //klassi konstruktor
    function __construct($f)
    {
        $this->file = $f; // määrame html malli nime
        $this->load_file();
    }
    //html malli faili lugemine
    function load_file(){
        $f = $this->file;
        if (!is_dir(TMPL_DIR)){
            echo 'Kataloogi '.TMPL_DIR.' ei leitud.<br>';
            exit;
        }
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->read_file($f);
        }
        $f = TMPL_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->read_file($f);
        }
        // .html laienduse eemaldamine
        $f = TMPL_DIR.$this->file.'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->read_file($f);
        }
        $f = TMPL_DIR.str_replace('.','/', '$this->file').'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->read_file($f);
        }
        if ($this->content===false) {
            echo 'Ei saanud sisu lugeda<br>';
        }
    }
    function read_file($f){
        $this->content = file_get_contents($f);
    }
    // koostame elementide paarid
    function set($name, $val) {
        $this->vars[$name] = $val;
    }
    function parse() {
        $str = $this->content;
        foreach ($this->vars as $name=>$val){
            $str=str_replace('{'.$name.'}', $val, $str);
        }
        return $str;
    }
}
function($name, $val) {
    if(!isset($this->vars[$name])){
        $this->set($name,$val);
    }
    else {
        $this->vars[$name] = $this->vars[$name].[$val];
    }
}
?>