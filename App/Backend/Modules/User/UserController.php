<?php
namespace App\Backend\Modules\User;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class UserController extends BackController {

	public function executeConnexion(HTTPRequest $request) {

		$this->getPage()->addVar('title', 'Connexion');

		$manager = $this->managers->getManagerOf('Connexion');
		$admin = $manager->getAdmin();
		
		if($request->postExists('login') && $request->postExists('password')) {
			$login = $request->postData('login');
			$password = $request->postData('password');

			if($login == $admin['user_name'] && password_verify($password, $admin['user_password'])) {

				$this->getApp()->getUser()->setAuthenticated(true);
				$_SESSION['username'] = $login;

				$this->getApp()->getHttpResponse()->redirect('.');
			}
			else {
				$this->getApp()->getUser()->setFlash('Le pseudo ou le mot de passe est incorrect.');
			}
		}
	}

	public function executeDisconnect(HTTPRequest $request) {

		$root = $this->app->getConfig()->get('root');

		session_destroy();

		$this->app->getHttpResponse()->redirect($root.'/bootstrap.php');
	}

	public function executeUpdatePassword(HTTPRequest $request) {

		$this->page->addVar('title', 'Changement du mot de passe');
		$this->page->addVar('pageId', 'profil');

		if($request->postExists('password') && $request->postExists('password_new') && $request->postExists('password_new_confirm')) {
		// Si le formulaire est rempli

			if($this->passwordCheck($request)) {
			// Si l'ancien mot de passe est le bon

				if($request->postData('password_new') == $request->postData('password_new_confirm')) {
				// Si le nouveau mot de passe est confirmé

					if($request->postData('password_new') != $request->postData('password')) {
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

	public function executeUpdateUsername(HTTPRequest $request) {

		$this->page->addVar('title', 'Changement du nom d\'administrateur');
		$this->page->addVar('pageId', 'profil');

		if($request->postExists('username') && $request->postExists('password')) {
		// Si le formulaire est rempli
			if($request->postData('username') != $_SESSION['username']) {
			// Si le nouveau nom est différent du premier
				if($this->passwordCheck($request)) {
					// Si le mot de passe est le bon
		
						$manager = $this->managers->getManagerOf('Connexion');
						$newUsername = $request->postData('username');
						var_dump($newUsername);
						$manager->updateUsername($newUsername);
		
						$this->app->getUser()->setFlash('Votre nouveau nom d\'administrateur est '.$newUsername);
		
						$this->app->getHttpResponse()->redirect('.');
					}
				else {
					$this->app->getUser()->setFlash('Le mot de passe est incorrect');
				}
			}
			else {
				$this->app->getUser()->setFlash('Le nouveau nom d\'administrateur doit être différent de l\'actuel');
			}

		}
	}

	public function passwordCheck(HTTPRequest $request) {
		// Ne fonctionne que si le champ password du formulaire a pour name 'password'

		if($request->postExists('password')) {
			$manager = $this->managers->getManagerOf('Connexion');
			$admin = $manager->getAdmin();
	
			$password = $request->postData('password');
	
			if(password_verify($password, $admin['user_password'])) {
				return true;
			}
			else {
				return false;
			}
		}
	}
}