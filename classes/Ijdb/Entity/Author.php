<?php 
namespace Ijdb\Entity;


class Author{
    public $id;
    public $name;
    public $password;
    public $email;
    private $jokesTable;

    public function __construct(\Ninja\DatabaseTable $jokesTable){
        $this->jokesTable = $jokesTable;
    }

    public function getJokes(){
        return $this->jokesTable->find('authorid' , $this->id);
    }

    public function addJoke($joke){
        $joke['authorid'] = $this->id;
        
        $this->jokesTable->save($joke);
    }
}