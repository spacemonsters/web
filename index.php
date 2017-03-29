<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 15.03.2017
 * Time: 14:15
 */
require_once 'conf.php';
echo '<h1>Programmeerimise esileht</h1>';
$main_tmpl = new template('main.html');
//echo '<pre>';
print_r($main_tmpl);
$main_tmpl->set('user', 'Kasutajanimi');
$main_tmpl->set('title', 'Pealeht');
$main_tmpl->set('lang_bar', 'Keeleriba');
$main_tmpl->set('menu','Peamenüü' );
$main_tmpl->set('content', 'lehe sisu');
$main_tmpl->set('site_title', 'Veebiprogemise kursus');
echo $main_tmpl->parse();
//echo '</pre>';
?>
