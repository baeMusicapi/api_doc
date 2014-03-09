<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';

$env = Lib_System::getEnvData();


/////////////category
$categoryList = Lib_ErrorCode::getCategoryWithErrorCode();

$categoryID = $_GET['category_id'];

$errorCodeList = Lib_ErrorCode::GetList($categoryID);

foreach ($errorCodeList as &$errorCode){
	$errorCode['category'] = $categoryList[$errorCode['category_id']]['title'];
	$errorCode['tr_id'] = "error_code_id_{$errorCode['id']}";
}

$thInfo = array(
	'code' => 'code',
	'title' => '名字',
	'comment' => '简介',
	'category' => '分类',
);

$htmlObj = new Html_Bootstrap_Table($errorCodeList);
$htmlObj->setTableInfo($thInfo);
$htmlTable = $htmlObj->createHtml();



$categoryID = $categoryID ? $categoryID : -1;
Template::Show();