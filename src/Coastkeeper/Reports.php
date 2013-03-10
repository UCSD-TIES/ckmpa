<?php

namespace Coastkeeper;

use \Model;
/*

	CoastkeeperSection

	Available Fields:
	id
	coastkeeper_location_id
	name

 */
class Reports extends Model{
	protected static $result;

	public static function init() {
         
    }//
	
	
	
	public function getData($requirementQuery)
	{
		//need to get sql in JSON format
		$con = mysql_connect("localhost","peter","abc123"); //login, pass
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		
		mysql_select_db("my_db", $con); 
		
		self::$result = mysql_query("SELECT * FROM Persons");
		
		mysql_close($con);
	}

}