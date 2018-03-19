<?php
namespace OCFram;

abstract class Application {
	protected $httpRequest, $httpResponse, $user, $name, $config;
	
	abstract public function run();
	
	public function __construct() {
		$this->httpRequest = new httpRequest($this);
		$this->httpResponse = new httpResponse($this);
		$this->user = new User($this);
		$this->name = ''; // Assigné par chaque classe Application enfant
		$this->config = new Config($this);
	}
	
	public function getController() {
		$router = new Router;
		$xml = new \DOMDocument;

		// Récupération dans le routeur instancié des routes écrites dans le fichier XML
		$xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');
		$routes = $xml->getElementsByTagName('route');

		foreach($routes as $route) {
			$vars = [];
			// Parsing des vars (GET) éventuellement contenues dans la route
			if($route->hasAttribute('vars')) { 
				$vars = explode(',', $route->getAttribute('vars'));
			}

			// Ajout de la racine écrite en config aux URL
			if($route->hasAttribute('url')) {
				$routeURL = $this->getConfig()->get('root').$route->getAttribute('url');
			}

			// Ajout de la route au routeur
			$newRoute = new Route($routeURL, 
						$route->getAttribute('module'), 
						$route->getAttribute('action'), 
						$vars);
			
			$router->addRoute($newRoute);
		}
		

		// Sélection de la route correspondant à l'URL de la requête (si pas de match, err 404)
		try {
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
		}
		catch(\RuntimeException $e) {
			if($e->getCode() == Router::NO_ROUTE) {
				$this->httpResponse->redirect404();
			}
		}

		// Ajout des variables GET de la route au tableau php GET
		$_GET = array_merge($_GET, $matchedRoute->getVars());

		$controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
		return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
	}

	public function getHttpRequest() {
		return $this->httpRequest;
	}
	public function getHttpResponse() {
		return $this->httpResponse;
	}
	public function getName() {
		return $this->name;
	}
	public function getUser() {
		return $this->user;
	}
	public function getConfig() {
		return $this->config;
	}
}