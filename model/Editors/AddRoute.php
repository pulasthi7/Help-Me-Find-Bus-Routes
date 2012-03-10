<?php
include_once '../DBAccess.php';

class RouteAdder{
	private $db;

	public function __construct(){
		$this->db = new DBAccess();
	}

	public function addRoute(array $route) {
		$start = $this->getNameof($route['start']);
		$end = $this->getNameof($route['end']);
		$query ="INSERT INTO route(id,number,start_id,end_id,description) values(".
		        "NULL,'".
		$route['number']."',".
		$route['start'].",".
		$route['end'].",'".
		$route['number']." (".$start." - ".$end.")".
			"')";
		$this->db->doUpdateQuery($query);
	}
	
	private function getNameof($node_id) {
		$query = "SELECT name FROM halt WHERE id =".$node_id;
		$results = $this->db->getResults($query,"array");
		$halt = array_pop($results);
		if($halt){
			return $halt["name"];
		}
	}
}
?>