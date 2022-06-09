<!DOCTYPE html>
<html lang="fr">
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
				<div class="header__container">
					<h1 class="header__title sro">
						Justin Massart • WebMaster
					</h1>
					<div class="header__burger">
						<nav class="header__nav nav">
							<h2 class="nav__title sro">
								Navigation principale
							</h2>
							<ul class="nav__container">
								<li class="nav__item">À propos</li>
								<li class="nav__item">Projects</li>
								<li class="nav__item">Languages</li>
								<li class="nav__item">Contact</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>