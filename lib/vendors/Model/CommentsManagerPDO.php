<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager {
	protected function add(Comment $comment) {
		$q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');

		$q->bindValue(':news', $comment->getNews(), \PDO::PARAM_INT);
		$q->bindValue(':auteur', $comment->getAuteur());
		$q->bindValue(':contenu', $comment->getContenu());

		$q->execute();

		$comment->setId($this->dao->lastInsertId());
	}

	public function getListOf($news) {
		if(!ctype_digit($news)) {
			throw new \InvalidArgumentException('L\'identifiant de la news est invalide');
		}

		$req = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
		$req->bindValue(':news', $news, \PDO::PARAM_INT);
		$req->execute();

		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		$comments = $req->fetchAll();

		foreach($comments as $comment) {
			$comment->setDate(new \DateTime($comment->getDate()));
		}

		return $comments;
	}
}