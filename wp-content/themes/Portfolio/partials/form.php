<h3 class="sro">
	<?= __( 'Formulaire pour contacter Noair • Antilope', 'NOair' ) ?>
</h3>
<form action="<?= 'http://noair.test' ?>/wp-admin/admin-post.php" method="POST" class="contact__form form">
	<?php if ( isset( $_SESSION[ 'feedback_contact_form' ] ) && ! $_SESSION[ 'feedback_contact_form' ][ 'success' ] ) : ?>
		<p class="form__errors"><?= __( 'Oups ! Ce formulaire contient des erreurs, merci de les corriger.', 'NOair' ); ?></p>
	<?php endif; ?>
	<div class="form__grid">
		<div class="form__field name">
			<label for="firstname" class="form__label"><?= __( 'Votre prénom', 'NOair' ); ?></label>
			<input type="text" name="firstname" id="firstname" class="form__input input<?= isset( $_SESSION[ 'errors' ][ 'firstname' ] ) ? ' redBorder' : '' ?>"
				   value="<?= NOair_get_contact_field_value( 'firstname' ); ?>" placeholder="<?= __( 'Votre prénom', 'NOair' ); ?>"/>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'firstname' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Le champs "Votre prénom" est requis pour envoyer le formulaire. Merci de le compléter.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__field lastname">
			<label for="lastname" class="form__label"><?= __( 'Votre nom', 'NOair' ); ?></label>
			<input type="text" name="lastname" id="lastname" class="form__input input<?= isset( $_SESSION[ 'errors' ][ 'lastname' ] ) ? ' redBorder' : '' ?>"
				   value="<?= NOair_get_contact_field_value( 'lastname' ); ?>" placeholder="<?= __( 'Votre nom', 'NOair' ); ?>"/>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'lastname' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Le champs "Votre nom" est requis pour envoyer le formulaire. Merci de le compléter.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__field email">
			<label for="email" class="form__label"><?= __( 'Votre adresse e-mail', 'NOair' ); ?></label>
			<input type="email" name="email" id="email" class="form__input input<?= isset( $_SESSION[ 'errors' ][ 'email' ] ) ? ' redBorder' : '' ?>"
				   value="<?= NOair_get_contact_field_value( 'email' ); ?>" placeholder="<?= __( 'Votre email', 'NOair' ); ?>"/>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'email' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Le champs "Votre email" est requis pour envoyer le formulaire. Merci de le compléter.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__field work">
			<label for="work" class="form__label"><?= __( 'Votre profession', 'NOair' ); ?></label>
			<input type="tel" name="work" id="work" class="form__input input"
				   value="<?= NOair_get_contact_field_value( 'work' ); ?>" placeholder="<?= __( 'Votre profession', 'NOair' ); ?>"/>
		</div>
		<div class="form__field subject">
			<label class="form__label" for="subject"><?= __( 'Votre message est à propos de ...', 'NOair' ) ?></label>
			<select class="form__select<?= isset( $_SESSION[ 'errors' ][ 'subject' ] ) ? ' redBorder' : '' ?>" name="subject" id="subject">
				<option value="" selected disabled>
					<?= __( 'Sélectionner un sujet ici', 'NOair' ) ?>
				</option>
				<option value="installation" class="form__option">
					<?= __( 'Achat/Installation d’un module', 'NOair' ) ?>
				</option>
				<option value="modules" class="form__option">
					<?= __( 'Informations sur les modules', 'NOair' ) ?>
				</option>
				<option value="engineer" class="form__option">
					<?= __( 'Informations sur la section ingénieur de la HEPL', 'NOair' ) ?>
				</option>
				<option value="issep" class="form__option">
					<?= __( 'Informations sur l’ISSeP', 'NOair' ) ?>
				</option>
			</select>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'subject' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Un sujet est requis pour envoyer le formulaire. Merci d’en choisir un.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__field message">
			<label for="message" class="form__label"><?= __( 'Votre message', 'NOair' ); ?></label>
			<textarea name="message" id="message" cols="30" rows="10"
					  class="form__input form__textarea input<?= isset( $_SESSION[ 'errors' ][ 'message' ] ) ? ' redBorder' : '' ?>"
					  placeholder="<?= __( 'Votre message', 'NOair' ); ?>"><?= NOair_get_contact_field_value( 'message' ); ?></textarea>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'email' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Un sujet est requis pour envoyer le formulaire. Merci d’en choisir un.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__field rules">
			<label for="rules" class="form__checkbox <?= isset( $_SESSION[ 'errors' ][ 'rules' ] ) ? ' redBorder' : '' ?>">
				<input type="checkbox" name="rules" id="rules" class="form__checker" value="1">
				<span class="form__checklabel"><?= str_replace(
						':conditions',
						'<a href="#">' . __( 'conditions générales d’utilisation', 'NOair' ) . '</a>',
						__( 'J’ai lu et j’accepte les :conditions.', 'NOair' )
					); ?>
				</span>
			</label>
			<?php if ( isset( $_SESSION[ 'errors' ][ 'rules' ] ) ): ?>
				<span class="input__error">
					<?= __( 'Vous devez accepter les conditions générales d’utilisations pour envoyer le formulaire.', 'NOair' ) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="form__actions">
			<input type="hidden" name="action" value="submit_contact_form"/>
			<?php wp_nonce_field( 'nonce_check_contact_form' ); ?>
			<button type="submit" class="form__button cta"><?= __( 'Envoyer', 'NOair' ); ?></button>
		</div>
	</div>
</form>