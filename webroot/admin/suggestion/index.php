<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();


$suggestionList = Lib_Suggestion::getList();
//dump($suggestionList);


foreach ($suggestionList as &$suggestion){
	$suggestion['create_time'] = date('Y-m-d H:i:s',$suggestion['create_time']);
	$suggestion['operate'] = "<a href='/admin/suggestion/info.php?suggestion_id={$suggestion['id']}'>详情</a>";
}


$thInfo = array(
	'title' => '标题',
	'username' => '提交人',
	'create_time' => '提交时间',
	'operate' => '操作',
);

$htmlObj = new Html_Bootstrap_Table($suggestionList);
$htmlObj->setTableInfo($thInfo);
$tableHtml = $htmlObj->createHtml();

Template::Show();