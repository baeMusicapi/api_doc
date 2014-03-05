<?php
class Lib_System{
	
	public static function getEnvData(){
		
		$topBarData = self::getTopBarData();
		
		$result = array(
			'top_bar' => $topBarData,
		);
		
		return $result;
	}
	
	
	
	public static function getTopBarData(){
		$top = array(
				'index' =>  array(
						'title'=>'首页',
						'url'=>"/index.php",
						'key' => array('/^\/index.php/','/^\/$/','/^\/\?/'),
				),
				'interface' => array(
						'title' => 'API接口',
						'url' => "/interface/index.php",
						'key' => '/interface/',
				),
				'error_code' => array(
						'title' => 'ErrorCode',
						'url' => '/error_code/index.php',
						'key' => '/error_code/',
				),
		);
		
		foreach ($top as &$data){
			$key = $data['key'];
			if(self::isCurrentSection($key)){
				$data['current'] = true;
			} else {
				$data['current'] = false;
			}
		}
		
		return $top;
	}
	
	
	public static function isCurrentSection($keys){
		$keys = is_array($keys) ? $keys : array($keys);
		$uri = Utility::getRequestURI();
		
		foreach ($keys as $key){
			if(preg_match($key, $uri)){
				return true;
			}
		}
		return false;
	}
	
	public static function SetError($value){
		Session::Set('error', $value);
	}
	
	public static function SetNotice($value){
		Session::Set('notice', $value);
	}
	
	public static function GetError($once=true){
		$result =  Session::Get('error',$once);
		return $result;
	}
	
	public static function GetNotice($once=true){
		return Session::Get('notice',$once);
	}
}