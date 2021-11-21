<?php
namespace Ijdb;


class IjdbRoutes implements \Ninja\Routes{
    private $jokesTable;
    private $authorTable;
    private $authentication;

    public function __construct(){
        include __DIR__ . '/..\..\includes\dbconn.php';

        $this->jokesTable = new \Ninja\DatabaseTable($conn , 'joke' , 'id');
        $this->authorTable = new \Ninja\DatabaseTable($conn , 'author' , 'id');
        $this->authentication = new \Ninja\Authentication($this->authorTable, 'email' ,'password');

        
    }

    public function getRoute(): array{
			
            

			$jokeController = new \Ijdb\Controllers\Joke($this->authorTable, $this->jokesTable, $this->authentication);
            $authorController = new \Ijdb\Controllers\Register($this->authorTable);
            $loginController = new \Ijdb\Controllers\Login($this->authentication);
			$routes = [
                'author/register' => [
                    'GET' => [
                        'controller' => $authorController,
                        'action' => 'registrationForm'
                    ],
                    'POST' => [
                        'controller' => $authorController,
                        'action' => 'registerUser'
                    ]
                    ],
                'author/success' => [
                    'GET'=> [
                        'controller' => $authorController,
                        'action'=> 'success'
                    ]
                    ],
                'joke/edit' => [
                    'POST' => [
                        'controller' => $jokeController,
                        'action' => 'saveEdit'
                    ] , 
                    'GET' => [
                        'controller' => $jokeController,
                        'action'=> 'edit'
                    ],
                    'login' => true
                    ],
                'joke/deleteall' => [
                    'POST'=>[
                        'controller' => $jokeController,
                        'action' => 'deleteall'
                    ],
                    'login' => true
                    ],
                    'joke/list' => [
                        'GET'=>[
                            'controller' => $jokeController,
                            'action' => 'list'
                        ]
                        ],
                    'joke/home'=>[
                        'GET'=>[
                            'controller' => $jokeController,
                            'action' => 'home'
                        ]
                        ],
                    'login/error' => [
                        'GET' => [
                            'controller' =>$loginController,
                            'action' => 'error'
                        ]
                        ],
                    'login' => [
                        'GET' => [
                            'controller' => $loginController,
                            'action' => 'loginForm'
                        ],
                        'POST' => [
                            'controller' => $loginController,
                            'action' => 'processLogin'
                        ]
                        ],
                    'login/success' => [
                        'GET' => [
                           'controller' => $loginController,
                           'action' => 'success' 
                        ],
                        'login' => true
                    ], 
                    'logout' => [
                        'GET' => [
                            'controller' => $loginController,
                            'action' => 'logout'
                        ]
                    ]    
                        ];
            return $routes;
        }
    public function getAuthentication(): \Ninja\Authentication{
        return $this->authentication;
    }
}