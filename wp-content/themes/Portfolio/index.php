<?php get_header () ?>
	<main class="main">
		<section class="main__landing landing">
			<h2 class="landing__title title">
				<span class="title__firstname">Justin</span>
				<span class="title__lastname">Massart</span>
			</h2>
			<span class="landing__desc">Un WebMaster à vos côtés</span>
		</section>
		<section id="about" class="main__about about">
			<h2 class="landing__title title sro">À propos de Justin Massart</h2>
			<section class="about__qualities qualities">
				<h3 class="qualities__title sro">Trois qualités</h3>
				<span class="qualities__quality">Curiosité</span>
				<span class="qualities__quality">Persévérance</span>
				<span class="qualities__quality">Apprentissage</span>
			</section>
			<section class="about__school school">
				<h3 class="school__title sro">À l’école</h3>
				<div class="school__establishment">
					<span class="school__title">École</span>
					<div class="border"></div>
					<span class="school__name">HEPL Inpres</span>
					<span class="school__years">2018 - 2023</span>
				</div>
				<div class="school__study">
					<span class="school__title">Étude</span>
					<div class="border"></div>
					<p class="school__learning">
						Le développement et le design des sites web sont mon quotidien. Découvrez quelques-uns de mes projets ci-dessous.
					</p>
				</div>
			</section>
		</section>
		<section id="projects" class="main__projects projects">
			<h2 class="projects__name sro">Les projets réalisés par Justin Massart</h2>
			<?php if ( JMPortfolio_get_projects () !== null ): ?>
				<?php if ( ( $projects = JMPortfolio_get_projects () ) -> have_posts () ): while ( $projects -> have_posts () ): $projects -> the_post ();
					include ( __DIR__ . '/partials/project.php' ); endwhile; endif; ?>
			<?php else: ?>
				<span class="projects__error">Oups ! On dirait qu’il n’y a pas encore de projects à afficher. Revenez plus tard !</span>
			<?php endif; ?>
		</section>
		<section id="languages" class="main__languages languages">
			<h2 class="languages__title sro">Les languages appris par Justin Massart</h2>
			<?php if ( JMPortfolio_get_codes () !== null ): ?>
				<?php if ( ( $codes = JMPortfolio_get_codes () ) -> have_posts () ): while ( $codes -> have_posts () ): $codes -> the_post ();
					include ( __DIR__ . '/partials/code.php' ); endwhile; endif; ?>
			<?php else: ?>
				<span class="projects__error">Oups ! On dirait qu’il n’y a pas encore de languages à afficher. Revenez plus tard !</span>
			<?php endif; ?>
		</section>
		<section id="contact" class="main__contact contact">
			<?php include ( __DIR__ . '/partials/form.php' ) ?>
		</section>
	</main>
<?php
	get_footer ();
	unset( $_SESSION[ 'feedback_contact_form' ] );
?>