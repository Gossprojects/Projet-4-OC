<?php
namespace OCFram;

class Config extends ApplicationComponent {
	protected $vars = [];

	public function get($var) {
		if(!$this->vars) { // Si c'est le premier appel, on charge le fichier XML
			$xml = new \DOMDocument;
			$xml->load(__DIR__.'/../../App/'.$this->getApp()->getName().'/Config/app.xml');
	
			$elements = $xml->getElementsByTagName('define');

			foreach($elements as $element) {
				$this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
			}
		}
		if(isset($this->vars[$var])) {
			return $this->vars[$var];
		}

		return null; // Si $var non défini dans le fichier XML
	}
}