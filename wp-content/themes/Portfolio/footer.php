</div>
<footer class="footer">
	<h2 class="sro">Pied de page</h2>
	<div class="footer__grid">
		<div class="footer__logo">
			<?= JMPortfolio_get_svg ( 'Logo' ) ?>
		</div>
		<div class="footer__socials socials">
			<ul class="socials__list">
				<li class="socials__item">
					<a href="https://www.linkedin.com/in/justin-massart-90736b235/" title="Aller sur le profil Linkedin de Justin Massart">
						<?= JMPortfolio_get_svg ( 'linkedin' ) ?>
					</a>
				</li>
				<li class="socials__item">
					<a href="https://github.com/JustinMassart" title="Aller sur le profil Github de Justin Massart">
						<?= JMPortfolio_get_svg ( 'github' ) ?>
					</a>
				</li>
			</ul>
		</div>
		<div class="footer__others others">
			<a class="footer__conditions" href="<?= get_permalink ( JMPortfolio_get_template_page ( 'template-conditions' ) ) ?>">Conditions générales</a>
			<a class="footer__legacy" href="<?= get_permalink ( JMPortfolio_get_template_page ( 'template-legacy' ) ) ?>">Mentions légales</a>
		</div>
	</div>
</footer>
<script type="text/javascript" src="<?= JMPortfolio_mix ( '/js/script.js' ) ?>"></script>
</body>
</html>