<?php

	use JetBrains\PhpStorm\ArrayShape;

	require_once ( __DIR__ . '/Menus/PrimaryMenuItem.php' );

	// Lancer la session PHP

	add_action ( 'init', 'JMPortfolio_boot_theme', 1 );

	function JMPortfolio_boot_theme (): void
	{
		load_theme_textdomain ( 'JMPortfolio', __DIR__ . '/locales' );

		if ( !session_id () ) {
			session_start ();
		}
	}

// Désactiver l'éditeur "Gutenberg" de Wordpress
	add_filter ( 'use_block_editor_for_post', '__return_false' );
	add_filter ( 'use_block_editor_for_post', '__return_false' );

// Autoriser l'upload de SVG par l’admin

	add_filter ( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes )
	{

		global $wp_version;
		if ( $wp_version !== '4.7.1' ) {
			return $data;
		}

		$filetype = wp_check_filetype ( $filename, $mimes );

		return [
			'ext' => $filetype[ 'ext' ],
			'type' => $filetype[ 'type' ],
			'proper_filename' => $data[ 'proper_filename' ]
		];

	}, 10, 4 );

	function cc_mime_types ( $mimes )
	{
		$mimes[ 'svg' ] = 'image/svg+xml';

		return $mimes;
	}

	add_filter ( 'upload_mimes', 'cc_mime_types' );

	function fix_svg ()
	{
		echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
	}

	add_action ( 'admin_head', 'fix_svg' );

	// Enregistrer un seul custom post-type pour les projets

	register_post_type ( 'project', [
		'label' => 'Projets',
		'labels' => [
			'name' => 'Projets',
			'singular_name' => 'Projet',
		],
		'description' => 'Tous les projets réalisé par Justin Massart.',
		'public' => false,
		'show_ui' => true,
		'menu_position' => 16,
		'menu_icon' => 'dashicons-welcome-add-page',
		'supports' => [ 'title' ],
	] );

	// Requête Wordpress pour la boucle des projets

	function JMPortfolio_get_projects (): WP_Query
	{
		return new WP_Query( [
			'post_type' => 'project',
			'orderby' => 'date',
			'order' => 'DESC'
		] );
	}

	// Enregistrer un seul custom post-type pour les codes

	register_post_type ( 'code', [
		'label' => 'Codes',
		'labels' => [
			'name' => 'Codes',
			'singular_name' => 'Code',
		],
		'description' => 'Tous les codes appris par Justin Massart.',
		'public' => false,
		'show_ui' => true,
		'menu_position' => 17,
		'menu_icon' => 'dashicons-editor-code',
		'supports' => [ 'title' ],
	] );

	// Requête Wordpress pour la boucle des codes

	function JMPortfolio_get_codes (): WP_Query
	{
		return new WP_Query( [
			'post_type' => 'code',
			'orderby' => 'date',
			'order' => 'ASC'
		] );
	}

	// Enregistrer un seul custom post-type pour les messages

	register_post_type ( 'message', [
		'label' => 'Messages de contact',
		'labels' => [
			'name' => 'Messages de contact',
			'singular_name' => 'Message de contact',
		],
		'description' => 'Les messages envoyés par les utilisateurs via le formulaire de contact.',
		'public' => false,
		'show_ui' => true,
		'menu_position' => 18,
		'menu_icon' => 'dashicons-buddicons-pm',
		'capabilities' => [
			'create_posts' => false,
		],
		'map_meta_cap' => true,
	] );

