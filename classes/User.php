<?php
class User {
	private $_db = null, //Db connection
			$_data, // User data
			$_isLoggedIn = false; //Logged in flag default is false

	public function __construct($user = null) {
		$this->_db = DB::getInstance(); //return db instance
		//If no user passed in, check if session user
		if(!$user) {
			//Check if session user is logged in
			if(Session::exists('user')) {
				$user = Session::get('user');
				if($data = $this->_db->query('SELECT id, username, password, full_name, group_id FROM users WHERE id = :id', array(':id' => $user))) {
					if($data->count()) {
						$this->_data = $data->first();
						$this->_isLoggedIn = true;
					}
				}
			}
		}
	}
	//Attempt login
	public function login($form) {
		//Get user with email from passed in input
		if($this->_data = $this->_db->query('SELECT id, username, password, full_name FROM users WHERE username = :username', array(':username' => $form['username']))) {
			//If there are results
			if($this->_data->count()) {
				// check password
				// PHP password_verify used with password_hash with PASSWORD_BCRYPT and cost 12 to generate password
				if(password_verify($form['password'], $this->_data->first()->password)) {
					Session::set('user', $this->_data->first()->id);
					return true;
				}
			}
		}
		return false;
	}
	//Return data
	public function data() {
		return $this->_data;
	}
	//Check permissions
	public function hasPermission($key) {
		// $group = $this->_db->query('SELECT name, permissions FROM groups WHERE id = :id',array(':id' => $this->data()->group_id));
		// Get all permissions that this person has
		$permissions = $this->_db->query('SELECT p.name, gp.permission_id 
									FROM group_permissions gp 
									INNER JOIN permissions p ON p.id = gp.permission_id 
									WHERE gp.group_id = :id',
									array(':id' => $this->data()->group_id)
									);
		$permissions = $this->_db->query('SELECT p.name, gp.permission_id 
									FROM group_permissions gp 
									INNER JOIN permissions p ON p.id = gp.permission_id 
									WHERE gp.group_id = ' . intval($this->data()->group_id)
									);
		//If there are any permissions, check if $key is one of them
		if($permissions->count()) {
			foreach($permissions->results() AS $permission) {
				if(strtolower($permission->name) == strtolower($key)) {
					return true;
				}
			}
		}
		return false;
		// if($group->count()) {
		// 	$permissions = json_decode($group->first()->permissions, true);
		// 	if($permissions[$key] == true) {
		// 		return true;
		// 	}
		// }
		// return false;
	}
	//Return loggedIn flag
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
}