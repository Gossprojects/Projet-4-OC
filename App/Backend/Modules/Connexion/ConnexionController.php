<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class ConnexionController extends BackController {

	public function executeIndex(HTTPRequest $request) {

		$this->getPage()->addVar('title', 'Connexion');

		$manager = $this->managers->getManagerOf('Connexion');
		$admin = $manager->getAdmin();
		
		if($request->postExists('login') && $request->postExists('password')) {
			$login = $request->postData('login');
			$password = $request->postData('password');

			if($login == $admin['user_name'] && password_verify($password, $admin['user_password'])) {
				$this->getApp()->getUser()->setAuthenticated(true);
				$this->getApp()->getHttpResponse()->redirect('.');
			}
			else {
				$this->getApp()->getUser()->setFlash('Le pseudo ou le mot de passe est incorrect.');
			}
		}
	}
}