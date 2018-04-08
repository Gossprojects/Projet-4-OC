<?php
namespace Entity;

use \OCFram\Entity;

class News extends \OCFram\Entity {
	protected $auteur,
			$titre,
			$contenu,
			$dateAjout,
			$dateModif;

	const AUTEUR_INVALIDE = 1,
		TITRE_INVALIDE = 2,
		CONTENU_INVALIDE = 3;

	public function isValid() {
		
		return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
	}

	// Setters

	public function setAuteur($auteur) {
		if(!is_string($auteur) || empty($auteur)) {
			$this->erreurs[] = self::AUTEUR_INVALIDE;
		}

		$this->auteur = $auteur;
	}

	public function setTitre($titre) {
		if(!is_string($titre) || empty($titre)) {
			$this->erreurs[] = self::TITRE_INVALIDE;
		}

		$this->titre = $titre;
	}

	public function setContenu($contenu) {
		if(!is_string($contenu) || empty($contenu)) {
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}

		$this->contenu = $contenu;
	}

	public function setDateAjout(\DateTime $dateAjout) {
		$this->dateAjout = $dateAjout;
	}

	public function setDateModif(\DateTime $dateModif) {
		$this->dateModif = $dateModif;
	}

	// Getters

	public function getAuteur() {
		return $this->auteur;
	}

	public function getTitre() {
		return $this->titre;
	}

	public function getContenu() {
		return $this->contenu;
	}

	public function getDateAjout() {
		return $this->dateAjout;
	}

	public function getDateModif() {
		return $this->dateModif;
	}
}