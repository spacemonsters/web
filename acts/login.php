<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 3.05.2017
 * Time: 11:11
 */
$login = new template('login');
$error = $sess->get('error');
$login->set('error', $error);
// paneme reaalsed väärtused template elementidele
$login->set('kasutajanimi', 'Kasutaja');
$login->set('parool', 'Parool');
$login->set('nupp', 'Logi sisse');
// loome link sisselogimisvormi töötlusele
$link = $http->getLink(array('act' => 'login_do'));
$login->set('link', $link);
// paneme sisu template sisse
$main_tmpl->set('content', $login->parse());