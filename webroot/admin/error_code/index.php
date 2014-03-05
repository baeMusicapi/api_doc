<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$catgoryID = $_GET['category_id'];
$codeList = Lib_ErrorCode::getList($catgoryID);
$codeList = $codeList ? $codeList : array();
$errorCodeCategoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_ERROR);


foreach ($codeList as $index => &$one){
	$errorCodeID = $one['id'];
	$one['category'] = $errorCodeCategoryList[$one['category_id']]['title'];
	$one['operate'] = "<a href='/admin/error_code/update.php?error_code_id={$errorCodeID}' target='_blank'>修改</a>";
}

$thInfo = array(
		'code' => '错误码',
		'title' => '标题',
		'comment' => '简介',
		'category' => '分类',
		'operate' => '操作',
);


$htmlObj = new Html_Bootstrap_Table($codeList);
$htmlObj->setTableInfo($thInfo);
$tableHtml = $htmlObj->createHtml();


Template::Show();
