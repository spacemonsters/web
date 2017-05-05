<?php
/**
 * Created by PhpStorm.
 * User: anna.karutina
 * Date: 12.04.2017
 * Time: 11:51
 */
// loome keele elementide eraldaja
$sep = new template('lang.sep');
$sep = $sep->parse();
$count = 0;
// väljastame kõik olemasolevad keeled
foreach ($siteLangs as $lang_id=>$lang_name){
	$count++;
	// paneme keele id järgi aktiivne element
	if($lang_id == LANG_ID){
		$item = new template('lang.active');
	} else {
		$item = new template('lang.item');
	}
	// koostame keele riba väljund
	$link = $http->getLink(array('lang_id'=>$lang_id), array('act', 'page_id'), array('lang_id'));
	$item->set('link', $link);
	$item->set('name', tr($lang_name));
	$main_tmpl->add('lang_bar', $item->parse());

	if($count < count($siteLangs)){
		$main_tmpl->add('lang_bar', $sep);
	}
}