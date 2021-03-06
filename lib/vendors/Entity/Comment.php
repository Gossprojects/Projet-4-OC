<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity {
	protected $news, $auteur, $contenu, $date, $flagged;

	const AUTEUR_INVALIDE = 1;
	const CONTENU_INVALIDE = 2;

	public function isValid() {

		return !(empty($this->auteur) || empty($this->contenu));
	}

	// SETTERS

	public function setNews($news) {

		$this->news = (int) $news;
	}

	public function setAuteur($auteur) {

		if (!is_string($auteur) || empty($auteur)) {
			$this->erreurs[] = self::AUTEUR_INVALIDE;
		}

		$this->auteur = $auteur;
	}

	public function setContenu($contenu) {

		if(!is_string($contenu) || empty($contenu)) {
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}

		$this->contenu = $contenu;
	}

	public function setDate(\DateTime $date) {

		$this->date = $date;
	}

	public function setFlagged($flags) {

		$this->flagged = (int) $flags;
	}

	// GETTERS

	public function getNews() {
		return $this->news;
	}
	public function getAuteur() {
		return $this->auteur;
	}
	public function getContenu() {
		return $this->contenu;
	}
	public function getDate() {
		return $this->date;
	}
	public function getFlagged() {
		return $this->flagged;
	}
}