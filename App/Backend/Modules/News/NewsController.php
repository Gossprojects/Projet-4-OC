<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;

class NewsController extends BackController {
	
	public function executeIndex(HTTPRequest $request) {

		$this->page->addVar('title', 'Gestion des news');

		$manager = $this->managers->getManagerOf('News');

		$this->page->addVar('listeNews', $manager->getList());
		$this->page->addVar('nombreNews', $manager->count());
	}

	public function executeInsert(HTTPRequest $request) {

		if ($request->postExists('auteur')) {
			$this->processForm($request);
			$this->app->getHttpResponse()->redirect('.');
		}

		$this->page->addVar('title', 'Ajout d\'une news');
	}

	public function executeUpdate(HTTPRequest $request) {

		if ($request->postExists('auteur')) {
			$this->processForm($request);
			$this->app->getHttpResponse()->redirect('.');
		}
		else { // Si le formulaire n'est pas encore rempli (premier run) on passe la news à la vue pour que son contenu y apparaisse
			$this->page->addVar('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
		}

		$this->page->addVar('title', 'Modification d\'une news');
	}

	public function executeDelete(HTTPRequest $request) {

		$newsId = $request->getData('id');

		$this->managers->getManagerOf('News')->delete($newsId);
		$this->managers->getManagerOf('Comments')->deleteFromNews($newsId);

		$this->app->getUser()->setFlash('La news d\'ID '.$newsId.' a bien été supprimée.');

		$this->app->getHttpResponse()->redirect('.');
	}

	public function executeUpdateComment(HTTPRequest $request) {
		
			$this->page->addVar('title', 'Modification d\'un commentaire');

			if($request->postExists('pseudo')) {
				
				$comment = new Comment([
					'id' => $request->getData('id'),
					'auteur' => $request->postData('pseudo'),
					'contenu' => $request->postData('contenu')
				]);

				if($comment->isValid()) {
					$this->managers->getManagerOf('Comments')->save($comment);

					$this->app->getUser()->setFlash('Le commentaire a bien été modifié');

					$this->app->getHttpResponse()->redirect('/php/projet4/Web/news-'.$request->postData('news').'.html');
				}
				else {
					$this->page->addVar('erreurs', $comment->getErreurs());
				}

				$this->page->addVar('comment', $comment);
			}
			else {
				$this->page->addVar('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
			}
	}

	public function executeDeleteComment(HTTPRequest $request) {

		$this->managers->getManagerOf('Comments')->delete($request->getData('id'));

		$this->app->getUser()->setFlash('Le commentaire a bien été supprimé');

		$this->app->getHttpResponse()->redirect('.');
	}

	public function processForm(HTTPRequest $request) {

		$news = new News([
			'auteur' => $request->postData('auteur'),
			'titre' => $request->postData('titre'),
			'contenu' => $request->postData('contenu')
		]);

		if ($request->postExists('id')) { // id transmis pour action update
			$news->setId($request->postData('id'));
		}

		// Ajout ou modification d'une news via save() du manager
		if ($news->isValid()) {
			$this->managers->getManagerOf('News')->save($news);
			$this->app->getUser()->setFlash($news->isNew() ? 'La news a bien été ajoutée.' : 'La news a bien été modifiée.');
		}
		else {
			$this->page->addVar('erreurs', $news->getErreurs());
		}

		$this->page->addVar('news', $news);
	}
}