<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 5.04.2017
 * Time: 10:45
 */
// loome menüü mallide objektid
$menu = new template('menu.menu');
$item = new template('menu.item');
// lisame sisu
$sql='select content_id,title from content where'.
    'parent_id='.fixDb(0).'and show in_menu'.fixDb(1);
$res=$db->getArray($sql);
if($res != false){
    foreach ($res as $page){
        $item->set("name", $page["title"]);
        $link=$http->getLink(array("page_id"=>$page["content_id"]));
        $item->set("link", $link);
        $item->add("items", $item->parse());
    }
}
// nimetame menüüs väljastav element
// loome antud menüü elemendile lingi
// lisame antud link menüüsse
// lisame valmis link menüü objekti sisse
//
$item->set('name', 'teine');
$link = $http->getLink(array('act'=>'second'));
$item->set('link', $link);
$menu->add('items', $item->parse());
// kontrollime objekti olemasolu ja sisu
// kui soovime pidevat asendamist, siis set funktsioon add asemel
$main_tmpl->add('menu', $menu->parse());
