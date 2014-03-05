<?php
class Session{
	
	public static  function Set($key,$value){
		$_SESSION[$key] = $value;
	}
	
	public static function Get($key,$once = false){
		$value = $_SESSION[$key];
		if($once){
			unset($_SESSION[$key]);
		}
		return $value;
	}
}