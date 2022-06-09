<div class="projects__project project">
	<div class="project__imgContainer">
		<?= JMPortfolio_get_template_by_extension ( get_field ( 'project_image' ), 'medium' ) ?>
	</div>
	<div class="project__desc">
		<h3 class="project__title">
			<?= get_field ( 'project_name' ) ?>
		</h3>
		<span class="project__date">
			<?= get_field ( 'project_date' ) ?>
		</span>
	</div>
</div>