// Enregistrer le traitement du formulaire de contact personnalisé.

	add_action ( 'admin_post_nopriv_submit_contact_form', 'JMPortfolio_handle_submit_contact_form' );
	add_action ( 'admin_post_submit_contact_form', 'JMPortfolio_handle_submit_contact_form' );

	function JMPortfolio_handle_submit_contact_form ()
	{

		if ( !JMPortfolio_verify_contact_form_nonce () ) {
			header ( "HTTP/1.1 401 Unauthorized" );
			exit;
		}

		$data = JMPortfolio_sanitize_contact_form_data ();


		if ( $errors = JMPortfolio_validate_contact_form_data ( $data ) ) {
			$_SESSION[ 'feedback_contact_form' ] = [
				'success' => false,
				'data' => $data,
				'errors' => $errors,
			];

			return wp_redirect ( $_POST[ '_wp_http_referer' ] );
		}

		// Stocker en base de données
		$id = wp_insert_post ( [
			'post_type' => 'message',
			'post_title' => 'Message de ' . strtoupper ( $data[ 'firstname' ] ) . ' ' . strtoupper ( $data[ 'lastname' ] ) . ' à propos de ' . strtoupper ( $data[ 'subject' ] ),
			'post_content' => 'Prénom et NOM (travail) : ' . $data[ 'firstname' ] . ' ' . strtoupper ( $data[ 'lastname' ] ) . ' (' . $data[ 'work' ] . ')' . '<br/>' . 'Adresse email : ' . $data[ 'email' ] . '<br/>' . 'À propos de : ' . $data[ 'subject' ] . '<br/>' . 'Message : ' . $data[ 'message' ],
			'post_status' => 'publish',
		] );

		return wp_redirect ( $_POST[ '_wp_http_referer' ] );
	}

	function JMPortfolio_verify_contact_form_nonce (): bool|int
	{
		$nonce = $_POST[ '_wpnonce' ];

		return wp_verify_nonce ( $nonce, 'nonce_check_contact_form' );
	}

	#[ArrayShape( [
		'firstname' => "string",
		'lastname' => "string",
		'email' => "string",
		'work' => "string",
		'subject' => "string",
		'message' => "string",
		'rules' => "mixed|null"
	] )] function JMPortfolio_sanitize_contact_form_data (): array
	{

		return [
			'firstname' => sanitize_text_field ( $_POST[ 'firstname' ] ?? null ),
			'lastname' => sanitize_text_field ( $_POST[ 'lastname' ] ?? null ),
			'email' => sanitize_email ( $_POST[ 'email' ] ?? null ),
			'work' => sanitize_text_field ( $_POST[ 'work' ] ?? null ),
			'subject' => sanitize_text_field ( $_POST[ 'subject' ] ?? null ),
			'message' => sanitize_text_field ( $_POST[ 'message' ] ?? null ),
			'rules' => $_POST[ 'rules' ] ?? null
		];
	}

	function JMPortfolio_validate_contact_form_data ( $data ): bool|array
	{
		$errors = [];

		$required = [ 'firstname', 'lastname', 'email', 'message', 'subject' ];
		$email = [ 'email' ];
		$accepted = [ 'rules' ];

		foreach ( $data as $key => $value ) {
			if ( in_array ( $key, $required, true ) && !$value ) {
				$errors[ $key ] = 'Ce champs est requis. Merci de le compléter.';
				continue;
			}

			if ( in_array ( $key, $email, true ) && !filter_var ( $value, FILTER_VALIDATE_EMAIL ) ) {
				$errors[ $key ] = 'L’email que vous avez rentré ne correspond pas au format normal. Par exemple : example@email.com';
				continue;
			}

			if ( in_array ( $key, $accepted, true ) && $value !== '1' ) {
				$errors[ $key ] = 'Merci d’accepter les conditions générales d’utilisation.';
				continue;
			}
		}

		return $errors ? : false;
	}

	function JMPortfolio_get_contact_field_value ( $field )
	{
		if ( !isset( $_SESSION[ 'feedback_contact_form' ] ) ) {
			return '';
		}

		return $_SESSION[ 'feedback_contact_form' ][ 'data' ][ $field ] ?? '';
	}

	function JMPortfolio_get_contact_field_error ( $field )
	{
		if ( !isset( $_SESSION[ 'feedback_contact_form' ] ) ) {
			return '';
		}

		return $_SESSION[ 'feedback_contact_form' ][ 'errors' ][ $field ] ?? '';
	}

	function JMPortfolio_get_errors_style ( $field )
	{
		if ( isset( $_SESSION[ 'feedback_contact_form' ][ 'errors' ][ $field ] ) ) {
			return ' redBorder';
		}
	}

