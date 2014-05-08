<?php
/**
 * 加密类
 * @author zhaojian
 *
 */
class Util_Secret{
	public static $defaultKeyMap = "hi_jQRST-UwxkVWXYZaopqr89LMmGH012345uvstbcdef+IJK6/7n=lDEFABCNOPyzg";

	/**
	 * 加密程序
	 * @param string $strToEncode 待加密字符串
	 * @param string $key 机密密钥
	 * @return 加密后字符串
	 */
	public static function Encode($strToEncode,$key = ''){
		$strToEncode = base64_encode($strToEncode);
		$map = self::GetKeyMap($key);
		$mapLen = strlen($map);
		$randomNum = rand(0, $mapLen - 1);
		
		$startRandChar = $map{$randomNum};
		$endRandChar = $map{$mapLen - 1 - $randomNum};
		$pwd = md5($key.$startRandChar.$endRandChar);
		$pwdLen = strlen($pwd);
		$strTemp = '';//结果
		$pwdIndex = $mapIndex = 0;
		
		for($i = 0; $i<strlen($strToEncode);$i++){
			$pwdIndex = $pwdIndex % $pwdLen;
			$curNum = ord($pwd{$pwdIndex});
			$mapIndex = strpos($map, $strToEncode{$i}) + $randomNum + $curNum;
			$mapIndex = $mapIndex % $mapLen;
			$strTemp .= $map{$mapIndex};
			$pwdIndex ++;
		}
		$strTemp = $startRandChar . $strTemp . $endRandChar;
		return $strTemp;
	}
	
	
	/**
	 * 解密程序
	 * 
	 * @param string $strToDecode 带解密字串
	 * @param string $key  密钥
	 * @return boolean|string  返回
	 */
	public static function Decode($strToDecode,$key = ''){
		$map = self::GetKeyMap($key);
		$mapLen = strlen($map);
		
		$strLen = strlen($strToDecode);
		
		$startRandChar = substr($strToDecode, 0,1);
		$endRandChar = substr($strToDecode, -1,1);
		
		$strToDecode = substr($strToDecode, 1,$strLen - 2);
		
		$randNum = strpos($map, $startRandChar);
		$endRandNum = strpos($map, $endRandChar);
		
		if( ($mapLen - $endRandNum - 1) != $randNum){
			return false;
		}
		$pwd = md5($key.$startRandChar.$endRandChar);
		$pwdLen = strlen($pwd);
		
		$strTemp = '';//结果
		$pwdIndex = $mapIndex = 0;
		
		for($i = 0;$i<strlen($strToDecode);$i++){
			$pwdIndex = $pwdIndex % $pwdLen;
			$curNum = ord($pwd{$pwdIndex});
			
			$addNum = ($randNum + $curNum) % $mapLen;
			$addNum = $mapLen - $addNum;
			
			$mapIndex = strpos($map, $strToDecode{$i}) + $addNum;
			$mapIndex = $mapIndex % $mapLen;
			
			$strTemp .= $map{$mapIndex};
			$pwdIndex ++;
		}
		$strTemp = base64_decode($strTemp);
		return $strTemp;
	}
	
	
	/**
	 * 生成字码表
	 * 
	 * @param unknown $key
	 * @param string $map
	 * @return Ambigous <unknown, string>|string
	 */
	public static function GetKeyMap($key,$map = ''){
		$map = $map ? $map : self::$defaultKeyMap;
		if(!$key){
			return $map;
		}
		
		$key = md5(strval($key));
		$mapLen =  strlen($map);
		
		$subNum = abs(crc32($key));
		$subNum = $subNum % $mapLen;
		
		$newMap = substr($map, $subNum) . substr($map, 0,$subNum);
		$newMap = str_split($newMap);
		$str1 = "";
		$str2 = "";
		foreach ($newMap as $key=>$one){
			if($key%2){
				$str1 .=$one;
			}else{
				$str2 .=$one;
			}
		}
		$finalMap = $str1.$str2;
		return $finalMap;
	}
	
}