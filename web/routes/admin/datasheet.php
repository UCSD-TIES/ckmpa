<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/* Included in fields.php */


/*
   Datasheet management
 */
$routes->get('/', function() use ($app){

        $datasheets = $app['paris']->getModel('Coastkeeper\Datasheet')->find_many();

        /* Display the list of fields */
        return $app['twig']->render('admin/datasheets/list.twig.html', array(
            'datasheets' => $datasheets
        ));
        
})->before($admin_login_check)->bind('admin_datasheets_list');


$routes->match('/create/', function(Request $request) use ($app){

    /* Errors */
    $errors = array();

    if('POST' == $request->getMethod())
    {

        $datasheet_name = $request->get('datasheet_name');

        /* Validity Checks. */

            /* datasheet name cannot be blank */
            if( empty($datasheet_name) )
            {
                    $errors['datasheet_name'] = "Please enter an name for the new datasheet";
            }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Datasheet')
                                      ->where_equal('name', $datasheet_name)
                                      ->find_one()) {
          $errors['datasheet_name'] = "There is already a datasheet with that name";
        }

        /* If everything is ok, create the new datasheet */
        if(count($errors) <= 0)
        {
            $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->create();
            $datasheet->name = $datasheet_name;

            $datasheet->save();

            return $app->redirect($app['url_generator']->generate('admin_datasheets_list'));
        }

    }

    /* Render the create form. */
    return $app['twig']->render('admin/datasheets/create.twig.html', array(
        "errors" => $errors,
    ));

})->before($admin_login_check)->bind('admin_datasheet_create');

$routes->match( '/{datasheet_id}/edit/', function( REQUEST $request, $datasheet_id ) use ( $app ) {

    /* Array for errors */
    $errors = array();

    /* get the datasheet */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);

    if( 'POST' == $request->getMethod() && $datasheet ) {

        /* Get the user input */
        $datasheet_name = $request->get('datasheet_name');

        /*
         * Validity checks
         */

        /* datasheet name cannot be blank */
        if( empty($datasheet_name) )
        {
            $errors['datasheet_name'] = "Please enter an name for the datasheet";
        }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Datasheet')
                                      ->where_equal('name', $datasheet_name)
                                      ->find_one()) {
            $errors['datasheet_name'] = "There is already a datasheet with that name";
        }

        /* If everything is ok, update the datasheet */
        if(count($errors) <= 0)
        {
            $datasheet->name = $datasheet_name;

            /* Update the datasheet */
            $datasheet->save();

            $datasheets = $app['paris']->getModel('Coastkeeper\datasheet')->find_many();

            return $app->redirect($app['url_generator']->generate('admin_datasheets_list'));
        }
    }

    /* Render the edit datasheets form */
    return $app['twig']->render('admin/datasheets/edit.twig.html', array(
        "errors"   => $errors,
        "datasheet" => $datasheet
    ));

})->assert('datasheet_id', '\d+')
 ->before($admin_login_check)
 ->bind('admin_datasheet_edit');

 $routes->match( '/{datasheet_id}/delete/', function( REQUEST $request, $datasheet_id ) use ( $app ) {
    $errors = array();

    /* get the datasheet */
    $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);

    if ($datasheet->locations()->find_many()) {
        $errors['datasheet_delete'] = "There are still locations attached to this datasheet. Remove those first";
    }

    if ($datasheet->categories()->find_many()) {
        $errors['datasheet_delete'] = "There are categories attached to this datasheet. Please remove those first";
    }

    if( 'POST' == $request->getMethod() && $datasheet && count($errors) <= 0) {

        // check for delete approval
        if( $request->get('approve_delete')) {

            /* Delete the datasheet */
            $datasheet->delete();

            /* Return to the datasheets list */
            return $app->redirect( $app['url_generator']->generate('admin_datasheets_list'));
        }

    }

    /* display delete confirmation form */
    return $app['twig']->render('admin/datasheets/delete.twig.html', array(
        "datasheet" => $datasheet,
        "errors" => $errors
    ));

})->assert('datasheet_id','\d+')
    ->before( $admin_login_check )
    ->bind('admin_datasheet_delete');

?>