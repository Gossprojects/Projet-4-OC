<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;

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
		}

		$this->page->addVar('title', 'Ajout d\'une news');
	}

	public function executeUpdate(HTTPRequest $request) {

		if ($request->postExists('auteur')) { // Si le formulaire n'a pas été envoyé
			$this->processForm($request);
		}
		else {
			$this->page->addVar('news', $this->managers->getManagerOf('News'->getUnique($request->getData('id'))));
		}

		$this->page->addVar('title', 'Modification d\'une news');
	}

	public function executeDelete(HTTPRequest $request) {

		$this->managers->getManagerOf('News')->delete($request->getData('id'));

		$this->app->getUser()->setFlash('La news d\'ID '.$request->getData('id').' a bien été supprimée.');

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