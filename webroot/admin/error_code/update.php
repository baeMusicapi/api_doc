<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$errorCodeCategoryList  =  Lib_Category::getCategoryList(Lib_Category::TYPE_ERROR);

$errorCodeID = $_REQUEST['error_code_id'];
if($errorCodeID){
	$errorCode = Lib_ErrorCode::Fetch($errorCodeID);
	if(!$errorCode){
		Lib_Admin::SetError("错误的Error Code ID!");
		Utility::Redirect("/admin/error_code/index.php");
	}
}

if($_POST){
	$code = $_POST['code'];
	$title = $_POST['title'];
	$categoryID = $_POST['category_id'];
	$comment = $_POST['comment'];
	
	if($errorCode){
		$oldErrorCode = $errorCode;
	}
	
	$errorCode = array(
		'code' => $code,
		'title' => $title,
		'category_id' => intval($categoryID),
		'comment' => $comment,
	);
	
	if($oldErrorCode){
		$result = Lib_ErrorCode::Update($oldErrorCode, $errorCode);
	} else {
		$errorCodeID = Lib_ErrorCode::Create($errorCode);
		$result = $errorCodeID;
	}
	
	if($result){
		Lib_Admin::SetNotice("Error Code 更新成功!!!");
		Utility::Redirect("/admin/error_code/update.php?error_code_id={$errorCodeID}&success=1");
	} else {
		Lib_Admin::SetError("更新失败:".Lib_ErrorCode::$error);
	}
}

Template::Show();