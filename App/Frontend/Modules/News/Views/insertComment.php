<div class="row add-bottom">

  <div class="twelve columns add-bottom">

    <h2>Ajouter un commentaire</h2>
    <br />

    <form action="" method="post">
      <p>
        <?= isset($erreurs) && in_array(\Entity\Comment::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
        <label>Pseudo</label>
        <input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment->getAuteur()) : '' ?>" />
        
        <?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
        <label>Contenu</label>
        <textarea name="contenu" rows="7" cols="50"><?= isset($comment) ? htmlspecialchars($comment->getContenu()) : '' ?></textarea>
        
        <input type="submit" value="Commenter" />
      </p>
    </form>

  </div>

  <hr />

</div>