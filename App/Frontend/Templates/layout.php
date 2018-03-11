<!DOCTYPE html>
<html>
	<head>
		<title>
			<?= isset($title) ? $title : 'Mon super site' ?>
		</title>

		<meta charset="utf-8">

		<link rel="stylesheet" href="../Web/css/Envision.css" type="text/css" />
	</head>

	<body>
		<div id="wrap">
			<header>
				<h1><a href="/">Mon super site</a></h1>
				<p>Déjà presque fini</p>
			</header>

			<nav>
				<ul>
					<li><a href="/php/projet4/Web/bootstrap.php">Accueil</a></li>
					<?php if($user->isAuthenticated()) { ?>
						<li><a href="/php/projet4/Web/admin/">Admin</a></li>
						<li><a href="/php/projet4/Web/admin/news-insert.html">Ajouter une news</a></li>
					<?php } ?>
				</ul>
			</nav>

			<div id="content-wrap">
				<section id="main">
					<?php if($user->hasFlash()) {
							echo '<p>'.$user->getFlash().'</p>';
					 	} ?>
					<?= $content ?>
				</section>
			</div>

			<footer></footer>
		</div>
	</body>
</html>