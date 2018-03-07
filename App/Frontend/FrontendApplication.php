<?php
namespace App\Frontend;

use \OCFram\Application; // ??

class FrontendApplication extends Application {

	public function __construct() {
		parent::__construct();
		$this->setName('Frontend');
	}

	public function run() {
		$controller = $this->getController();

		$controller->execute();

		$this->getHttpResponse()->setPage($controller->getPage());
		$this->getHttpResponse()->send();
	}

	public function setName($name) {
		if(is_string($name)) {
			$this->name = $name;
		}
	}
}