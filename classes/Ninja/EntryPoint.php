<?php
namespace Ninja;


class EntryPoint{
	private $method;
	private $route;
	private $routes;
	
	
	public function __construct($route , $method ,  $routes){
		$this->route = $route;
		$this->method = $method;
		$this->routes = $routes;
		$this->checkUrl();
	}
	private function checkUrl(){
		if($this->route !== strtolower($this->route)){
			http_response_code(301);
			header('location:index.php?route= ' . strtolower($this->route));
		}
	}
	private function loadTemplate($templateFileName , $variables = []){
		extract($variables);
		
		ob_start();
		
		include __DIR__ . '\..\..\templates\\' .$templateFileName;
		
		return ob_get_clean();
	}
	
	public function run(){
		$routes = $this->routes->getRoute();
		$authentication = $this->routes->getAuthentication();

		if(isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()){
			header('location:index.php?route=login/error');
		} else {
			$controller = $routes[$this->route][$this->method]['controller'];
			$action = $routes[$this->route][$this->method]['action'];

			$page = $controller->$action();
			
			$title = $page['title'];
			
			if(isset($page['variable'])){
				$output = $this->loadTemplate($page['template'] , $page['variable']);
			} else {
				$output = $this->loadTemplate($page['template']);
			}
			//return include __DIR__ . '\..\..\templates\layout.html.php';
			echo $this->loadTemplate('layout.html.php' ,
			 ['loggedIn'=>$authentication->isLoggedIn() , 'output' => $output , 'title'=> $title]);
		}
	}
}
















