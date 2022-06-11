<h2 class="contact__title">
	<span class="contact__want">Envie de discuter ?</span>
	<span class="contact__doit">Contactez-moi !</span>
</h2>
<form action="<?= 'http://portfolio.test' ?>/wp-admin/admin-post.php" method="POST" class="contact__form form">
	<?php if ( isset( $_SESSION[ 'feedback_contact_form' ] ) && !$_SESSION[ 'feedback_contact_form' ][ 'success' ] ) : ?>
		<p class="form__errors">
			Oups ! Ce formulaire contient des erreurs, merci de les corriger.
		</p>
	<?php endif; ?>
	<div class="form__grid">
		<div class="form__field name inputs">
			<label for="firstname" class="form__label">Votre prénom</label>
			<input type="text" name="firstname" id="firstname" class="form__input input<?= JMPortfolio_get_errors_style ( 'firstname' ) ?>"
				   value="<?= JMPortfolio_get_contact_field_value ( 'firstname' ) ?>" placeholder="Votre prénom"/>
			<span class="form__placeholder">Votre prénom</span>
			<?= JMPortfolio_get_contact_field_error ( 'firstname' ) ?>
		</div>
		<div class="form__field lastname inputs">
			<label for="lastname" class="form__label">Votre nom</label>
			<input type="text" name="lastname" id="lastname" class="form__input input<?= JMPortfolio_get_errors_style ( 'lastname' ) ?>"
				   value="<?= JMPortfolio_get_contact_field_value ( 'lastname' ) ?>" placeholder="Votre nom"/>
			<span class="form__placeholder">Votre nom</span>
			<?= JMPortfolio_get_contact_field_error ( 'lastname' ) ?>
		</div>
		<div class="form__field email inputs">
			<label for="email" class="form__label">Votre adresse e-mail</label>
			<input type="email" name="email" id="email" class="form__input input<?= JMPortfolio_get_errors_style ( 'email' ) ?>"
				   value="<?= JMPortfolio_get_contact_field_value ( 'email' ) ?>" placeholder="Votre email"/>
			<span class="form__placeholder">Votre adresse e-mail</span>
			<?= JMPortfolio_get_contact_field_error ( 'email' ) ?>
		</div>
		<div class="form__field work inputs">
			<label for="work" class="form__label">Votre profession</label>
			<input type="text" name="work" id="work" class="form__input input"
				   value="<?= JMPortfolio_get_contact_field_value ( 'work' ) ?>" placeholder="Votre profession"/>
			<span class="form__placeholder">Votre profession</span>
		</div>
		<div class="form__field subject">
			<label class="form__label" for="subject">Votre message est à propos de ...</label>
			<select class="form__select<?= JMPortfolio_get_errors_style ( 'subject' ) ?>" name="subject" id="subject">
				<option value="" selected disabled>
					Sélectionner un sujet ici
				</option>
				<option value="plus" class="form__option">
					En savoir plus sur mon travail
				</option>
			</select>
			<?= JMPortfolio_get_contact_field_error ( 'subject' ) ?>
		</div>
		<div class="form__field message inputs">
			<label for="message" class="form__label">Votre message</label>
			<textarea name="message" id="message" cols="30" rows="10"
					  class="form__input form__textarea input<?= JMPortfolio_get_errors_style ( 'message' ) ?>"
					  placeholder="Votre message"><?= JMPortfolio_get_contact_field_value ( 'message' ) ?></textarea>
			<span class="form__placeholder">Votre message</span>
			<?= JMPortfolio_get_contact_field_error ( 'message' ) ?>
		</div>
		<div class="form__field rules">
			<label for="rules" class="form__checkbox <?= JMPortfolio_get_errors_style ( 'rules' ) ?>">
				<input type="checkbox" name="rules" id="rules" class="form__checker" value="1">
				<span class="form__checklabel">
					J’ai lu et j’accepte les conditions générales d’utilisation.
				</span>
			</label>
			<?= JMPortfolio_get_contact_field_error ( 'rules' ) ?>
		</div>
		<div class="form__actions">
			<input type="hidden" name="action" value="submit_contact_form"/>
			<?php wp_nonce_field ( 'nonce_check_contact_form' ); ?>
			<button type="submit" class="form__button cta">Envoyer</button>
		</div>
	</div>
</form>