<?php
require_once 'includes/init.php';
//Check if logged in
$user = new User();
//If not logged in, redirect to index page
if(!$user->isLoggedIn()) {
	header('Location: index.php');
	exit;
}
//simple logout
if(isset($_GET['logout'])) {
	unset($_SESSION['user']);
	Session::message('message', 'Successfully Logged Out!');
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Authentication App</title>
  </head>
  <body>
  	<?php
  	//Output any messages
	if(Session::exists('message')) {
		echo Session::message('message');
	}
	//Out put user information sanitized for xss
  	echo '<h2>Hello ' . sanitize($user->data()->full_name) . '</h2>'; 

  	echo '<p>Logged in as: ' . sanitize($user->data()->username) . '</p>';

  	echo ' <a href="?logout">Logout</a>';
  	//Output permissions
	if($user->hasPermission('admin')) {
		echo '<p>You have admin permissions</p>';
	}
	if($user->hasPermission('moderator')) {
		echo '<p>You have moderator permissions</p>';
	}
  	?>
  </body>
</html>