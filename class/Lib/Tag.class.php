<?php
class Lib_Tag{
	public static $error;
	
	public static function Create($tag){
		$dbObj = new DB_Tag();
		$insertID = $dbObj->create($tag);
		if(!$insertID){
			self::$error = $dbObj->error;
		}
		return $insertID;
	}
	
	public static function Update($tag,$updateRow){
		$dbObj = new DB_Tag();
		$condition = array(
			'id' => $tag['id'],
		);
		$result = $dbObj->update($condition, $updateRow);
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;
	}
	
	public static function Fetch($tagID){
		$dbObj = new DB_Tag();
		return $dbObj->fetch($tagID);
	}
	
	public static function getList(){
		$dbObj = new DB_Tag();
		
		$tagList = $dbObj->get($condition = array());
		return $tagList;
	}
}