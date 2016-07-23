<?php
/*
DB class:
	For this example we are only logging a user in and retrieving their permissions, so kept it simple
 */
class DB {
	private static $_instance = null; //Instance var, only one
	private $_pdo, //PDO connection
			$_query, //Last run query
			$_error = false, //Error from last query
			$_results, // Stored results from last query
			$_count = 0; // Counting results from last query
	//Try to connect to db		
	private function __construct() {
		try {
			//Connect to db (use PDO with mysql)
			$this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		} catch(PDOException $e) {
			//Handle error connecting to db here
			//die($e->getMessage);
		}
	}
	//Return only one instance of db connection
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	//Perform a query on the database
	public function query($sql, $params = array()) {
		$this->error = false;
		//Prepare the query using named variables
		if($this->_query = $this->_pdo->prepare($sql)) {
			//Bind variables using names ex: :username => 'my_username'
			if(count($params)) {
				foreach($params AS $param => $value) {
					$this->_query->bindValue($param, $value);
				}
			}
		}
		//Execute query
		if($this->_query->execute()) {
			//Store results and count
			$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
		} else {
			//If query failed, set error to true
			$this->_error = true;
		}
		return $this;
	}
	//Return error
	public function error() {
		return $this->_error;
	}
	//Return first result, to be used when selecting only one row
	public function first() {
		return $this->results()[0];
	}
	//Return all results
	public function results() {
		return $this->_results;
	}
	//Return a count of all results
	public function count() {
		return $this->_count;
	}
}