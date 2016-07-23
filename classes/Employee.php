<?php
//Employee class
//Used to create employees and track their boss and subordinate employees
class Employee {

	public $id;
	public $name;
	public $boss;
	public $bossName;
	public $depth;
	public $numEmployees = 0;
	public $employees = array();
	

	public function __construct($id, $name, $boss, $depth) {
		$this->setId($id);
		$this->setName($name);
		$this->setBoss($boss);
		$this->setDepth($depth);
	}

	public function addSubordinate($employee) {
		$this->employees[] = $employee;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function setBoss($boss) {
		$this->boss = $boss;
	}
	public function setBossName($name) {
		$this->bossName = $name;
	}
	public function setDepth($depth) {
		$this->depth = $depth;
	}
	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	public function getBoss() {return $this->boss;}
	public function getBossName() {return $this->bossName;}
	public function getDepth() {return $this->depth;}
}