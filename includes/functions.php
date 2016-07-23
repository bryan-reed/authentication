<?php
//Starts a secure session to avoid session hijacking
function start_session() {
	//Force sessions to only use cookies
	ini_set('session.use_only_cookies', 1);
	//Custom session name
	$session_name = 'auth_app_session_id';
	$session_secure = false; //For testing
	$session_httponly = true;

	$cookie_params = session_get_cookie_params();
	session_set_cookie_params(
		$cookie_params["lifetime"],
		$cookie_params["path"],
		$cookie_params["domain"],
		$session_secure,
		$session_httponly
	);
	//Set the session name
	session_name($session_name);
	//Start the PHP session
	session_start();
	//Delete old session id and regenerate
	session_regenerate_id(true); 
}
//Sanitizing output to prevent xss
function sanitize($string) {
	return htmlentities($string);
}
//Escape data going into the database
function sqlify($string) {
	return mysqli_real_escape_string($link, $string);
}