<?php
class Session {
	//Check if session key exists
	public static function exists($key) {
		return isset($_SESSION[$key]) ? true : false;
	}
	//Set a session value
	public static function set($key, $value) {
		return $_SESSION[$key] = $value;
	}
	//Get a session value
	public static function get($key) {
		return $_SESSION[$key];
	}
	//Delete a session value
	public static function delete($key) {
		//Only delete if it exists
		if(self::exists($key)) {
			unset($_SESSION[$key]);
		}
	}
	//Set/Delete a session message
	public static function message($key, $message = '') {
		//if it exists, retrieve it, then delete
		if(self::exists($key)) {
			$session = self::get($key);
			self::delete($key);
			return $session;
		} else {
			//it does not exist, so set it
			self::set($key, $message);
		}
	}
}