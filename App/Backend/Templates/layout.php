<!DOCTYPE html>
<html>
	<head>
		<title>
			<?= isset($title) ? $title : 'Mon super site' ?>
		</title>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- Template CSS "Keep It Simple" /!\ Lien relatif différent car routage /admin/ en backend -->		
		<link rel="stylesheet" href="../css/default.css">
		<link rel="stylesheet" href="../css/layout.css">  
		<link rel="stylesheet" href="../css/media-queries.css">   

		<script src="js/modernizr.js"></script>

		<!-- TinyMCE Cloud service -->
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea.editor' });</script>

	</head>

	<body>
		<div id="wrap">

			<!-- HEADER -->

			<header id="top">

				<!-- Titre du blog -->
				<div class="row">
					<div class="header-content twelve columns">
						<h1 id="logo-text"><a href="<?= $config->get('root') ?>/">Mon super site</a></h1>
						<p id="intro">Déjà presque fini</p>
					</div>
				</div>
			
				<!-- Menu -->
				<nav id="nav-wrap">

					<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
					<a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>

					<div class="row">
						<ul id="nav" class="nav">
							<li><a href="<?= $config->get('root') ?>/">Accueil</a></li>
							<?php if($user->isAuthenticated()) { ?>
								<li><a href="<?= $config->get('root') ?>/admin/">Admin</a></li>
								<li><a href="<?= $config->get('root') ?>/admin/news-insert.html">Ajouter une news</a></li>
							<?php } ?>
						</ul>
					</div>

				</nav>

			</header>


			<!-- CONTENT -->

			<div id="content-wrap">

				<section id="main">

					<!-- User Flash -->
					<div class="row add-bottom">
						<div class="twelve columns add-bottom">

							<?php if($user->hasFlash()) {
									echo '<p>'.$user->getFlash().'</p>';
								} ?>

						</div>
					</div>

					<!-- Generated view -->
					<div class="row add-bottom">
						<div class="twelve columns">

							<?= $content ?>
					
						</div>
					</div>

				</section>

			</div>

			<footer></footer>

		</div> <!-- end #wrap -->
	</body>
</html>