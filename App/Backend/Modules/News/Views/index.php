<p>Il y a actuellement <?= $nombreNews ?> articles sur le site.</p>

<li><a href="<?= $config->get('root') ?>/admin/news-insert.html">Ajouter un article</a></li>
<br />

<table style="width:100%;">
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>

<?php
foreach ($listeNews as $news)
{
  echo '<tr>
          <td>', $news->getAuteur(), '</td>
          <td>', $news->getTitre(), '</td>
          <td>', $news->getDateAjout()->format('d/m/Y à H\hi'), '</td>
          <td>', ($news->getDateAjout() == $news->getDateModif() ? '-' : $news->getDateModif()->format('d/m/Y à H\hi')), '</td>
          <td>
            <a href="news-update-', $news->getId(), '.html">
              <img style="max-width:20px;" src="'.$config->get('root').'/images/update.png" alt="Modifier" />
            </a> 
            <a href="news-delete-', $news->getId(), '.html" class="deleteBtn">
              <img style="max-width:20px;" src="'.$config->get('root').'/images/delete.png" alt="Supprimer" />
            </a>
          </td>
        </tr>', "\n";
}
?>

</table>

<!-- Function de confirmation pour suppression d'un article -->
<script>
  var deleteBtns = document.getElementsByClassName('deleteBtn');

  for(var i = 0; i < deleteBtns.length; i++) {

    deleteBtns[i].onclick = function askConfirm() {
      if(confirm("Êtes-vous sûr de vouloir supprimer cet article ?") == true) {
        return true;
      }
      else
        return false;
    }

  }
</script>

