<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 15.03.2017
 * Time: 15:25
 */
define('LIB_DIR', 'lib/');
define('CLASSES_DIR', 'classes/'); //clasess kataloogi konstant
define('TMPL_DIR', 'tmpl/'); //clasess kataloogi konstant
//Failide kasutusele võtmine
require_once LIB_DIR.'utils.php';
require_once CLASSES_DIR.'template.php';
require_once CLASSES_DIR.'http.php';
require_once CLASSES_DIR.'linkobjects.php';
$http = new linkobject();
echo $http->getlink(array('kasutaja'=>'nimi','pass'=>'parool'));
