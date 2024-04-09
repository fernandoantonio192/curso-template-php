<?php 

namespace app\framework\classes;

use Exception;

class Router {

	private string $path;
	private string $request;

	private function routerFound($routes) {
		# verifica a requisição
		if (!isset($routes[$this->request])) {
			throw new Exception("Route {$this->path} does not exist");
		}

		# verifica a uri
		if (!isset($routes[$this->request][$this->path])) {
			throw new Exception("Route {$this->path} does not exist");
		}
	}

	private function foundController(string $controllerNamespace, string $controller, string $action) {
		if (!class_exists($controllerNamespace)) {
			throw new Exception("Controller {$controller} does not exist");
		}

		if (!method_exists($controllerNamespace, $action)) {
			throw new Exception("Action {$action} does not exist inController {$controller} does not exist");
		}
	}

	public function execute($routes) {
		# pega a uri
		$this->path = path();
		# pega a requisição
		$this->request = request();
		# verfica a existência da rota
		$this->routerFound($routes);

		[$controller, $action] = explode("@", $routes[$this->request][$this->path]);

		# pegando o namespace do controller
		$controllerNamespace = "app\\controllers\\{$controller}";

		# verficando o controller e o action
		$this->foundController($controllerNamespace, $controller, $action); 

		$controllerInstance = new $controllerNamespace;
		$controllerInstance->$action();
	}

}