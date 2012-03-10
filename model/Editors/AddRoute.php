<?php
include_once '../DBAccess.php';

class RouteAdder{
	private $db;

	public function __construct(){
		$this->db = new DBAccess();
	}

	public function addRoute(array $route) {
		$query ="INSERT INTO route(id,number,start_id,end_id) values(".
		        "NULL,'".
		$route['number']."',".
		$route['start'].",".
		$route['end'].
			")";
		$this->db->doUpdateQuery($query);
		echo 'Executed: '.$query;
	}
}
?>