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
				<h1><a href="<?= $config->get('root') ?>/">Mon super site</a></h1>
				<p>Déjà presque fini</p>
			</header>

			<nav>
				<ul>
					<li><a href="<?= $config->get('root') ?>/">Accueil</a></li>
					<?php if($user->isAuthenticated()) { ?>
						<li><a href="<?= $config->get('root') ?>/admin/">Admin</a></li>
						<li><a href="<?= $config->get('root') ?>/admin/news-insert.html">Ajouter une news</a></li>
						<li><a href="<?= $config->get('root') ?>/admin/password-update.html">Changer de mot de passe</a></li>
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