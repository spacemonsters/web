<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 15.03.2017
 * Time: 14:15
 */
require_once 'conf.php';
echo'<h1>Esileht</h1>';
//valmistame template objekti
$main_tmpl = new template('template');
$main_tmpl->set('user', 'Kasutajanimi');
$main_tmpl->set('title', 'Pealeht');
$main_tmpl->set('lang_bar', 'Keeleriba');
$main_tmpl->set('menu', 'Menüü');
$main_tmpl->set('content', 'Sisu');
$main_tmpl->set('site_title', 'Veebi');
//kontrollime objekti sisu
echo $main_tmpl->parse();
//require_once 'menu.php';
