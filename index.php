<?php

// $result = 0;
// $i = 143;
 
// while (true) {
//     $i++;
//     $result = $i * (2 * $i - 1);
 
//     if (isPentagonal($result)) {
//         break;
//     }
// }





require_once 'includes/init.php';
// How the passwords were generated - using php password_hash()
// $generated_password = 'password'; //For username "bryan_reed"
// $generated_password = 'guest'; //For username "guest"
// echo password_hash($generated_password, PASSWORD_BCRYPT, array('cost' => 12));
// exit;

//Instantiate a new user object 
$user = new User();
//If logged in, forward to secure page
if($user->isLoggedIn()) {
	header("Location: secure.php");
	exit;
}
//Check if form was submitted
if(isset($_POST['username'], $_POST['password'])) {
	//Attempt login
	if($user->login($_POST)) {
		Session::message('message', 'Successfully Logged In!');
		header("Location: secure.php");
		exit;
	} else {
		//Failed login
		Session::message('message', 'Login failed!');
		//Reload the page so refreshing wont submit the form again
		header("Location: index.php");
		exit;
	}
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
  		
  	?>
  	<form action="" method="post">
  		<p>
	  		<label for="username">Username</label>
	  		<input type="text" name="username" value="" />
  		</p>
  		<p>
	  		<label for="password">Password</label>
	  		<input type="password" name="password" value="" />
  		</p>
  		<p>
  		<input type="submit" />
  		</p>
  	</form>
  </body>
</html>