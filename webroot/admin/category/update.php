<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$categoryID = $_REQUEST['category_id'];

if($categoryID){
	$category = Lib_Category::Fetch($categoryID);
	if(!Util_Array::IsArrayValue($category)){
		$error = Lib_Admin::GetError(false);
		Utility::Redirect("/admin/category/index.php");
	}
}

$categoryTypes = Lib_Category::getTypesInfo();

if($_POST){
	$name = $_POST['name'];
	$title = $_POST['title'];
	$type = $_POST['type'];
	
	if($category){
		$oldCategory = $category;
	}
	
	$category = array(
		'name' => $name,
		'title' => $title,
		'type' => $type,
	);
	
	if($oldCategory){
		$result  = Lib_Category::Update($oldCategory, $category);
	} else {
		$result = Lib_Category::Create($category);
		$categoryID = $result;
	}
	
	if(!$result){
		Lib_Admin::SetError("更新失败:".Lib_Category::$error);
	} else {
		Lib_Admin::SetNotice("更新成功!!");
		Utility::Redirect("/admin/category/update.php?category_id={$categoryID}&success=1");
	}
}



Template::Show();