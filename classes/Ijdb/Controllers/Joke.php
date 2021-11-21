<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Joke{
	private $authorTable;
	private $jokesTable;
	private $authentication;

	
	public function __construct(DatabaseTable $authorTable ,DatabaseTable $jokesTable,
	 Authentication $authentication){
		$this->authorTable = $authorTable;
		$this->jokesTable = $jokesTable;
		$this->authentication = $authentication;
	}
	
	public function list(){
		$result = $this->jokesTable->findAll();
		$jokes = [];
		foreach($result as $joke){
			$author = $this->authorTable->findById($joke['authorid']);
			
			$jokes[] =[
			'id'=>$joke['id'],
			'joketext'=>$joke['joketext'],
			'jokedate'=>$joke['jokedate'],
			'name'=>$author['name'],
			'email'=>$author['email'],
			'authorid'=>$author['id']
			];
		}
			
			$title = 'Joke list';
			
			
			
			return ['template'=>'jokes.html.php', 'title'=>$title ,
			'variable'=>[
						'jokes'=>$jokes ?? null , 
						'userId'=> $author['id'] ?? null]];
	}
	
	
	public function deleteAll(){
		$author = $this->authentication->getUser();

		$joke = $this->jokesTable->findById($_POST['id']);

		if($joke['authorid'] == $author['id']){
			return;
		}
		$this->jokesTable->deleteAll($_POST['id']);
		
		header('location:index.php?route=joke/list');
	}
	public function home(){
		
		$title = 'Jokes website';
		
		$totaljoke = $this->jokesTable->total();
		
		return ['template'=>'home.html.php', 'title'=>$title , 
		'variable'=>[
					'totaljoke'=>$totaljoke ?? null]];
		}
	public function saveEdit(){
		$author = $this->authentication->getUser();
		if(isset($_GET['id'])){
			if($joke['authorid'] != $author['id']){
				return;
			}
		}
		/*$authorObject = \Ijdb\Entity\Author($this->jokesTable);

		$authorObject->id = $author['id'];
		$authorObject->name  = $author['name'];
		$authorObject->password = $author['password'];
		$authorObject->email = $author['email'];*/


		$joke = $_POST['joke'];
		$joke['authorid'] = $author->id;
		$joke['jokedate'] = new \DateTime(); 
		$this->jokesTable->save($joke);	
			//$author->addJoke($joke);
		header('location:index.php?route=joke/list');
			
		
	} 
	public function edit(){
		$author = $this->authentication->getUser();
		
			$title = 'Add/Edit joke';
			if(isset($_GET['id'])){
				$joke = $this->jokesTable->findById($_GET['id']);
			}
			
			return ['template'=>'editjoke.html.php', 'title'=>$title , 
			'variable'=>['joke'=>$joke ?? null,
			'userId' => $author['id'] ?? null]];
	
		}
}






















