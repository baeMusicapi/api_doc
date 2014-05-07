<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$key = $_GET['key'];
$runtime = $_GET['runtime'];
$action = $_GET['action'];


$libOnlineResult = new Lib_Stats_OnlineResult();

$runtimeArray = $runtime ? array($runtime) : array();

switch ($action){
	case 'show':
		$result = @$libOnlineResult->getCache($key,$runtimeArray);
		break;
	case 'del':
		$result = @$libOnlineResult->delCache($key,$runtimeArray);
		break;
	default:
		
		break;
}


$onlineConf = Config::Get('online');
$ipList = $onlineConf['ip_list'];
Template::Show();