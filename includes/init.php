<?php
//Functions for secure session and sanitizing output
// require_once 'functions2.php';

//start a session
// session_start();

//Set definitions for db settings (using mysql)
define('DB_HOST', 'localhost'); //DB host
define('DB_NAME', 'authentication_app'); //DB name
define('DB_USER', 'root'); //DB username
define('DB_PASS', 'root'); //DB password
require_once 'db.php';
// $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
require_once 'functions2.php';

//Register autoload
spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});