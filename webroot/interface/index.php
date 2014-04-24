<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';

$env = Lib_System::getEnvData();


/////////////category
$categoryList = Lib_Interface::getCategoryWithInterface();

$categoryID = $_GET['category_id'];

$interfaceList  = Lib_Interface::getList($categoryID);
//dump($categoryList);
foreach ($interfaceList as &$interface){
	$interface['category'] = $categoryList[$interface['category_id']]['name'];
	$interface['operate'] = "<a href='/interface/info.php?interface_id={$interface['id']}' target='_blank'>详情</a>";
}

$thInfo = array(
	'name' => '接口',
	'title' => '名字',
	'category' => '分类',
	'operate' => '操作',
);

$htmlObj = new Html_Bootstrap_Table($interfaceList);
$htmlObj->setTableInfo($thInfo);
$htmlTable = $htmlObj->createHtml();


$categoryID = $categoryID ? $categoryID : -1;
Template::Show();