<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$date = $_GET['date'];
$date = $_GET['date'] ? $_GET['date'] : date('Y-m-d');
$lastDate = date('Y-m-d',strtotime($date) - 86400);
$nextDate = date('Y-m-d',strtotime($date) + 86400);
$last10Date = date('Y-m-d',strtotime($date) - 10*86400);
$next10Date = date('Y-m-d',strtotime($date) + 10*86400);

$dataInfo = Lib_APICount::dailyCount($date);

$apiList = $dataInfo['api_list'];
$totalInfo = $dataInfo['total'];

foreach ($apiList as $index => $one){
	$one['name'] = "<a href='/admin/count/detail.php?music_api_id={$one['music_api_id']}' target='_blank'>{$one['name']}</a>";
	$apiList[$index] = $one;
}

$htmlObj = new Html_Bootstrap_Table($apiList);

$keyArray = array(
	'name' => '接口名',
	'pv' => 'PV',
	'average_time' => '平均访问时间',
	'total_average_rate' => '性能占比',
	'total_average_time' => '时间占比',
	'all_time' => '总访问时间',
);
$htmlObj->setTableInfo($keyArray);
$tableHtml = $htmlObj->createHtml();

Template::Show();