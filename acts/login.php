<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 3.05.2017
 * Time: 11:11
 */
// loome sisselogimisvormi objekti
$login = new template('login');
$error = $sess->get('error');
$login->set('error', $error);
// paneme reaalsed väärtused template elementidele
$login->set('kasutajanimi', tr('Kasutaja'));
$login->set('parool', tr('Parool'));
$login->set('nupp', tr('Logi sisse'));
// loome lingi sisselogimisvormi töötlusele
$link = $http->getLink(array('act' => 'login_do'));
$login->set('link', $link);
// paneme sisu template sisse
$main_tmpl->set('content', $login->parse());