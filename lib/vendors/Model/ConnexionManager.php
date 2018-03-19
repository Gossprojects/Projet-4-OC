<?php
namespace Model;

use \OCFram\Manager;

abstract class ConnexionManager extends Manager {

	abstract protected function getAdmin();
}