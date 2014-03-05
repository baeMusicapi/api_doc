<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();
$tagList = Lib_Tag::getList();
$tagList = $tagList ? $tagList : array();

foreach ($tagList as $index => &$one){
	$tagID = $one['id'];
	$one['operate'] = "<a href='/admin/tag/update.php?tag_id={$tagID}' target='_blank'>修改</a>";
}

$thInfo = array(
	'id' => 'id',
	'name' => '名称',
	'operate' => '操作',
);


$htmlObj = new Html_Bootstrap_Table($tagList);
$htmlObj->setTableInfo($thInfo);
$tableHtml = $htmlObj->createHtml();

Template::Show();