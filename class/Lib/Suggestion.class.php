<?php
class Lib_Suggestion{
	public static $error;
	
	public static function create($suggestion){
		$suggestion['ip'] = Utility::getUserIP('127.0.0.1');
		$dbObj = new DB_Suggestion();
		
		$result = $dbObj->create($suggestion);
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;
	}
}