// Utilitaire pour charger un fichier compilé par mix, avec cache bursting.

	function JMPortfolio_mix ( $path )
	{
		$path = '/' . ltrim ( $path, '/' );

		// Checker si le fichier demandé existe bien, sinon retourner NULL
		if ( !realpath ( __DIR__ . '/public' . $path ) ) {
			return;
		}

		// Check si le fichier mix-manifest existe bien, sinon retourner le fichier sans cache-bursting
		if ( !( $manifest = realpath ( __DIR__ . '/public/mix-manifest.json' ) ) ) {
			return get_stylesheet_directory_uri () . '/public' . $path;
		}

		// Ouvrir le fichier mix-manifest et lire le JSON
		$manifest = json_decode ( file_get_contents ( $manifest ), true, 512, JSON_THROW_ON_ERROR );

		// Check si le fichier demandé est bien présent dans le mix manifest, sinon retourner le fichier sans cache-bursting
		if ( !array_key_exists ( $path, $manifest ) ) {
			return get_stylesheet_directory_uri () . '/public' . $path;
		}

		// C'est OK, on génère l'URL vers la ressource sur base du nom de fichier avec cache-bursting.
		return get_stylesheet_directory_uri () . '/public' . $manifest[ $path ];
	}

// Fonction permettant d'inclure des composants et d'y injecter des variables locales (scope de l'appel de fonction)

	function JMPortfolio_include ( string $partial, array $variables = [] ): void
	{
		extract ( $variables );

		include ( __DIR__ . '/partials/' . $partial . '.php' );
	}

// Générer un lien vers la première page utilisant un certain template

	function JMPortfolio_get_template_page ( string $template ): int|WP_Post|null
	{
		// Créer une WP_Query
		$query = new WP_Query( [
			'post_type' => 'page', // uniquement récupérer des pages
			'post_status' => 'publish', // uniquement les pages publiées
			'meta_query' => [
				[
					'key' => '_wp_page_template',
					'value' => $template . '.php',
					// Filtrer sur le type de template utilisé
				]
			]
		] );

		// Retourner la première occurrence
		return $query -> posts[ 0 ] ?? null;
	}

	// Faire une fonction qui renvoi un template si l’image enregistrée dans une publication est un fichier '.png'

	function JMPortfolio_get_png_template ( $id, $size ): string
	{
		return wp_get_attachment_image ( $id, $size );
	}

	// Faire une fonction qui renvoi un template si l’image enregistrée dans une publication est un fichier '.svg'

	function JMPortfolio_get_svg_template ( $url, $title, $desc ): string
	{
		$link = $url;

		return <<<HTML
			<svg class="svg">
				<title>
					{$title}
				</title>
				<desc>
					{$desc}
				</desc>
				<image href="{$link}"/>
			</svg>
HTML;

	}

	// Faire une fonction qui regarde de quelle extension est, l'image qui a été enregistré dans une publication.
	// Ensuite elle renvoi suivant l’extension une fonction qui fera le bon templating

	function JMPortfolio_get_template_by_extension ( $file, $size )
	{
		// $file = un ID ou une URL
		$imgExtension = [ 'png', 'jpg', 'jpeg' ];
		$svgExtension = [ 'svg', 'svg+xml' ];
		$title = $file[ 'title' ];
		$desc = $file[ 'alt' ];

		if ( in_array ( $file[ 'subtype' ], $imgExtension, true ) ) {
			$id = $file[ 'ID' ];

			return JMPortfolio_get_png_template ( $id, $size );
		}

		if ( in_array ( $file[ 'subtype' ], $svgExtension, true ) ) {
			$url = $file[ 'url' ];

			return JMPortfolio_get_svg_template ( $url, $title, $desc );
		}

		/*switch ( $fileInfo[ 'extension' ] ) {
			case 'png':
			case 'jpg':
			case 'jpeg':
				return JMPortfolio_get_png_template( $id, $size );
				break;
			case 'svg':
				return JMPortfolio_get_svg_template( $url, $width, $height );
				break;
			case "": // Si le fichier termine par '.'
			case null: // Si pas d’extension de fichier
				return 'Oups ! On dirait qu’il y a un problème avec l’image de cette publication.';
				break;
		}*/
	}

	// Faire une fonction qui prend un texte donnée par une zone de texte de ACF et en fait un tableau d’éléments pour chaque entrée

	function JMPortfolio_make_array_of_string ( $string ): array
	{
		return explode ( PHP_EOL, $string );
	}

	// Créer une fonction qui va chercher le contenu d'un fichier svg dans resources/assets/...svg

	function JMPortfolio_get_svg ( string $svg ): bool|string
	{
		return file_get_contents ( __DIR__ . '/resources/assets/' . $svg . '.svg' );
	}