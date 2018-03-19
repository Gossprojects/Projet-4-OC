<p>Il y a actuellement <?= $nombreNews ?> articles sur le site.</p>

<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeNews as $news)
{
  echo '<tr><td>', $news->getAuteur(), 
  '</td><td>', $news->getTitre(), 
  '</td><td>le ', $news->getDateAjout()->format('d/m/Y à H\hi'), 
  '</td><td>', ($news->getDateAjout() == $news->getDateModif() ? '-' : 'le '.$news->getDateModif()->format('d/m/Y à H\hi')), 
  '</td><td><a href="news-update-', $news->getId(), '.html">
  <img src="/images/update.png" alt="Modifier" /></a> 
  <a href="news-delete-', $news->getId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>
