</div>
<footer class="footer">
	<h2 class="sro">Pied de page</h2>
	<div class="footer__socials socials">
		<ul class="socials__list">
			<li class="socials__item">Linkedin</li>
			<li class="socials__item">Github</li>
		</ul>
	</div>
	<div class="footer__others others">
		<a href="<?= get_permalink ( JMPortfolio_get_template_page ( 'template-conditions' ) ) ?>">Conditions générales</a>
		<a href="<?= get_permalink ( JMPortfolio_get_template_page ( 'template-legacy' ) ) ?>">Mentions légales</a>
	</div>
</footer>
<script type="text/javascript" src="<?= JMPortfolio_mix ( '/js/script.js' ) ?>"></script>
</body>
</html>