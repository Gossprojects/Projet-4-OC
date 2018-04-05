<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager {

	protected function add(News $news) {

		$req = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');

		$req->bindValue(':titre', $news->getTitre());
		$req->bindValue(':auteur', $news->getAuteur());
		$req->bindValue(':contenu', $news->getContenu());

		$req->execute();
	}

	protected function modify(News $news) {

		$req = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

		$req->bindValue(':titre', $news->getTitre());
		$req->bindValue(':auteur', $news->getAuteur());
		$req->bindValue(':contenu', $news->getContenu());
		$req->bindValue(':id', $news->getId(), \PDO::PARAM_INT);

		$req->execute();
	}

	public function delete($id) {

		$this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
	}

	public function getList($debut = -1, $limite = -1) {
		$sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';

		if($debut != -1 ||$limite != -1) {
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$requete = $this->dao->query($sql);

		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		$listeNews = $requete->fetchAll();

		foreach($listeNews as $news) {
			$news->setDateAjout(new \DateTime($news->getDateAjout())); 
			$news->setDateModif(new \DateTime($news->getDateModif()));
		}

		$requete->closeCursor();

		return $listeNews;
	}

	public function getUnique($id) {
		$req = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = :id');
		$req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$req->execute();

		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		if($news = $req->fetch()) {
			$news->setDateAjout(new \DateTime($news->getDateAjout()));
			$news->setDateModif(new \DateTime($news->getDateModif()));

			return $news;
		}

		return null;
	}

	public function count() {
		
		return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}
}