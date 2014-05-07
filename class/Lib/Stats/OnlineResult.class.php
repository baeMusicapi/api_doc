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
		
		$header = self::getHeader();
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
	
	public function getCache($key,$runtime = array()){
		$url = "/v1/restserver/ting?method=baidu.ting.cache.mget&key={$key}";
		$header = self::getHeader();
		$resultList = array();
		
		foreach (self::$ipList as $rt => $list){
			if(!$runtime || in_array($rt, $runtime)){
				$ip = $list[0];
				$currentUrl = "http://$ip:8888{$url}";
				$result = Util_HttpRequest::Get($currentUrl,array(),$header);
				$resultMD5 = md5($result);
				$result = json_decode($result,true);
				$resultList[$resultMD5]['data'] = $result;
				$resultList[$resultMD5]['server'][] = $rt . $ip;
			}
		}
		return $resultList;
	}
	
	public function delCache($key,$runtime = array()){
		$url = "/v1/restserver/ting?method=baidu.ting.cache.mdelete&key={$key}";
		$header = self::getHeader();
		$resultList = array();
		
		foreach (self::$ipList as $rt => $list){
			if(!$runtime || in_array($rt, $runtime)){
				$ip = $list[0];
				$currentUrl = "http://$ip:8888{$url}";
				$result = Util_HttpRequest::Get($currentUrl,array(),$header);
				$resultMD5 = md5($result);
				$result = json_decode($result,true);
				$resultList[$resultMD5]['data'] = $result;
				$resultList[$resultMD5]['server'][] = $rt . $ip;
			}
		}
		return $resultList;
	}
	
	
	public static function getHeader(){
		$host = "tingapi.ting.baidu.com";
		$header = array("Host:{$host}");
		return $header;		
	}
}