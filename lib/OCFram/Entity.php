<?php
namespace OCFram;

abstract class Entity {
	protected $id, $erreurs=[];

	public function __construct(array $donnees = []) {
		if(!empty($donnees)) {
			$this->hydrate($donnees);
		}
	}
	public function hydrate(array $donnees) {
		foreach($donnees as $attribut => $valeur) {
			$methode = 'set'.ucfirst($attribut);

			if(is_callable([$this, $methode])) {
				$this->$methode($valeur);
			}
		}
	}

	public function isNew() {
		return empty($this->id);
	}

	// Getters
	public function getErreurs() {
		return $this->erreurs;
	}
	public function getId() {
		return $this->id;
	}

	// Setters
	public function setId($id) {
		$this->id = (int) $id;
	}

	// Offsetters ?!?
	public function offsetGet($var) {
		if(isset($this->$var) && is_callable([$this, $var])) {
			return $this->$var();
		}
	}
	public function offsetSet($var, $value) {
		$method = 'set'.ucfirst($var);
		if(isset($this->$var) && is_callable([$this, $method])) {
			$this->$method($value);
		}
	}
	public function offsetExists($var) {
		return isset($this->$var) && is_callable([$this, $var]);
	}
	public function offsetUnset($var) { // ????
		throw new \Exception('Impossible de supprimer une quelconque valeur');
	}

}