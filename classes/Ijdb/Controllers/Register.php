<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Register{
    private $authorTable;


    public function __construct(DatabaseTable $authorTable){
        $this->authorTable = $authorTable;
    }

    public function registrationForm(){
        return['template'=>'register.html.php' , 'title'=>'Register here'];
    }

    public function registerUser(){
     $author = $_POST["author"];
     $valid = true;
     $error = [];

     if(empty($author['name'])){
         $valid = false;
         $error[] = 'Name must be provided';
     }
     if(empty($author['email'])){
         $valid = false;
         $error[] = 'Email must be provided';
     } elseif(filter_var($author['email'] , FILTER_VALIDATE_EMAIL) == false) {
         $valid = false;
         $error[] = 'Invalid Email address';
     } else {
         $author['email'] = strtolower($author['email']);

         if(count($this->authorTable->find('email' , $author['email'])) > 0){
             $valid = false;
             $error[] = 'Email has being registered already';
         }

     }
     if(empty($author['password'])){
         $valid = false;
         $error[] = 'Password field cannot be blank';
     }
     if($valid == true){
         $author['password'] = password_hash($author['password'] , PASSWORD_DEFAULT);
         $this->authorTable->save($author);

         header('location:index.php?route=author/success');
     } else {
         return ['template' => 'register.html.php' , 'title' => 'Register Account' , 
         'variable' => [
             'author' => $author,
             'error' => $error
         ]];
     }

    }

    public function success(){
        return['template'=>'registersuccess.html.php' , 'title'=>'Registration successful'];
    }
}