<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/*
 * All URLs automatically prefixed with /admin/volunteers
 * See index.php
 */
$volunteers = $app['controllers_factory'];

/*
 * Index page of volunteers.
 */
$volunteers->get('/', function () use ($app){

	/* Get list of volunteers */
	$volunteers = $app['paris']->getModel('Coastkeeper\Volunteer')->find_many();

	return $app['twig']->render('admin/volunteers.twig', array(
			'volunteers' => $volunteers
	));

});

/**********************
 * Create Volunteer
 **********************/
$volunteers->match('/create/', function(Request $request) use ($app){

	$form = $app['form.factory']->createBuilder('form')
		->add('first_name', 'text', array(
			'constraints' => array(new Assert\NotBlank(), 
								   new Assert\MinLength(1)
								   )
			))
		->add('last_name', 'text', array(
			'constraints' => array(new Assert\NotBlank(),
								   new Assert\MinLength(1)
								   )
			))
		->getForm();

	/* If the form was submitted... */
	if('POST' == $request->getMethod())
	{
		/* fill in the information from request */
		$form->bind($request);

		/* validate the form */
		if($form->isValid())
		{
			/* if the data is valid, create */
			$data = $form->getData();

			/* create new volunteer and save to db */
			$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->create();
			
			$volunteer->first_name = $data['first_name'];
			$volunteer->last_name = $data['last_name'];
			$volunteer->username = strtolower($volunteer->first_name . $volunteer->last_name);
			$volunteer->save();

			/* redirect to volunteer list */
			return $app->redirect('/admin/volunteers');
		}
	}

	return $app['twig']->render('admin/volunteers.create.twig', array(
			'form' => $form->createView(),
		));
});

/*******************
 * View volunteer
 *******************/
$volunteers->get('/{id}/', function ($id) use ($app){
	
	/* Find Volunteer*/
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);

	/* 404 if doesn't exist */
	if(!$volunteer)
	{
		$app->abort(404, "Volunteer doesn't exist.");
	}

	return '';

})->assert('id','\d+');

/******************
 * Edit Volunteer
 ******************/
$volunteers->match('/{id}/edit/', function(Request $request, $id) use ($app){

	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);

	if(!$volunteer)
	{
		$app->abort(404, "Volunteer doesn't exist.");
	}

	return '';

})->assert('id', '\d+');

/*********************
 * Delete Volunteer
 *********************/
$volunteers->match('/{id}/delete/', function (Request $request, $id) use ($app){

	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);

	if(!$volunteer)
	{
		$app->abort(404, "Volunteer doesn't exist.");
	}

	$volunteer->delete();

	return $app->redirect('/admin/volunteers');

})->assert('id', '\d+');

return $volunteers;