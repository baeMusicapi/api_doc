<?php
class Lib_Admin{

	public static function getEnvData(){
		$env = array();
		$sideBarData = self::getSideBarData();
		
		$env['side_bar_data'] = $sideBarData;
		
		return $env;
	} 
	
	public static function getSideBarData(){
		$data = array(
			'index' =>  array(
				'title'=>'首页',
				'url'=>"/admin/index.php",
			),
			'interface' => array(
				'title' => '接口管理',
				'url' => "/admin/interface/index.php",
			),
			'category' => array(
				'title' => '分类管理',
				'url' => '/admin/category/index.php',
			),
			'error_code' => array(
				'title' => '错误码',
				'url' =>"/admin/error_code/index.php",
			),
			'tag' => array(
				'title' => '标签管理',
				'url' => "/admin/tag/index.php",
			),
		);
		foreach ($data as $key => &$one){
			if(self::isCurrentSideItem($key)){
				$one['current'] = true;
			} else {
				$one['current'] = false;
			}
		}
		
		return $data;
	}
	
	public static function isCurrentSideItem($key){
		$key = "admin/{$key}";
		$uri = Utility::getRequestURI();
		if(strstr($uri, $key) !== false){
			return true;
		}
		return false;
	}
	
	
	public static function SetError($value){
		Session::Set('admin_error', $value);
	}
	
	public static function SetNotice($value){
		Session::Set('admin_notice', $value);
	}
	
	public static function GetError($once=true){
		$result =  Session::Get('admin_error',$once);
		return $result;
	}
	
	public static function GetNotice($once=true){
		return Session::Get('admin_notice',$once);
	}
}