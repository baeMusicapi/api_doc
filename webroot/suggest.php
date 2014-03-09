<?php
include_once dirname(dirname(__FILE__)).'/app.php';
$env = Lib_System::getEnvData();


if($_POST){
	$title = $_POST['title'];
	$username = $_POST['username'];
	$contact = $_POST['contact'];
	$message = $_POST['message'];
	
	$suggestion = array(
		'title' => $title,
		'username' => $username,
		'contact' => $contact,
		'message' => $message,
	);
	
	$result = Lib_Suggestion::create($suggestion);
	if($result){
		Lib_System::SetNotice("创建成功!");
		Utility::Redirect("/suggest_suc.php");
	}
	
	Lib_System::SetError("创建失败啊,联系管理员吧,先看看啥问题 :".Lib_Suggestion::$error);
}



Template::Show();