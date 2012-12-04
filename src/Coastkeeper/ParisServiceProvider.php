<?php
/*
 * Paris ActiveRecord Service Provider.
 * implementation based on:
 * http://cambridgesoftware.co.uk/blog/item/59-backbonejs-%20-php-with-silex-microframework-%20-mysql
 */
namespace Coastkeeper;

use Silex\Application;
use Silex\ServiceProviderInterface;

/* Require Idiorm and Paris libraries. */
require_once __DIR__ . '/../../vendor/j4mie/idiorm/idiorm.php';
require_once __DIR__ . '/../../vendor/j4mie/paris/paris.php';

class ParisServiceProvider implements ServiceProviderInterface{
	public function register (Application $app)
	{
		$app['paris'] = $app->share(function() use ($app){
			\ORM::configure($app['paris.dsn']);
			\ORM::configure('username', $app['paris.username']);
			\ORM::configure('password', $app['paris.password']);
			\ORM::configure('logging', true);
			\ORM::configure('driver_options', array(
				\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			));

			return new ParisWrapper();
		});
	}

	public function boot(Application $app)
	{
		/* Not currently needed */
	}
}

/*
	These are the methods used to interface with 
	the Paris/Idiorm ORM system.
 */
class ParisWrapper
{
	/*
		Return a query object of the given model.
	 */
	public function getModel($modelName)
	{
		return \Model::factory($modelName);
	}

	/*
		Return the last executed query.
	 */
	public function getLastQuery()
	{
		return \ORM::get_last_query();
	}

	/*
		Return the query log.
	 */
	public function getQueryLog()
	{
		return \ORM::get_query_log();
	}
}
