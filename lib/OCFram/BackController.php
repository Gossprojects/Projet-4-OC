<?php
namespace OCFram;

abstract class BackController extends ApplicationComponent {
	protected $action = '';
	protected $module = '';
	protected $page = null;
	protected $view = '';
	protected $managers = null;

	public function __construct(Application $app, $module, $action) {
		parent::__construct($app);

		$this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
		$this->page = new Page($app);

		$this->setModule($module);
		$this->setAction($action);
		$this->setView($action); // Par défaut
	}
	
	public function execute() {
		$method = 'execute'.ucfirst($this->action);

		if(!is_callable([$this, $method])) {
			throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
		}
		
		$this->$method($this->app->getHttpRequest()); // On passe la requête à la méthode, qui a besoin de data
	}

	// Getter
	public function getPage() {
		return $this->page;
	}

	// Setters
	public function setModule($module) {
		if(is_string($module))
			$this->module = $module;
	}
	public function setAction($action) {
		if(is_string($action)) 
			$this->action = $action;
	}
	public function setView($view) {
		if(!is_string($view) || empty($view)) {
			throw new \InvalidArgumentException('La vue doit être une chaîne de caractères non null');
		}
		
		$this->view = $view;
		$this->page->setContentFile($_SERVER['DOCUMENT_ROOT'].'/php/projet4/App/'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
	}
}