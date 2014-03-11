<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$suggestionID = $_GET['suggestion_id'];

$suggestion = Lib_Suggestion::fetch($suggestionID);

if(!Util_Array::IsArrayValue($suggestion)){
	Lib_Admin::SetError("找不到对应的数据");
	Utility::Redirect('/admin/suggestion/index.php');
}


$suggestion['create_time'] = date('Y-m-d H:i:s',$suggestion['create_time']);

Template::Show();