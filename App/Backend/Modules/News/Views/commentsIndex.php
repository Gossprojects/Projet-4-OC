<h2>Modération des commentaires</h3>
<br />

<?php
if(!empty($commentsList)) { ?>
	<table>
	<tr><th>Auteur</th><th class="desktopCol">Posté le</th><th>Contenu</th><th class="desktopCol">Signalements</th><th>Action</th></tr>
  
  <?php
  foreach ($commentsList as $comment)
  {
	echo '<tr>
			<td>', $comment->getAuteur(), '</td>
			<td class="desktopCol">', $comment->getDate()->format('d/m/Y à H\hi'), '</td>
			<td>', $comment->getContenu(), '</td>
			<td class="desktopCol">', $comment->getFlagged(), '</td>
			<td>
			  <a href="comment-delete-', $comment->getId(), '.html" class="deleteBtn">
				<img style="max-width:20px;" src="'.$config->get('root').'/css/img/delete.png" alt="Supprimer" />
			  </a>
			</td>
		  </tr>', "\n";
  }
  ?>
  
  </table>
<?php
}
else {
	echo "Aucun commentaire ne vous a été signalé.";
}

