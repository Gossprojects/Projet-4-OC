<?php
namespace App\Backend;

use \OCFram\Application;

class BackendApplication extends Application {

	public function __construct() {

		parent::__construct();
		$this->name = 'Backend';
	}

	public function run() {

		if($this->getUser()->isAuthenticated()) {
			$controller = $this->getController();
		}

		else {
			$controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
		}

		$controller->execute();

		$this->getHttpResponse()->setPage($controller->getPage());
		$this->getHttpResponse()->send();
	}
}