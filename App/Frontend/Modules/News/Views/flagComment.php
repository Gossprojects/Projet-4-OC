<?php
// Redirection vers l'affichage de la news correspondant au commentaire signalé

$root = $config->get('root');

header('Location:'.$root.'/news-'.$_GET['news'].'\.html');

exit;