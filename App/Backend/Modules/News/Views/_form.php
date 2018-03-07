<form action="" method="post">
	<p>
		<?= // Erreur si l'auteur est invalide
		isset($erreurs) && in_array(\Entity\News::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide. <br />' : '' ?>
		
		<label for="auteur">Auteur</label>
		<input type="text" name="auteur" value="<?= isset($news) ? $news->getAuteur() : '' ?>" /><br />

		<?= // Erreur si le titre est invalide
		isset($erreurs) && in_array(\Entity\News::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide. <br />' : '' ?>
		
		<label for="titre">Titre</label>
		<input type="text" name="titre" value="<?= isset($news) ? $news->getTitre() : '' ?>" /><br />

		<?= // Erreur si le contenu est invalide
		isset($erreurs) && in_array(\Entity\News::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide. <br />' : '' ?>

		<label for="contenu">Contenu</label>
		<textarea rows="8" cols="60" name="contenu"><?= 
			isset($news) ? $news->getContenu() : '' ?>
		</textarea><br />
		
		<?php // Si la news existe déjà, le form envoie Modifier
		if (isset($news) && !$news->isNew()) { ?>
			<input type="hidden" name="id" value="<?= $news->getId() ?>" />
			<input type="submit" value="Modifier" name="modifier" /><?php
		}
		// Sinon le form envoie Ajouter
		else { ?>
			<input type="submit" value="Ajouter" name="ajouter" /><?php
		} ?>
	</p>
</form>