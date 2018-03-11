<form action="" method="post">
	<p>
		<?= isset($erreurs) && in_array(\Entity\Comment::Auteur_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
		<label for="pseudo">Pseudo</label>
		<input type="text" name="pseudo" value="<?= htmlspecialchars($comment->getAuteur()) ?>" /><br />

		<?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
		<label for="contenu">Commentaire</label>
		<textarea name="contenu" rows="7" cols="50"><?= htmlspecialchars($comment->getContenu()) ?></textarea><br />

		<input type="hidden" name="news" value="<?= $comment->getNews() ?>" />
		<input type="submit" value="Modifier" />
	</p>
</form>