<?php
/*
 * app.php
 *
 * This initializes our Silex application and
 * registers necessary service providers used
 * throughout the application.
 *
 */

/* Bootstrap the application */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/config.php';

/* Initialize the Application */
$app = new Silex\Application();

/* Initialize the Paris ActiveRecord */
$app->register(new Coastkeeper\ParisServiceProvider(), array(
	'paris.dsn' => 'mysql:host=' . DBHOST . ';dbname=' . DBNAME,
	'paris.username' => DBUSER,
	'paris.password' => DBPASS,
));

/* register template service */
$app->register( new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => APP_PATH . '/views',
));

/* register UrlGeneratorServiceProvider */
$app->register( new Silex\Provider\UrlGeneratorServiceProvider());

/* register FormServiceProvider */
$app->register( new Silex\Provider\FormServiceProvider());

/* register TranslationServiceProvider */
$app->register( new Silex\Provider\TranslationServiceProvider(), array(
		'locale_fallback' => 'en'
	));

/* register ValidatorServiceProvider */
$app->register( new Silex\Provider\ValidatorServiceProvider());

/* register session provider */
$app->register(new Silex\Provider\SessionServiceProvider());

/* Return the application instance */
return $app;
