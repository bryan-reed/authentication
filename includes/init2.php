<?php
//Functions for secure session and sanitizing output
require_once 'functions2.php';
//start a session
start_session();

//Set definitions for db settings (using mysql)
define('DB_HOST', 'localhost'); //DB host
define('DB_NAME', 'authentication_app'); //DB name
define('DB_USER', 'root'); //DB username
define('DB_PASS', 'root'); //DB password

// //Register autoload
// spl_autoload_register(function($class) {
// 	require_once 'classes/' . $class . '.php';
// });