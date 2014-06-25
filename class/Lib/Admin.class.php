<?php
class Lib_Admin{
	const SESSION_ADMIN_USER_ID = 'admin_user_id';
	const COOKIE_ADMIN_USER = 'admin_user';

	public static function getEnvData(){
		$env = array();
		$sideBarData = self::getSideBarData();
		$env['side_bar_data'] = $sideBarData;
		
		$loginUser = self::GetLoginUser();
		if(!$loginUser){
			self::SetError("请先登陆");
			Utility::Redirect('/admin/login.php');
		}
		$env['login_user'] = $loginUser;
		return $env;
	} 
	
	public static function getSideBarData(){
		$data = array(
			'index' =>  array(
				'title'=>'首页',
				'url'=>"/admin/index.php",
			),
			'interface' => array(
				'title' => 'API接口管理',
				'url' => "/admin/interface/index.php",
			),
			'openapi' => array(
					'title' => 'OpenAPI接口管理',
					'url' => "/admin/openapi/index.php",
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
			'suggestion' => array(
				'title' => '用户建议',
				'url' => "/admin/suggestion/index.php",
			),
			'stats' => array(
				'title' => '线上服务',
				'url' => "/admin/stats/memcache.php",
			),
// 			'count' => array(
// 				'title' => '接口性能统计',
// 				'url' => "/admin/count/index.php",
// 			),
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
	
	public static function Login($username,$pwd,$remember = false){
		$pwdMD5 = md5($pwd);
		$dbUser = new DB_AdminUser();
		$user = $dbUser->fetch($username,'username');
		
		if(!$user || $user['password'] != $pwdMD5){
			return false;
		}
		
		if($remember){
			$userStr = "{$username}@{$pwd}";
			$userStr = Util_Secret::Encode($userStr);
			$result = Cookie::Set(self::COOKIE_ADMIN_USER, $userStr,10*86400);
		}
		
		Session::Set(self::SESSION_ADMIN_USER_ID, $user['id']);
		return $user;
	}
	
	public static function GetLoginUser(){
		$userID = Session::Get(self::SESSION_ADMIN_USER_ID);
		$dbUser = new DB_AdminUser();
		if($userID){
			$user = $dbUser->fetch($userID);
			return $user;
		}
		
		$userInfo = Cookie::Get(self::COOKIE_ADMIN_USER);
		if(!$userInfo){
			return false;
		}
		
		$userInfo = Util_Secret::Decode($userInfo);
		$userInfo = explode('@', $userInfo);
		$user = self::Login($userInfo[0], $userInfo[1]);
		return $user;
	}
	
	public static function Logout(){
		Session::Del(self::SESSION_ADMIN_USER_ID);
		Cookie::Del(self::COOKIE_ADMIN_USER);
	}
}