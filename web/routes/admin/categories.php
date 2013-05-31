<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/* Included in fields.php */


/*
   Categories management
 */
$routes->get('/{datasheet_id}/', function($datasheet_id) use ($app){

        $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
        $categories = $datasheet->categories()->find_many();

        /* Display the list of fields */
        return $app['twig']->render('admin/categories/list.twig.html', array(
            'datasheet'  => $datasheet,
            'categories' => $categories
        ));
        
})->assert("datasheet_id", "\d+")
  ->before($admin_login_check)
  ->bind('admin_categories_list');

$routes->match('/{datasheet_id}/create/', function(Request $request, $datasheet_id) use ($app){

    /* Errors */
    $errors = array();

    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);

    if('POST' == $request->getMethod())
    {

        $category_name = $request->get('category_name');

        /* Validity Checks. */

            /* category name cannot be blank */
            if( empty($category_name) )
            {
                    $errors['category_name'] = "Please enter an name for the new category";
            }

        /* Name must be unique */
        if( $datasheet->categories()->where_equal('name', $category_name)->find_one()) {
          $errors['category_name'] = "There is already a category with that name";
        }

        /* If everything is ok, create the new category */
        if(count($errors) <= 0)
        {
            $category = $datasheet->categories()->create();
            $category->name = $category_name;
            $category->coastkeeper_datasheet_id = $datasheet_id;

            $category->save();

            return $app->redirect($app['url_generator']->generate('admin_categories_list', array('datasheet_id' => $datasheet_id)));
        }

    }

    

    /* Render the create form. */
    return $app['twig']->render('admin/categories/create.twig.html', array(
        "errors" => $errors,
        "datasheet" => $datasheet
    ));

})->assert('datasheet_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_category_create');

$routes->match( '/{datasheet_id}/{category_id}/edit/', function( REQUEST $request, $datasheet_id, $category_id ) use ( $app ) {

    /* Array for errors */
    $errors = array();

    /* get the datasheet */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
    $category = $datasheet->categories()->find_one($category_id);

    if( 'POST' == $request->getMethod() && $category && $datasheet ) {

        /* Get the user input */
        $category_name = $request->get('category_name');

        /*
         * Validity checks
         */

        /* category name cannot be blank */
        if( empty($category_name) )
        {
            $errors['category_name'] = "Please enter an name for the category";
        }

        /* Name must be unique */
        if( $datasheet->categories()->where_equal('name', $category_name)->find_one()) {
            $errors['category_name'] = "There is already a category with that name";
        }

        /* If everything is ok, update the category */
        if(count($errors) <= 0)
        {
            $category->name = $category_name;

            /* Update the category */
            $category->save();

            $categories = $app['paris']->getModel('Coastkeeper\datasheet')->find_many();

            return $app->redirect($app['url_generator']->generate('admin_categories_list', array('datasheet_id' => $datasheet_id)));
        }
    }

    /* Render the edit categories form */
    return $app['twig']->render('admin/categories/edit.twig.html', array(
        "errors"   => $errors,
        "datasheet" => $datasheet,
        "category" => $category
    ));

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_category_edit');

 $routes->match( '/{datasheet_id}/{category_id}/delete/', function( REQUEST $request, $datasheet_id, $category_id) use ( $app ) {

    /* get the datasheet */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);

    if( 'POST' == $request->getMethod() && $datasheet ) {

        // check for delete approval
        if( $request->get('approve_delete')) {

            /* Delete the datasheet */
            $datasheet->delete();

            /* Return to the categories list */
            return $app->redirect( $app['url_generator']->generate('admin_categories_list'));
        }

    }

    /* display delete confirmation form */
    return $app['twig']->render('admin/categories/delete.twig.html', array(
        "datasheet" => $datasheet
    ));

})->assert('datasheet_id','\d+')
  ->assert('category_id', '\d+')
  ->before( $admin_login_check )
   ->bind('admin_category_delete');

?>