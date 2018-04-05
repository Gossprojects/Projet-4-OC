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

	protected function modify(Comment $comment) {
		
		$req = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id= :id');
		$req->bindValue(':auteur', $comment->getAuteur());
		$req->bindValue(':contenu', $comment->getContenu());
		$req->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);

		$req->execute();
	}

	public function delete($id) {

		$this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
	}

	public function flag($id) {

		$this->dao->exec('UPDATE comments SET flagged = flagged+1 WHERE id = '.$id);
	}

	public function countFlagged() {

		return $this->dao->query('SELECT COUNT(*) FROM comments WHERE id != 0')->fetchColumn();
	}

	public function deleteFromNews($news) {

		$this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);
	}

	public function get($id) {

		$req = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
		$req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$req->execute();

		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		return $req->fetch();
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

	public function getFlaggedList() {

		$sql = 'SELECT id, news, auteur, contenu, date, flagged FROM comments WHERE flagged != 0 ORDER BY id DESC';

		$req = $this->dao->query($sql);

		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		$commentsList = $req->fetchAll();

		foreach($commentsList as $comment) {
			$comment->setDate(new \DateTime($comment->getDate())); 
		}

		$req->closeCursor();

		return $commentsList;
	}
}