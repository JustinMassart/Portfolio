<!DOCTYPE html>
<html class="no-js" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description"
			  content="Justin Massart, le WebMaster à vos côtés.">
		<title>
			<?= get_bloginfo ( 'name' ); ?><?= wp_title ( '•' ); ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?= JMPortfolio_mix ( '/css/style.css' ) ?>"/>
		<?php wp_head (); ?>
	</head>
	<body class="body">
		<div class="body__container">
			<header class="header">
				<h1 class="header__title sro">
					Justin Massart • WebMaster
				</h1>
				<div class="header__logo">
					<?= JMPortfolio_get_svg ( 'Logo' ) ?>
				</div>
				<div class="header__burger">
					<?= JMPortfolio_get_svg ( 'burger' ) ?>
				</div>
				<div class="header__navigation menu">
					<nav class="header__nav nav">
						<h2 class="nav__title sro">
							Navigation principale
						</h2>
						<ul class="nav__container">
							<li class="nav__item">
								<a href="#about" title="Aller à la section À propos">
									À propos
								</a>
							</li>
							<li class="nav__item">
								<a href="#projects" title="Aller à la section des Projets">
									Projects
								</a>
							</li>
							<li class="nav__item">
								<a href="#languages" title="Aller à la section des languages">
									Languages
								</a>
							</li>
							<li class="nav__item">
								<a href="#contact" title="Aller à la section du formulaire de contact">
									Contact
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</header>