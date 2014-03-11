<?php
class Lib_Suggestion{
	public static $error;
	
	public static function create($suggestion){
		if(!$suggestion['title'] || !$suggestion['message']){
			self::$error = "必须填入 标题和描述";
			return false;
		}
		
		
		$suggestion['ip'] = Utility::getUserIP('127.0.0.1');
		$dbObj = new DB_Suggestion();
		
		$result = $dbObj->create($suggestion);
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;
	}
	
	public static function getList(){
		$dbObj = new DB_Suggestion();
		$condition = array();
		$option = array(
			'order' => 'order by id desc',
		);
		
		$list = $dbObj->get($condition,$option);
		return $list;
	}
	
	public static function fetch($suggestionID){
		$dbObj = new DB_Suggestion();
		$suggestion = $dbObj->fetch($suggestionID);
		return $suggestion;
	}
}