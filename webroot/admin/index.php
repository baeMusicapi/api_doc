<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$interfaceStatis = Lib_Interface::GetStatis();

$categoryList = Lib_Category::getCategoryList();

foreach ($categoryList as $index => $one){
	$typeStr = '';
	switch ($one['type']){
		case Lib_Category::TYPE_API:
			$typeStr = '[API]';
			break;
		case Lib_Category::TYPE_ERROR:
			$typeStr = "[ERROR]";
			break;
		case Lib_Category::TYPE_OPENAPI:
			$typeStr = "[OPENAPI]";
			break;
	}
	$showTitle = "{$typeStr}{$one['name']} {$one['title']}";
	$categoryList[$index]['show_title'] = $showTitle;
}
		
Template::Show();