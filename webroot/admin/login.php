<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
$loginUser = Lib_Admin::GetLoginUser();

if($_POST){
	$name = $_POST['name'];
	$pwd = $_POST['pwd'];
	$remember = $_POST['remember'] ? true : false;
	$loginUser = Lib_Admin::Login($name, $pwd,$remember);
	if(!$loginUser){
		Lib_Admin::SetError("用户名密码错误");
	}
}

if($loginUser){
	Utility::Redirect("/admin/index.php");
}

Template::Show();