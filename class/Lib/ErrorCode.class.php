<?php
class Lib_ErrorCode{
	public static $error;
	
	public static function Create($errorCode){
		$dbObj = new DB_ErrorCode();
		$insertID = $dbObj->create($errorCode);
		if(!$insertID){
			self::$error = $dbObj->error;
		}
		return $insertID;
	}
	
	public static function Update($errorCode,$updateRow){
		$dbObj = new DB_ErrorCode();
		$condition = array('id' => $errorCode['id']);
		$result = $dbObj->update($condition, $updateRow);
		
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;
	}
	
	public static function GetList($categoryID = null,$start = 0,$size = 0){
		$dbObj = new DB_ErrorCode();
		
		$condition = array();
		if($categoryID){
			$condition['category_id'] = $categoryID;
		}
		
		if($size){
			$option['offset'] = $start;
			$option['size'] = $size;
		}
		
		$errorList = $dbObj->get($condition,$option);
		return $errorList;
	}
	
	public static function Fetch($errorCodeID){
		$dbObj = new DB_ErrorCode();
		$result = $dbObj->fetch($errorCodeID);
		return $result;
	}
	
	public static function getInfos($codes){
		$dbObj = new DB_ErrorCode();
		$result = $dbObj->fetch($codes,'code');
		return $result;
	}
	
	public static function getCategoryWithErrorCode(){
		$errorCodeList = Lib_ErrorCode::GetList();
		$errorCategoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_ERROR);
		
		$categortList =array();
		
		foreach ($errorCodeList as $error){
			$categoryID = $error['category_id'];
			if(!Util_Array::IsArrayValue($categortList[$categoryID])){
				$categortList[$categoryID] = $errorCategoryList[$categoryID];
			}
			$categortList[$categoryID]['error_code'][] = $error;
	
		}
		
		return $categortList;
	}
}