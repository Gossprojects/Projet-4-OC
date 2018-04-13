<div class="row add-bottom">

  <div class="twelve columns add-bottom">

    <p>Par <em><?= $news->getAuteur() ?></em>, le <?= $news->getDateAjout()->format('d/m/Y à H\hi') ?></p>
 
    <h2><?= $news->getTitre() ?></h2>
 
    <p><?= nl2br($news->getContenu()) ?></p>

    <?php if ($news->getDateAjout() != $news->getDateModif()) { ?>
      <p style="text-align: right;"><small><em>Modifiée le <?= $news->getDateModif()->format('d/m/Y à H\hi') ?></em></small></p>
    <?php } ?>
    
    <hr />
      
    <h3>Commentaires</h3><br />

    <?php
    if(empty($comments)) {
      ?>
      <p>Aucun commentaire n'a été posté. Soyez le premier !</p>
      <?php
    }

    foreach($comments as $comment) {
      ?>
      <fieldset>

        <legend>
          Posté par <strong><?= htmlspecialchars($comment->getAuteur()) ?></strong> le <?= $comment->getDate()->format('d/m/Y à H\hi') ?>
          
          <?php if($user->isAuthenticated()) { ?>
                  <a href="admin/comment-update-<?= $comment->getId() ?>.html">Modifier</a> | 
                  <a class="deleteBtn" href="admin/comment-delete-<?= $comment->getId() ?>.html">Supprimer</a> <?php
          } ?>

          | <a href="signaler-<?= $news->getId() ?>-<?= $comment->getId() ?>.html">Signaler</a>

        </legend>

        <p><?= nl2br(htmlspecialchars($comment->getContenu())) ?></p>

      </fieldset>
    <?php
    }
    ?>
    <p><a href="commenter-<?= $news->getId() ?>.html">Ajouter un commentaire</a></p>

  </div>

</div>