<?php
class Lib_Stats_OnlineResult{
	public static $ipList = array();
	
	public function __construct(){
		$onlineConf = Config::Get('online');
		self::$ipList = $onlineConf['ip_list'];
	}
	
	public function getResult($url,$runtime = array()){
		$keyWord = 'baidu.com';
		$pos = strpos($url, $keyWord);
		if($pos !== false){
			$url = substr($url, $pos+strlen($keyWord));
		}
		$host = "tingapi.ting.baidu.com";
		$header = array("Host:{$host}");
		
		$resultList = array();
		foreach (self::$ipList as $rt => $list){
			if(!$runtime || in_array($rt, $runtime)){
				foreach ($list as $ip){
					$currentUrl = "http://$ip:8888{$url}";
					$result = Util_HttpRequest::Get($currentUrl,array(),$header);
					$resultMD5 = md5($result);
					$result = json_decode($result,true);
					$resultList[$resultMD5]['data'] = $result;
					$resultList[$resultMD5]['server'][] = $rt . $ip;
				}
			}
		}
		return $resultList;
	}
}