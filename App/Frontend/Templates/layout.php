<!DOCTYPE html>
<html>
	<head>
		<title>
			<?= isset($title) ? $title : 'Billet simple pour l\'Alaska' ?>
		</title>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- Template CSS "Keep It Simple" -->		
		<link rel="stylesheet" href="css/default.css">
		<link rel="stylesheet" href="css/layout.css">  
		<link rel="stylesheet" href="css/media-queries.css">   

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

						<h1 id="logo-text"><a href="<?= $config->get('root') ?>/">Billet simple pour l'Alaska</a></h1>
						<p id="intro">Un roman au compte-gouttes</p>

					</div>
				</div>
			
				<!-- Menu -->
				<nav id="nav-wrap">

					<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
					<a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>

					<div class="row">

						<ul id="nav" class="nav">
							
							<li class="menuTab" id="home"><a href="<?= $config->get('root') ?>/">Accueil</a></li>

							<?php if($user->isAuthenticated()) { ?>

								<li class="menuTab"><a href="<?= $config->get('root') ?>/admin/">Articles</a></li>
								<li class="menuTab"><a href="<?= $config->get('root') ?>/admin/comments-index.html">Commentaires</a></li>
								<li class="menuTab has-children"><a href="#">Profil</a>
									<ul>
										<li><a href="<?= $config->get('root') ?>/admin/username-update.html">Changer de pseudo</a></li>
										<li><a href="<?= $config->get('root') ?>/admin/password-update.html">Changer de mot de passe</a></li>
									</ul>
								</li>
							<?php } ?>

						</ul>

					</div>

				</nav>

			</header>

			<!-- CONTENT -->
			<div id="content-wrap">

				<section id="main">

					<!-- User Flash -->
					<div class="row">
						<div class="twelve columns">

							<?php if($user->hasFlash()) {
									echo '<mark>'.$user->getFlash().'</mark>';
								} ?>

						</div>
					</div>

					<!-- Generated view -->
					<div class="row">
						<div class="twelve columns add-bottom">

							<?= $content ?>
					
						</div>
					</div>

				</section>

			</div>

			<!-- NAVIGATION -->
			<div class="row">
				<div class="twelve columns">
				
				<?php if(isset($pages)) {

					echo "<nav class='pagination add-bottom'>";
					
					// Bouton précédent
					if(intval($currentPage) == 1) {
						echo '<a class="page-numbers prev inactive">Prec</a>';
					}
					else {
						echo '<a href="?page='.($currentPage-1).'.html" class="page-numbers prev">Prec</a>';
					}

						// Numéros de page	
						for($i = 0; $i < $pages; $i++) {
							$class = ($currentPage == ($i+1)) ? "page-numbers current" : "page-numbers";
							echo '<a href="?page='.($i+1).'.html" class="'.$class.'">'.($i+1).'</a>';
						}
					
					// Bouton suivant
					if(intval($currentPage) == intval($pages)) {
						echo '<a class="page-numbers next inactive">Suiv</a>';
					}
					else {
						echo '<a href="?page='.($currentPage+1).'.html" class="page-numbers next">Suiv</a>';
					}	

					echo "</nav>";
				} ?>
	
				</div>
			</div> <!-- Row End-->

			<!-- FOOTER -->
			<footer>
				<div class="row">
					<div class="four columns add-bottom">

						<a href="<?= $config->get('root') ?>/admin/">Administration</a>
						<br />
						<?php	if($user->isAuthenticated()) { ?>
						<a href="<?= $config->get('root') ?>/admin/disconnect.html">Déconnexion</a>
						<?php } ?>

					</div>
				</div>
			</footer>

		</div> <!-- end #wrap -->
		
		<!-- Top top button -->
		<div id="go-top"><a class="smoothscroll" title="Back to Top" href="#top"><i class="fa fa-chevron-up"></i></a></div>
	
	<!-- Template Javascript 'Keep it Simple' -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
	<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>  
	<script src="js/main.js"></script>

	<!-- Confirmation alert when deleting articles or comments -->
	<script src="js/confirm.js"></script>
	<!-- Dyanmic CSS for nav tabs -->
	<script type="text/javascript">var current = '<?php echo $pageId; ?>';</script>
	<script type="text/javascript" src="js/menu.js"></script>
	</body>
</html>