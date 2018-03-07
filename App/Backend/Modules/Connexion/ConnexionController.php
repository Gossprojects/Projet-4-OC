<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class ConnexionController extends BackController {

	public function executeIndex(HTTPRequest $request) {

		$this->getPage()->addVar('title', 'Connexion');

		if($request->postExists('login')) {
			$login = $request->postData('login');
			$password = $request->postData('password');

			if($login == $this->getApp()->getConfig()->get('login') && $password == $this->getApp()->getConfig()->get('pass')) {
				$this->getApp()->getUser()->setAuthenticated(true);
				$this->getApp()->getHttpResponse()->redirect('.');
			}
			else {
				$this->getApp()->getUser()->setFlash('Le pseudo ou le mot de passe est incorrect.');
			}
		}
	}
}