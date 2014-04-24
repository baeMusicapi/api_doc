<?php
/**
 * API 接口基础操作类
 * 
 * @author zhaojian01
 *
 */
class Lib_Interface{
	const TYPE_API = 1;
	const TYPE_OPEN_API = 2;
	
	public static $error;

	public static function Search($keyWord){
		$dbInterface = new DB_Interface();
		
		$condition = array(
			"or" => array(
				"locate(lower('{$keyWord}'),lower(name))",
				"locate(lower('{$keyWord}'),lower(title))",
				"locate(lower('{$keyWord}'),lower(introduction))",
			),
		);
		
		$result = $dbInterface->get($condition);
		return $result;
	}
	
	public static function Create($interfaceInfo){
		$dbInterface = new DB_Interface();
		$dbParameter = new DB_InterfaceParameter();
		
		$paramters = $interfaceInfo['parameters'];
		$interface = $interfaceInfo;
		unset($interface['parameters']);
		
		$insertID = $dbInterface->create($interface);
		if($insertID){
			foreach ($paramters as $paramter){
				$paramter['interface_id'] = $insertID;
				$dbParameter->create($paramter);
			}
		} else {
			self::$error = $dbInterface->error;
		}
		return $insertID;
	}
	
	public static function Update($interfaceInfo,$upateInfo){
		$dbInterface = new DB_Interface();
		$dbParameter = new DB_InterfaceParameter();
		
		$interfaceID = $interfaceInfo['id'];
		
		$updateParameters = $upateInfo['parameters'];
		$updateInterface = $upateInfo;
		unset($updateInterface['parameters']);
		
		$result = $dbInterface->update(array('id'=>$interfaceID), $updateInterface);
		
		if($result){
			$condition = array('interface_id' => $interfaceID);
			$dbParameter->delete($condition);
			foreach ($updateParameters as $paramter){
				$paramter['interface_id'] = $interfaceID;
				$dbParameter->create($paramter);
			}
		} else {
			self::$error = $dbInterface->error;
		}
		return $result;
	}
	
	
	public static function Fetch($interfaceID){
		$dbObj = new DB_Interface();
		$interface = $dbObj->fetch($interfaceID);
		
		if($interface){
			$dbParameter = new DB_InterfaceParameter();
			$parameters = $dbParameter->get(array('interface_id' => $interface['id']));
			$interface['parameters'] = $parameters;
		}
		return $interface;
	}
	
	
	public static function getList($categoryID = null,$start = 0,$size = 0,$type = self::TYPE_API){
		$dbObj = new DB_Interface();
		$condition = array(
			'type' => $type,
		);
		if($categoryID){
			$condition['category_id'] = $categoryID;
		}
		
		if($size){
			$option['offset'] = $start;
			$option['size'] = $size;
		}
		
		$interfaceList = $dbObj->get($condition,$option);
		return $interfaceList;
	}
	
	public static function GetStatis(){
		$dbObj = new DB_Interface();
		$option = array(
			'select' => 'id,category_id'
		);
		$condition = array();
		$data = $dbObj->get($condition,$option);
		
		$amount = 0;
		$categoryAmount = array();
		foreach ($data as $interface){
			$amount ++;
			$categoryAmount[$interface['category_id']]++;
		}
		$result = array(
			'amount' => $amount,
			'category_amount' => $categoryAmount,
		);
		return $result;
	} 
	
	public static function getCategoryWithInterface(){
		$apiCategoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_API);
		$interfaceList = Lib_Interface::getList(0,0,0,Lib_Interface::TYPE_API);
		$categoryList = array();
		foreach ($interfaceList as $interface){
			$categoryID = $interface['category_id'];
			if(!Util_Array::IsArrayValue($categoryList[$categoryID])){
				$categoryList[$categoryID] = $apiCategoryList[$categoryID];
			}
			$categoryList[$categoryID]['api'][] = $interface;
		}
		return $categoryList;
	}
	
	public static function getCategoryWithOpenAPI(){
		$apiCategoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_OPENAPI);
		$interfaceList = Lib_Interface::getList(0,0,0,self::TYPE_OPEN_API);
		$categoryList = array();
		foreach ($interfaceList as $interface){
			$categoryID = $interface['category_id'];
			if(!Util_Array::IsArrayValue($categoryList[$categoryID])){
				$categoryList[$categoryID] = $apiCategoryList[$categoryID];
			}
			$categoryList[$categoryID]['api'][] = $interface;
		}
		return $categoryList;
	}
	
}