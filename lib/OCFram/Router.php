<?php
namespace OCFram;

class Router {
	protected $routes = [];

	const NO_ROUTE = 1;

	public function addRoute($route) {

		if (!in_array($route, $this->routes)) {
			$this->routes[] = $route;
		}
	}
	public function getRoute($url) {

		foreach($this->routes as $route) {
			if (($varsValues = $route->match($url)) !== false) { // Si la route correspond à l'URL
				
				if ($route->hasVars()) { // Si la route a des variables

					$varsNames = $route->getVarsNames();
					$listVars = [];
					
					foreach($varsValues as $key => $match) {
						if($key !== 0) { // On évite la première valeur, qui contient toute la chaîne
							$listVars[$varsNames[$key - 1]] = $match;
						}
					}
					
					$route->setVars($listVars);
				}

				return $route;
			}
		}
		throw new \RuntimeException("Aucune route ne correspond à l\'URL", self::NO_ROUTE);
	}
}