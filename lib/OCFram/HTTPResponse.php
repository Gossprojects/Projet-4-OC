<?php
namespace OCFram;

class HTTPResponse extends ApplicationComponent {
	protected $page;

	public function addHeader($header) {
		header($header);
	}
	public function redirect($location) {
		var_dump($location);
		header('Location: '.$location);
		exit;
	}
	public function redirect404() {
		$this->page = new Page($this->app);
		$this->page->setContentFile(__DIR__.'/../../Errors/404.html');
		$this->addHeader('HTTP/1.0 404 Not Found');
		$this->send();
	}
	public function send() {
		exit($this->page->getGeneratedPage());
	}
	public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	} // != réécriture fonction de base car httpOnly est à true par défaut pour sécurité
	public function setPage(Page $page) {
		$this->page = $page;
	}
}