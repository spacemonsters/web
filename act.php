<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 5.04.2017
 * Time: 10:44
 */
$act = $http->get('act'); // küsime hetkel valitud tegevus
// koostame otsitava faili nimi - failisüsteemi jaoks
$fn = ACTS_DIR.str_replace('.', '/', $act).'.php';
// kui selline fail olemas ja lugemiseks lubatud
if(file_exists($fn) and is_file($fn) and is_readable($fn)){
    // loeme sisu
    require_once $fn;
} else {
    $fn = ACTS_DIR.DEFAULT_ACT.'.php'; // koostame vaikimisi oleva faili nimi
    $http->set('act', DEFAULT_ACT); // paneme act väärtuseks default - act=default
    require_once $fn;
}