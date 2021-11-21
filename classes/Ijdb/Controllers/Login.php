<?php
namespace Ijdb\Controllers;

class Login{
    private $authentication;

    public function __construct(\Ninja\Authentication $authentication){
        $this->authentication = $authentication;
    }

    public function loginForm(){
        return ['template' => 'login.html.php' , 'title' => 'Login'];
    }
    
    public function error(){
        return ['template'=>'loginerror.html.php' , 'title'=>'You are not logged in'];
    }

    public function processLogin(){
        if($this->authentication->login($_POST['email'] , $_POST['password'])){
            header('location:index.php?route=login/success');
        } else {
            return ['template' => 'login.html.php' , 'title' => 'Log in' , 
        'variable' => [
            'error' => 'Invalid Log in Attempt'
        ]];
        }
    }

    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        return ['template' => 'logout.html.php' , 'title' => 'You are logged out'];
    }

    public function success(){
        return ['template' => 'loginsuccess.html.php' , 'title' => 'You are logged in'];
    }

}