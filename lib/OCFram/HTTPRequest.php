<?php
namespace OCFram;

class HTTPRequest {
	public function cookieData($cookie) {
		return isset($_COOKIE[$cookie]) ? $_COOKIE[$key] : null;
	}
	public function cookieExists($cookie) {
		return isset($_COOKIE[$cookie]) ? true : false;
	}
	public function getData($key) { // Renvoie données GET
		return ($_GET[$key]) ? $_GET[$key] : null;
	}
	public function getExists($key) {
		return isset($_GET[$key]) ? true : false;
	}
	public function getMethod() { // Renvoie la nature de la méthode enployée pour envoyer la requête (GET ou POST)
		return $_SERVER["REQUEST_METHOD"];
	}
	public function postData($key) { // Renvoie données POST
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}
	public function postExists($key) {
		return isset($_POST[$key]) ? true : false;
	}
	public function requestURI() { // Renvoie l'URL de la requête
		return $_SERVER["REQUEST_URI"];
	}
}