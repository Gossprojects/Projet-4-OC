<?php
namespace App\Backend\Modules\Profile;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class ProfileController extends BackController {

	public function executeUpdatePassword(HTTPRequest $request) {

		$this->page->addVar('title', 'Changement du mot de passe');

		if($request->postExists('password_old') && $request->postExists('password_new') && $request->postExists('password_new_confirm')) {
		// Si le formulaire est rempli

			if($this->passwordCheck($request)) {
			// Si l'ancien mot de passe est le bon

				if($request->postData('password_new') == $request->postData('password_new_confirm')) {
				// Si le nouveau mot de passe est confirmé

					if($request->postData('password_new') != $request->postData('password_old')) {
					// S'il est différent de l'ancien

						$manager = $this->managers->getManagerOf('Connexion');
						$newPassword = $request->postData('password_new');
	
						$manager->updatePassword($newPassword);
						
						$this->app->getUser()->setFlash('Votre nouveau mot de passe est '.$newPassword);
	
						$this->app->getHttpResponse()->redirect('.');
					}
					else {
						$this->app->getUser()->setFlash('Le nouveau mot de passe doit être différent de l\'ancien');
					}
				}
				else {
					$this->app->getUser()->setFlash('Les deux nouveaux mots de passe doivent être identiques');
				}
			}
			else {
				$this->app->getUser()->setFlash('Le mot de passe actuel n\'est pas le bon');
			}
		}
	}

	public function passwordCheck(HTTPRequest $request) {

		if($request->postExists('password_old')) {
			$manager = $this->managers->getManagerOf('Connexion');
			$admin = $manager->getAdmin();
	
			$password = $request->postData('password_old');
	
			if(password_verify($password, $admin['user_password'])) {
				return true;
			}
			else {
				return false;
			}
		}
	}
}