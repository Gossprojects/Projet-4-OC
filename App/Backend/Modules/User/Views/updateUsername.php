<p>Votre nom d'administrateur actuel est "<?= $_SESSION['username'] ?>"</p>

<h2>Modifier le nom d'administrateur</h2>
<br />

<form action="" method="POST">
	<label for="username">Nouveau nom d'administrateur</label>
	<input type="text" name="username">

	<label for="password">Mot de passe</label>
	<input type="password" name="password">
	<br />
	<input type="submit" value="Connexion">
</form>