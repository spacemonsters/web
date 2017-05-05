<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 5.04.2017
 * Time: 10:40
 */
$page_id = $http->get('page_id');
echo $page_id;
$sql = 'SELECT * FROM content WHERE '.'content_id='.fixDb($page_id);
$res = $db->getArray($sql);
if($res === false){
    $sql = 'SELECT * FROM content WHERE '.'content_id='.fixDb(1);
    $res = $db->getArray($sql);
}
if($res !== false){
    $page = $res[0];
    $http->set('page_id', $page['content_id']);
    $main_tmpl->set('content',$page['content']);
}
$main_tmpl->set('content', 'Lehe sisu');
?>