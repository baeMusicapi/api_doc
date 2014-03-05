<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
$env = Lib_System::getEnvData();

$interfaceID = $_GET['interface_id'];
$categoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_API);
$interface = Lib_Interface::Fetch($interfaceID);

if(!Util_Array::IsArrayValue($interface)){
	Lib_System::SetError("接口ID错误!请从正确路径访问~");
	Utility::Redirect("/");
}

/////////////category
$categoryList = Lib_Interface::getCategoryWithInterface();

////////////interface
foreach ($interface['parameters'] as &$parameter){
	$parameter['must'] = $parameter['must'] ? '是' : '否'; 
}

$thInfo = array(
	'name' => '参数名',
	'comment' => '说明',
	'must' => '是否必须',
	'default' => '默认值',
);

$htmlObj = new Html_Bootstrap_Table($interface['parameters']);
$htmlObj->setTableInfo($thInfo);
$htmlTable = $htmlObj->createHtml();



///////error
if($interface['error_codes']){
	$errorCodes = explode(',', $interface['error_codes']);
	$errorCodeInfos = Lib_ErrorCode::getInfos($errorCodes);
}

$errorHtmlObj = new Html_Bootstrap_Table($errorCodeInfos);
$thInfo = array(
		'code' => '错误码',
		'title' => '名字',
		'comment' => '说明',
);
$errorHtmlObj->setTableInfo($thInfo);
$errorHtmlTable = $errorHtmlObj->createHtml();



Template::Show();