<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/fields/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

require_once __DIR__ . '/datasheet.php';
require_once __DIR__ . '/categories.php';

/* NOTE: $admin_login_check is defined in admin.php */

/*
	MPA (Locations) Management
 */
$routes->get('/{datasheet_id}/{category_id}/', function($datasheet_id, $category_id) use ($app){

        $data = array();

        $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
        $category = $datasheet->categories()->find_one($category_id);

        $fields = $category->entries()->find_many();

        /* Display the list of fields */
        return $app['twig']->render('admin/fields/list.twig.html', array(
            'datasheet' => $datasheet,
            'category' => $category,
            'fields' => $fields
        ));

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_fields_list');

$routes->match('/{datasheet_id}/{category_id}/create/', 
          function(Request $request, $datasheet_id, $category_id) use ($app){

    /* Errors */
    $errors = array();

    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
    $category = $datasheet->categories()->find_one($category_id);

    if('POST' == $request->getMethod() && $category)
    {

        $field_name = $request->get('field_name');

        /* Validity Checks. */

            /* field name cannot be blank */
            if( empty($field_name) )
            {
                    $errors['field_name'] = "Please enter an name for the new field";
            }

        /* Name must be unique */
        if( $category->entries()->where_equal('name', $field_name)->find_one()) {
          $errors['field_name'] = "There is already a field with that name";
        }

        /* If everything is ok, create the new field */
        if(count($errors) <= 0)
        {
            $field = $category->entries()->create();
            $field->name = $field_name;
            $field->coastkeeper_datasheet_category_id = $category->id;
            $field->use_report = 0;

            $field->save();

            return $app->redirect($app['url_generator']
                          ->generate('admin_fields_list', 
                                     array(
                                      'datasheet_id' => $datasheet_id,
                                      'category_id' => $category_id
                                    )));
        }

    }

    /* Render the create form. */
    return $app['twig']->render('admin/fields/create.twig.html', array(
        "errors" => $errors,
        "datasheet" => $datasheet,
        "category" => $category
    ));

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_field_create');

$routes->match( '/{datasheet_id}/{category_id}/{field_id}/edit/', 
          function( REQUEST $request, $datasheet_id, $category_id, $field_id ) use ( $app ) {

    /* Array for errors */
    $errors = array();

    /* get the datasheet */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
    $category = $datasheet->categories()->find_one($category_id);
    $field = $category->entries()->find_one($field_id);

    if( 'POST' == $request->getMethod() && $category && $field ) {

        /* Get the user input */
        $field_name = $request->get('field_name');

        /*
         * Validity checks
         */

        /* field name cannot be blank */
        if( empty($field_name) )
        {
            $errors['field_name'] = "Please enter an name for the field";
        }

        /* Name must be unique */
        if( $category->entries()->where_equal('name', $field_name)->find_one()) {
            $errors['field_name'] = "There is already a field with that name";
        }

        /* If everything is ok, update the field */
        if(count($errors) <= 0)
        {
            $field->name = $field_name;

            /* Update the field */
            $field->save();

            return $app->redirect($app['url_generator']
              ->generate('admin_fields_list', 
                         array(
                          'datasheet_id' => $datasheet_id,
                          'category_id' => $category_id
                        )));
        }
    }

    /* Render the edit fields form */
    return $app['twig']->render('admin/fields/edit.twig.html', array(
        "errors"   => $errors,
        "datasheet" => $datasheet,
        "category" => $category,
        "field" => $field
    ));

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->assert('field_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_field_edit');

 $routes->match( '/{datasheet_id}/{category_id}/{field_id}/delete/', 
            function( REQUEST $request, $datasheet_id, $category_id, $field_id) use ( $app ) {

    /* get the category */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
    $category = $datasheet->categories()->find_one($category_id);
    $field = $category->entries()->find_one($field_id);

    if( 'POST' == $request->getMethod() && $field ) {

        // check for delete approval
        if( $request->get('approve_delete')) {

            /* Delete the field */
            $field->delete();

            /* Return to the fields list */
            return $app->redirect($app['url_generator']
              ->generate('admin_fields_list', 
                         array(
                          'datasheet_id' => $datasheet_id,
                          'category_id' => $category_id
                        )));
        }
    }

    /* display delete confirmation form */
    return $app['twig']->render('admin/fields/delete.twig.html', array(
        "datasheet" => $datasheet,
        "category" => $category,
        "field" => $field
    ));

})->assert('datasheet_id','\d+')
  ->assert('category_id', '\d+')
  ->assert('field_id', '\d+')
  ->before( $admin_login_check )
   ->bind('admin_field_delete');

return $routes;
