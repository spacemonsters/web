<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 5.04.2017
 * Time: 8:48
 */
function fixUrl($val){
    return urlencode($val);
}
function fixDb($val){
    return'"'.addslashes($val).'"';
}
