<?php 

foreach($listeNews as $news) { ?>

	<div class="row add-bottom">
		
		<div class="twelve columns add-bottom">

			<h2><a href="news-<?= $news->getId() ?>.html"><?= $news->getTitre() ?></a></h2>
			<p><?= nl2br($news->getContenu()) ?></p>

		</div>

		<hr />

	</div>

<?php 
}
//session_destroy();


// IMPOSSIBLE D'UTILISER NEWS COMME TABLEAU CAR INTERFACE ArrayAccess NON IMPLEMENTE