<h2>Modération des commentaires</h3>
<br />

<table>
  <tr><th>Auteur</th><th>Posté le</th><th>Contenu</th><th>Signalements</th><th>Action</th></tr>

<?php
foreach ($commentsList as $comment)
{
  echo '<tr>
          <td>', $comment->getAuteur(), '</td>
		  <td>', $comment->getDate()->format('d/m/Y à H\hi'), '</td>
		  <td>', $comment->getContenu(), '</td>
		  <td>', $comment->getFlagged(), '</td>
          <td>
            <a href="comment-delete-', $comment->getId(), '.html" class="deleteBtn">
              <img style="max-width:20px;" src="'.$config->get('root').'/images/delete.png" alt="Supprimer" />
            </a>
          </td>
        </tr>', "\n";
}
?>

</table>

<!-- Comment delete confirmation function -->
<script>
  var deleteBtns = document.getElementsByClassName('deleteBtn');

  for(var i = 0; i < deleteBtns.length; i++) {

    deleteBtns[i].onclick = function askConfirm() {
      if(confirm("Êtes-vous sûr de vouloir supprimer ce commentaire ?") == true) {
        return true;
      }
      else
        return false;
    }

  }
</script>

