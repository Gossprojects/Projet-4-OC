<?php
namespace Model;

class ConnexionManagerPDO extends ConnexionManager {

	public function getAdmin() {
		// Login admin stocké en ID = 1 
		$req = $this->dao->prepare('SELECT user_name, user_password FROM user WHERE id = 1');
		$req->execute();
		$admin = $req->fetchAll(\PDO::FETCH_ASSOC);

		return $admin[0];
	}

	public function updatePassword($password) {

		$hachedPassword = password_hash($password, PASSWORD_DEFAULT);
		$req = $this->dao->prepare('UPDATE user SET user_password = :user_password WHERE id = 1');
		
		$req->bindValue('user_password', $hachedPassword);
		$req->execute();
	}

	public function updateUsername($username) {

		$req = $this->dao->prepare('UPDATE user SET user_name = :user_name WHERE id = 1');

		$req->bindValue('user_name', $username);
		$req->execute();
		
		$_SESSION['username'] = $username;
	}
}