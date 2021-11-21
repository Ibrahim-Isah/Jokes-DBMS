<?php
namespace Ninja;

class DatabaseTable{
	//Variables for the class
	private $conn;
	private $table;
	private $primaryKey;
	
	public function __construct(\PDO $conn , string $table , string $primaryKey){
	//type hinting to help tell user the type used in the arguments
		$this->conn = $conn;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}
	private function query($sql , $param = []){
		$query = $this->conn->prepare($sql);
		$query->execute($param);
		return $query;
	}
	public function total(){
		$query = $this->query('SELECT COUNT(*) FROM `' .$this->table.'`');
		$row = $query->fetch();
		return $row[0];
	}
	public function findAll(){
		$query = $this->query('SELECT * FROM `'. $this->table . '`');
		return $query->fetchAll();
	}
	public function deleteAll($id) {
		$param = [':id' => $id];
		$query = $this->query('DELETE FROM `'.$this->table .'` WHERE `'.$this->primaryKey.'` = :id' , $param);
	}
	public function findById($value) {
		$param = [':value' => $value];
		$query = $this->query('SELECT * FROM `'.$this->table.'`
		WHERE `'.$this->primaryKey.'` = :value' , $param);
		return $query->fetch();
	}
	public function find($column , $value){
		$query = ('SELECT * FROM `' .$this->table. '` WHERE ' . $column . ' = :value');
		$param = ['value'=>$value];
		$query = $this->query($query , $param);
		return $query->fetch();

	}
	private function insert($field){
	
		$query = 'INSERT INTO `'.$this->table.'` (';
		
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
		$field= $this->processDate($field);

		$this->query($query ,$field);
	}
	private function update($field) {
		$query = ' UPDATE `'.$this->table.'` SET ';
		foreach ($field as $key => $value){
			$query .= '`' . $key . '` = :' . $key . ',';
		}
		$query = rtrim($query, ',');
		$query .= ' WHERE `'.$this->primaryKey.'` = :primaryKey';
		// Set the :primaryKey variable
		$field= $this->processDate($field);
		$field['primaryKey'] = $field['id'];
		$this->query($query, $field);
	}
	public function save($record){
		try{
			if($record[$this->primaryKey] == ''){
				$record[$this->primaryKey]= null;
			}
			$this->insert($record);
		}
		catch(\PDOException $e){
			$this->update($record);
		}
	}
	private function processDate($field){
		foreach($field as $key=>$value){
			if($value instanceOf \DateTime){
				$field[$key] = $value->format('Y-m-d');
			}
		}
		return $field;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}