<?php
include __DIR__ . '\..\includes\dbconn.php';


//create an insert function that can insert data into any kind of database table
function insert($conn ,$table , $field){
	
	$query = 'INSERT INTO `'.$table.'` (';
	
	foreach($field as $key => $value){
		$query.= '`' . $key . '` ,';
	}
	$query = rtrim($query , ',');//remove last char
	$query .= ') VALUES (';
	
	foreach ($field as $key=>$value){
		$query.=':' . $key . ',';
	}
	$query = rtrim($query , ',');
	$query.=')';
	$field= processDate($field);

	query($conn , $query ,$field);
}


//create a function that cann find a value by id in any database table
function findById($conn,$table, $primaryKey, $value) {
	$param = [':value' => $value];
	$query = query($conn , 'SELECT * FROM `'.$table.'`
	WHERE `'.$primaryKey.'` = :value' , $param);
	
	return $query->fetch();
}


//the query function allow us to create a simple signal that would be sent to the data
function query($conn, $sql , $param=[]) {
	$query = $conn->prepare($sql);
	//parameters in the execute() object can replace the foreach loop
	/*foreach($param as $name=>$value){
		$query->bindValue($name ,$value);
	}*/
	$query->execute($param);
	return $query;
}


//the update function update the data in any database table with a primary key submitted
function update($conn,$table, $primaryKey, $field) {
	$query = ' UPDATE `'.$table.'` SET ';
	foreach ($field as $key => $value){
		$query .= '`' . $key . '` = :' . $key . ',';
	}
	$query = rtrim($query, ',');
	$query .= ' WHERE `'.$primaryKey.'` = :primaryKey';
	// Set the :primaryKey variable
	$field= processDate($field);
	$field['primaryKey'] = $field['id'];
	query($conn, $query, $field);
}


//deletes a data from a table after being provided with a primary key
function deleteAll($conn ,$table ,$primaryKey ,  $id) {
	$param = [':id' => $id];
	$query = query($conn , 'DELETE FROM `'.$table .'` WHERE `'.$primaryKey.'` = :id' , $param);
	
	
}


//this function gives the ability to retrieve all data frm a table in a database
function findAll($conn , $table){
	/*$query = query($conn , 'SELECT `joke`.`id`, `joketext`, `jokedate`, `name`,`email`
FROM `joke` LEFT OUTER JOIN `author`
ON `authorid` = `author`.`id` LEFT OUTER JOIN `email` ON `joke`.`authorid` = `email`.`authorid`');*/
	$query = query($conn , 'SELECT * FROM `'. $table . '`');
	
	return $query->fetchAll();
}


//this field allow us to use the datetime class to set a date format easily understood by the database
function processDate($field){
	foreach($field as $key=>$value){
		if($value instanceOf DateTime){
			$field[$key] = $value->format('Y-m-d');
		}
	}
	return $field;
	
}


//function that counts the total in the database
function total($conn , $table){
	$query = query($conn , 'SELECT COUNT(*) FROM `' .$table.'`');
	$row = $query->fetch();
	return $row[0];
}


//function that saves user input into a field in the database
function save($conn , $table , $primaryKey , $record){
	try{
		if($record[$primaryKey] == ''){
			$record[$primaryKey]= null;
		}
		insert($conn , $table , $record);
	}
	catch(PDOException $e){
		update($conn , $table , $primaryKey , $record);
	}
}




















