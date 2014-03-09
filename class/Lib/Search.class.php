<?php
class Lib_Search{
	
	public static function search($keyWord){
		$interfaceSearchResult = Lib_Interface::Search($keyWord);
		$errorSearchResult = Lib_ErrorCode::search($keyWord);
		$categoryResult = Lib_Category::Search($keyWord);
		
		$result = array(
			'interface' => $interfaceSearchResult,
			'error' => $errorSearchResult,
			'category' => $categoryResult,
		);
		
		return $result;
	}
}