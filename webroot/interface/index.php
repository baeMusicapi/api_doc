<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';

$env = Lib_System::getEnvData();



$categoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_API);

$categoryID = $_GET['category_id'];

$interfaceList = Lib_Interface::getList($categoryID);

foreach ($interfaceList as &$interface){
	$interfaceID = $interface['id'];
	$interface['category'] = $categoryList[$interface['category_id']]['title'];
	$interface['create_time'] = date('Y-m-d H:i:s',$interface['create_time']);
	$interface['operate'] = "
	<a href='/interface/info.php?interface_id={$interfaceID}' target='_blank'> 详情</a>";
}

$thInfo = array(
		'name' => '接口',
		'title' => '名字',
		'create_time' => '创建时间',
		'category' => '分类',
		'operate' => '操作',
);

$htmlObj = new Html_Bootstrap_Table($interfaceList);
$htmlObj->setTableInfo($thInfo);

$tableHtml = $htmlObj->createHtml();

Template::Show();