<?php
namespace Ijdb\Entity;

class Joke{
    public $id;
    public $joketext;
    public $jokedate;
    public $authorid;
    private $authorTable;

    public function __construct(\Ninja\DatabaseTable $authorTable){
        $this->authorTable = $authorTable;
    }

    public function getAuthor(){
        return $this->authorTable->findById($this->authorid);
    }
    

}