<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 3.05.2017
 * Time: 11:13
 */
$sess->delSession(); // kustutame olemas olev sessioon
$http->redirect();// suuname pealehele
?>