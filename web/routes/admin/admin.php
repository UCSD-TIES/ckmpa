<?php
/**
 * All URLS will be prefixed with /admin/ automatically
 * by index.php
 **/

/* Get controller factory instance */
$admin = $app['controllers_factory'];

/*************
 * Index Page
 *************/
$admin->get('/', function() use ($app){
	return $app['twig']->render('admin/index.twig');
});

return $admin;