<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;

class NewsController extends BackController {
	
	public function executeIndex(HTTPRequest $request) {
	
		$nombreNews = $this->app->getConfig()->get('nombre_news');
		$nombreCaracteres = $this->app->getConfig()->get('nombre_caracteres');
		
		$this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');

		$manager = $this->managers->getManagerOf('News');

		$listeNews = $manager->getList(0, $nombreNews);

		foreach($listeNews as $news) {
			
			// Si l'article est plus long que le max, on coupe au dernier espace avant la limite
			if(strlen($news->getContenu()) > $nombreCaracteres) {
				$debut = substr($news->getContenu(), 0, $nombreCaracteres);
				$debut = substr($debut, 0, strrpos($debut, ' ')).'...';

				$news->setContenu($debut);
			}
		}

		$this->page->addVar('listeNews', $listeNews);
	}

	public function executeShow(HTTPRequest $request) {

		$news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

		if (empty($news)) {
			$this->app->getHttpResponse()->redirect404();
		}

		$this->page->addVar('title', $news->getTitre());
		$this->page->addVar('news', $news);
		$this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->getId()));
	}

	public function executeInsertComment(HTTPRequest $request) {

		$this->page->addVar('title', 'Ajout d\'un commentaire');

		if ($request->postExists('pseudo')) {
			$comment = new Comment([
				'news' => $request->getData('news'),
				'auteur' => $request->postData('pseudo'),
				'contenu' => $request->postData('contenu')
			]);

			if ($comment->isValid()) {
				$this->managers->getManagerOf('Comments')->save($comment);

				$this->app->getUser()->setFlash('Le commentaire a bien été ajouté');

				$this->app->getHttpResponse()->redirect('news-'.$request->getData('news').'.html');
			}
			else {
				$this->page->addVar('erreurs', $comment->getErreurs());
			}

			$this->page->addVar('comment', $comment);
		}
	}

	public function executeFlagComment(HTTPRequest $request) {

			$manager = $this->managers->getManagerOf('Comments');
			$manager->flag($request->getData('comment'));

			$this->app->getUser()->setFlash('Vous avez signalé un commentaire à l\'administrateur.');

			$this->app->getHttpResponse()->redirect('news-'.$request->getData('id').'.html');
	} 
}