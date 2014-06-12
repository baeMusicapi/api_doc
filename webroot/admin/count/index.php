<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$totalData = Lib_APICount::totalCount();

foreach ($totalData as $index => $one){
	$one['operate'] = "<a href='/admin/count/daily.php?date={$one['count_date']}' target='_blank'>详情</a>";
	$totalData[$index] = $one;
}

$keyArray = array(
		'count_date' => '日期',
		'average_time' => '平均时间',
		'pv' => 'pv',
		'all_time' => '总响应时间',
		'operate' => '操作',
);

$htmlObj = new Html_Bootstrap_Table($totalData);
$htmlObj->setTableInfo($keyArray);

$tableHtml = $htmlObj->createHtml();

Template::Show();