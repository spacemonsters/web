<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 15.03.2017
 * Time: 14:15
 */
//võtame konfiguratsiooni kasutusele
require_once "conf.php";
//pealehe sisu
echo "<h1>Hello fleshy mammals</h1>";
//valmistame pea malli/template
$main_tmpl = new template(TMPL_DIR."main.html");
//koostatud objekti kontrollimine
echo "<pre>";
print_r($main_tmpl);
echo "</pre>";
?>