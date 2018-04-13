<?php
namespace OCFram;

class Page extends ApplicationComponent {
	protected $contentFile, $vars = [];

	public function addVar($var, $value) {
		if(!is_string($var) || is_numeric($var) || empty($var)) {
			throw new \InvalidArgumentException('Le nom de la variable doit être une chaîne de caractère non nulle');
		}

		$this->vars[$var] = $value;
	}

	public function getGeneratedPage() {

		if(!file_exists($this->contentFile)) {
			throw new \RuntimeException('La vue spécifiée n\'existe pas');
		} 

		/* Quatre variables globales disponibles

		$user : vérifier la connexion
		$config : concaténer la racine serveur dans les liens
		$content : intégrer la vue générée .php 
		$pages : le nombre de pages d'articles
		$pageId : le nom de la page (pour mise en forme menu) */

		$user = $this->app->getUser();
		$config = $this->app->getConfig();

		if(property_exists('Page', "vars['pages']")) { 
			$pages = $this->vars['pages'];
		}
		if(property_exists('Page', "vars['pageId']")) { 
			$pageId = $this->vars['pageId'];
		}

		extract($this->vars);

		ob_start();
			require $this->contentFile;
		$content = ob_get_clean();

		ob_start();
			require __DIR__.'/../../App/'.$this->app->getName().'/Templates/layout.php';
		return ob_get_clean();
	}

	public function setContentFile($contentFile) {
		if(!is_string($contentFile) || empty($contentFile)) {
			throw new \InvalidArgumentException('La vue spécifiée est invalide');
		}

		$this->contentFile = $contentFile;
	}
}
