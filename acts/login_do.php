<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 3.05.2017
 * Time: 11:12
 */
// võtame kätte vormi poolt edastatud andmed
$username = $http->get('kasutaja');
$passwd = $http->get('parool');
// koostame päringu kasutaja kontrollimiseks andmebaasis
$sql = 'SELECT * FROM user '.
    'WHERE username='.fixDb($username).
    ' AND password='.fixDb(md5($passwd));
$res = $db->getArray($sql);
// teeme päringu tulemuse kontroll
if($res == false){
    // loome veateade ja paneme selle sessiooni
    $sess->set('error', tr('Probleem sisselogimisega'));
    // siis tuleb suunata kasutaja sisselogimisvormi tagasi
    $link = $http->getLink(array('act' => 'login'));
    $http->redirect($link);
} else {
    // siis tuleb avada kasutajale sessioon
    $sess->createSession($res[0]);
    // tuleb suunata kasutaja pealehele
    // kus ma väljastan kasutajaandmed sessiooni kontrolliks
    $http->redirect();
}