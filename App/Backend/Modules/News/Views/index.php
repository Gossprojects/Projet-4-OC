<p>Il y a actuellement <?= $nombreNews ?> article(s) sur le site. On vous a signalé <?= $flaggedComments ?> commentaire(s).</p>

<li><a href="<?= $config->get('root') ?>/admin/news-insert.html">Ajouter un article</a></li>
<li><a href="<?= $config->get('root') ?>/admin/comments-index.html">Modérer les commentaires</a></li>
<br />

<h2>Gestion des articles</h2>
<br />

<table>

  <tr><th class="desktopCol">Auteur</th><th>Titre</th><th class="desktopCol">Date d'ajout</th><th class="desktopCol">Dernière modification</th><th>Action</th></tr>

<?php
foreach ($listeNews as $news)
{
  echo '<tr>
          <td class="desktopCol">', $news->getAuteur(), '</td>
          <td>', $news->getTitre(), '</td>
          <td class="desktopCol">', $news->getDateAjout()->format('d/m/Y à H\hi'), '</td>
          <td class="desktopCol">', ($news->getDateAjout() == $news->getDateModif() ? '-' : $news->getDateModif()->format('d/m/Y à H\hi')), '</td>
          <td>
            <a href="news-update-', $news->getId(), '.html">
              <img style="max-width:20px;" src="'.$config->get('root').'/css/img/update.png" alt="Modifier" />
            </a> 
            <a href="news-delete-', $news->getId(), '.html" class="deleteBtn">
              <img style="max-width:20px;" src="'.$config->get('root').'/css/img/delete.png" alt="Supprimer" />
            </a>
          </td>
        </tr>', "\n";
}
?>

</table>

