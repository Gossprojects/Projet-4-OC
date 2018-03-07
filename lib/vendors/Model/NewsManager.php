<?php
namespace Model;

use \OCFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager {

	abstract protected function add(News $news);

	abstract protected function modify(News $news);

	abstract public function delete($id);

	public function save(News $news) {
		// Ajoute (add) ou modifie (update) une news
		if ($news->isValid()) {
			$news->isNew() ? $this->add($news) : $this->modify($news);
		}
		else {
			throw new \RuntimeException('La news doit être validée pour être enregistrée');
		}
	}

	abstract public function getList($debut = -1, $limite = -1);

	abstract public function count();
}