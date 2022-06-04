<!DOCTYPE html>
<html lang="fr_BE">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description"
			  content="Justin Massart, le WebMaster à vos côtés.">
		<title>
			<?= get_bloginfo ( 'name' ); ?><?= wp_title ( '•' ); ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?= JMPortfolio_mix ( '/css/style.css' ) ?>"/>
		<script type="text/javascript" src="<?= JMPortfolio_mix ( '/js/script.js' ) ?>"></script>
		<?php wp_head (); ?>
	</head>
	<body class="body">
		<div class="body__container">
			<header class="header">
				<div class="header__wrapper">
					<h1 class="header__title sro">
						Justin Massart • WebMaster
					</h1>
					<div class="header__burger">
						<nav class="header__nav nav">
							<h2 class="nav__title sro">
								Navigation principale
							</h2>
							<ul class="nav__container">
								<li class="nav__item">Sur moi</li>
								<li class="nav__item">Mes projets</li>
								<li class="nav__item">Contact</li>
							</ul>
							<div class="nav__cta cta">
								<a href="<?= get_permalink ( JMPortfolio_get_template_page ( ( 'template-contact' ) ) ) ?>"
								   class="nav__contact">
									Contactez moi
								</a>
							</div>
						</nav>
					</div>
				</div>
			</header>