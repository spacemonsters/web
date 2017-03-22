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
    //loome sisu html malli failist
    function readFile($f){
        $this->content = file_get_contents($f);
    }//readFile
}//klassi lõpp
?>