<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/sections/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/* NOTE: $admin_login_check is defined in admin.php */

/*
	View all sections
 */
$routes->get('/', function() use ($app){

        /* Get a list of mpas */
        $sections = $app['paris']->getModel('Coastkeeper\Section')->find_many();

        /* Display the list of locations */
        return $app['twig']->render('admin/sections/list.twig.html', array(
            'section' => $sections,
        ));
        
})->before($admin_login_check)->bind('admin_sections');

return $routes;
