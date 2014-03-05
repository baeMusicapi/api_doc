<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$tagID = $_REQUEST['tag_id'];

if($tagID){
	$tag = Lib_Tag::Fetch($tagID);
	if(!Util_Array::IsArrayValue($tag)){
		$error = Lib_Admin::SetError("Tag ID 错误");
		Utility::Redirect("/admin/tag/index.php");
	}
}


if($_POST){
	$name = $_POST['name'];
	
	if($tag){
		$oldTag = $tag;
	}
	
	$tag = array(
		'name' => $name,
	);
	
	if($oldTag){
		$result  = Lib_Tag::Update($oldTag, $tag);
	} else {
		$result = Lib_Tag::Create($tag);
		$tagID = $result;
	}
	
	if(!$result){
		Lib_Admin::SetError("更新失败:".Lib_Tag::$error);
	} else {
		Lib_Admin::SetNotice("更新成功!!");
		Utility::Redirect("/admin/tag/update.php?tag_id={$tagID}&success=1");
	}
}



Template::Show();