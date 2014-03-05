<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();
$categoryTypes = Lib_Category::getTypesInfo();

$type = $_GET['type'];
$categoryList = Lib_Category::getCategoryList($type);

foreach ($categoryList as $index => &$one){
	$categoryID = $one['id'];
	$one['operate'] = "<a href='/admin/category/update.php?category_id={$categoryID}' target='_blank'>修改</a>";
	$one['type'] = $categoryTypes[$one['type']]['name'];
}

$thInfo = array(
	'id' => 'id',
	'name' => '名称',
	'title' => 'title',
	'type' => '错误类型',
	'operate' => '操作',
);


$htmlObj = new Html_Bootstrap_Table($categoryList);
$htmlObj->setTableInfo($thInfo);
$tableHtml = $htmlObj->createHtml();

Template::Show();