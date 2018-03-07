<p>Par <em><?= $news->getAuteur() ?></em>, le <?= $news->getDateAjout()->format('d/m/Y à H\hi') ?></p>
<h2><?= $news->getTitre() ?></h2>
<p><?= nl2br($news->getContenu()) ?></p>

<?php if ($news->getDateAjout() != $news->getDateModif()) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news->getDateModif()->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>

<p><a href="commenter-<? $news->getId() ?>.html">Ajouter un commentaire</a></p>

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
      Posté par <strong><?= htmlspecialchars($comment->getAuteur()) ?></strong> le <?= $comment->getDate()->format('d/m/Y à H/hi') ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment->getContenu())) ?></p>
  <fieldset>
<?php
}
?>

<p><a href="commenter-<?= $news->getId() ?>.html">Ajouter un commentaire</a></p>