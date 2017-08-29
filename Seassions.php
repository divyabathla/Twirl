<?php
class Seassions{
	public static function existsSession($key){
		return (isset($_SESSION[$key])) ? true : false;
	}
	
	public static function insertDataInSession($key,$value){
		return $_SESSION[$key] = $value;
	}

	public static function getDataFromSession($key){
		return $_SESSION[$key];
	}

	public static function delDataFromSession($key){
		if(self::existsSession($key)){
			unset($_SESSION[$key]);
		}
	}

	public static function flashSession($key,$value = ''){
		if (self::existsSession($key)){
			$session = self::getDataFromSession($key);
			self::delDataFromSession($key);
			return $session;
		}else{
			self::insertDataInSession($key,$value);
		}
	}
}
?>