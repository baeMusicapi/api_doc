<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$memObj = new Lib_Stats_Memcache();

$cacheInfoList = $memObj->getOnlineCacheInfo();


$showArray = array();
foreach ($cacheInfoList as $index => &$serverList){
	foreach ($serverList as $server => &$serverInfo){
		$serverInfo['bytes'] = @round( (doubleval($serverInfo['bytes']) / 1024)/1024,2);
		$serverInfo['limit_maxbytes'] = @round( (doubleval($serverInfo['limit_maxbytes']) / 1024) /1024,2);
		
		$serverInfo['bytes'] = $serverInfo['bytes'] . 'M';
		$serverInfo['limit_maxbytes'] = $serverInfo['limit_maxbytes'] .'M';
		$serverInfo['server'] = $server;
	}
	
	$htmlObj = new Html_Bootstrap_Table($serverList);
	$tdInfo = array(
		'server' => '服务器',
		'limit_maxbytes' => '最大缓存',
		'bytes' => '使用',
		'use_rate' => '使用率',
		'curr_items' => '存储数量',
		'hit_rate' => '命中率',
	);
	$htmlObj->setTableInfo($tdInfo);
	$showArray[$index] = $htmlObj->createHtml();
}

Template::Show();