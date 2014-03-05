<?php
class Lib_Category{
	public static $error;
	const TYPE_API = 1;
	const TYPE_ERROR = 2;
	
	const STATUS_NORMAL = 1;
	const STATUS_DEL = 2;
	
	public static $typeArray = array(
		self::TYPE_API => array('name' => 'API接口分类','value' => self::TYPE_API),
		self::TYPE_ERROR=> array('name' => '错误分类','value' => self::TYPE_ERROR),
	);
	
	
	public static function Create($category){
		$dbObj = new DB_Category();
		$insertID = $dbObj->create($category);
		if(!$insertID){
			self::$error = $dbObj->error;
		}
		return  $insertID;
	}
	
	public static function Update($oldCategory,$category){
		$dbObj = new DB_Category();
		$condition = array('id' => $oldCategory['id']);
		$result = $dbObj->update($condition, $category);
	
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;
	}
	
	public static function Search($keyWord){
		
	}
	
	public static function getCategoryList($type = null,$offSet = 0,$size = 0){
		$dbObj = new DB_Category();
		$condition = array(
			'status' => self::STATUS_NORMAL,
		);
		
		if($type){
			$condition['type'] = $type;
		}
		
		if($size){
			$offSet = intval($offSet);
			$option = array(
				'offset' => $offSet,
				'size' => $size,
			);
		}
		
		$categoryList = $dbObj->get($condition,$option);
		$categoryList = Util_Array::AssColumn($categoryList, 'id');
		return $categoryList;
	}
	
	public static function Get($condition,$option){
		$dbObj = new DB_Category();
		$result = $dbObj->get($condition,$option);
		
		if(!$result){
			self::$error = $dbObj->error;
		}
		return $result;	
	}
	
	public static function Fetch($id){
		$dbObj = new DB_Category();
		$result = $dbObj->fetch($id);
		return $result;
	}
	
	public static function getTypesInfo(){
		return self::$typeArray;
	}
}