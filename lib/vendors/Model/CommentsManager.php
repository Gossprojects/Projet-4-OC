<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Comment;

abstract class CommentsManager extends Manager {
	
	abstract protected function add(Comment $comment);

	abstract protected function modify(Comment $comment);

	public function save(Comment $comment) {
		if ($comment->isValid()) {
			$comment->isNew() ? $this->add($comment) : $this->modify($comment); // Modify() à implémenter pdt construction admin space
		}
		else {
			throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
		}
	}

	abstract public function get($id);

	abstract public function getListOf($news);
}