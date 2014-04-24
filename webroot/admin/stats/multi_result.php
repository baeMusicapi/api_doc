<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$url = $_GET['url'];
$runtime = $_GET['runtime'];


$libOnlineResult = new Lib_Stats_OnlineResult();

if($url){
	if($runtime){
		$runtimeArray = array($runtime);
	} else {
		$runtimeArray = array();
	}
	$result = @$libOnlineResult->getResult($url,$runtimeArray);
}

$onlineConf = Config::Get('online');
$ipList = $onlineConf['ip_list'];

Template::Show();