<?php 

foreach($listeNews as $news) { ?>
	<h2><a href="news-<?= $news->getId() ?>.html"><?= $news->getTitre() ?></a></h2>
	<p><?= nl2br($news->getContenu()) ?></p>
<?php 
}
//session_destroy();


// IMPOSSIBLE D'UTILISER NEWS COMME TABLEAU CAR INTERFACE ArrayAccess NON IMPLEMENTE