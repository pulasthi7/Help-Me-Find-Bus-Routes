<?php

class Configuration{
	private static final $dbHost = 'localhost';	//Data base host
	private static final $dbUser = 'root';		//User name to connect to the DB
	private static final $dbPass = 'root';		//Password
	private static final $dbName = 'busRoute';	//DB Name
	
	private static $dbCon;
	
	public static function getDBCon() {
		if($dbCon == null){
			$dbCon = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
		}
		return $dbCon;
	}
}

?>