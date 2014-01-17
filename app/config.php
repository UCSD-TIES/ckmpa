<?php
/*
 * Configure Timezone
 */
date_default_timezone_set('America/Los_Angeles');


/*
 * APP_PATH
 */
define('APP_PATH', __DIR__ . '/../web');


/* 
 * Database Configuration Options for MySQL
 */
if (getenv("ENV") == "production")
{
	define('DBHOST', 'tunnel.pagodabox.com');
	define('DBNAME', 'coastkeeper');
	define('DBUSER', 'dena');
	define('DBPASS', 'vR5diEtJ');
} else
{
	define('DBHOST', 'localhost');
	define('DBNAME', 'coastkeeper');
	define('DBUSER', 'root');
	define('DBPASS', 'ck');
}