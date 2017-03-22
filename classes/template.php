<?php

/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 22.03.2017
 * Time: 12:11
 */
class template
{//klassi algus
//template klassi omadused - muutujad
    var $file = ""; //html malli faili nimi
    var $content = false; //html faili sisu
    var $vars = array(); //html vaate sisu - reaalsed väärtused

    function construct($f){
        $this->file=$f;
        $this->loadFile();
    }
    //malli lugemis funktsioon
    function loadFile(){
        $f=$this->file; //lokaalne asendus
        if(!is_dir(TMPL_DIR)){
            echo "Kataloogi " .TMPL_DIR." ei ole leitud.</ br>";
                exit;
        }
        if(file_exists($f) and is_file($f) and is_readable($f)){
            //loome mallist faili sisu
            $this->readFile($f);
        }
        $f = TMPL_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)){
            //loome mallist faili sisu
            $this->readFile($f);
        }

        if($this->content === false){
            echo "Ei suutnud lugeda fili".$this->file."<br />";
        }

    }

    //loome sisu html malli failist
    function readFile($f){
        $this->content = file_get_contents($f);
    }//readFile lõpp
}//klassi lõpp
?>