<?php
function generate_tree() {
	global $mysqli;
	// Boss map, employees array and queue array
	$bossMap = array();
	$employees = array();
	$queue = array();
	//Get all employees
	$sql = "SELECT * FROM employees";
	$res = $mysqli->query($sql);
	while($j = $res->fetch_assoc()) {
		//Map employee id to name
		$employees[$j['id']] = $j['name'];
		//Add all employees to bossMap except ceo
		if($j['bossId'] !== $j['id'])
			$bossMap[$j['bossId']][] = $j['id'];
		else
			//bossId = employeeId so this is CEO
			$ceo = $j;
	}
	//Set up CEO obj - Root of the tree
	$ceoObj = new Employee($ceo['id'], $ceo['name'], $ceo['id'], 0);


	// //Add the ceo to the queue
	$queue[] = $ceoObj;
	$i = 0;
	$total = count($employees);
	//Loop through every employee
	while($i < $total) {
		// $boss = array_shift($queue);
		$boss = $queue[$i];
		//Set boss name
		$boss->setBossName($employees[$boss->boss]);
		$subordinates = array();
		if(array_key_exists($boss->id, $bossMap)) {
			$subordinates = $bossMap[$boss->id];
		}
		foreach ($subordinates as $subordinateId) {
			$employeeObj = new Employee($subordinateId, $employees[$subordinateId], $boss->id, $boss->depth+1);
			$boss->addSubordinate($employeeObj);
			$queue[] = $employeeObj;
		}
		$i++;
	}
	assignEmployeeCount($ceoObj);
	return $queue;
}

function assignEmployeeCount($employee) {
	$count = 0;
	$count += count($employee->employees);
	foreach($employee->employees AS $emp) {
		$count += assignEmployeeCount($emp);
	}
	$employee->numEmployees = $count;
	unset($employee->employees);
	// unset($employee->id);
	// unset($employee->boss);
	return $count;
}
function flat_array($tree) {
	$newArray = array();

}