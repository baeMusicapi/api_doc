<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();
$interfaceID = $_REQUEST['interface_id'];

if($interfaceID){
	$interface = Lib_Interface::Fetch($interfaceID);
	if(!$interface){
		Lib_Admin::SetError("接口ID错误,找不到此ID接口");
		Utility::Redirect("/admin/openapi/index.php");
	}
	if($interface['type'] == Lib_Interface::TYPE_API){
		Utility::Redirect("/admin/interface/update.php?interface_id={$interfaceID}");
	}
}


$categoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_OPENAPI);


if($_POST){
	if($interface){
		$oldInterface = $interface;
	}
	$name = $_POST['name'];
	$title = $_POST['title'];
	$url = $_POST['url'];
	$introduction = $_POST['introduction'];
	$categoryID = $_POST['category_id'];
	$result = $_POST['result'];
	$errors = $_POST['error_codes'];
	$para = $_POST['para'];
	
	$parameters = array();
	foreach ($para as $index => $one){
		if($one['name']){
			$parameter = array(
				'name' => $one['name'],
				'comment' => $one['comment'],
				'must' => $one['must'],
				'default' => $one['default'],
			);
			$parameters[] = $parameter;
		}
	}
	
	$interface = array(
		'name' => $name,
		'title' => $title,
		'url' => $url,
		'introduction' => $introduction,
		'category_id' => $categoryID,
		'result' => $result,
		'error_codes' => $errors,
		'parameters' => $parameters,
		'type' => Lib_Interface::TYPE_OPEN_API,
	);
	
	if($oldInterface){
		$result = Lib_Interface::Update($oldInterface, $interface);
	} else {
		$interfaceID = Lib_Interface::Create($interface);
		$result = $interfaceID;
	}
	
	if($result){
		Lib_Admin::SetNotice("更新成功!!");
		Utility::Redirect("/admin/openapi/update.php?interface_id={$interfaceID}&success=1");
	} else {
		Lib_Admin::SetError("更新失败:".Lib_Interface::$error);
	}
}


Template::Show();