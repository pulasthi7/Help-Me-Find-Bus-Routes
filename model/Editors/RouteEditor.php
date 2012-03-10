<?php
include_once '../DBAccess.php';

class RouteEditor{
	private $db;

	public function __construct(){
		$this->db = new DBAccess();
	}

	/**
	 * 
	 * Adds a node to a route when the node id is available, but the route id is not available.
	 * (The case when a new route is added to the database)
	 * @param int $halt_id halt id (assumed to be known)
	 * @param String $route_number route number
	 */
	public function addHaltIDToRoute($halt_id, $route_number) {
		$query = "SELECT id FROM route WHERE number=".$route_number;
		$result_arr = $this->db->getResults($query,"array");
		$result = array_pop($result_arr);
		if($result){
			$this->addHaltToRouteById($halt_id, $result["id"]);
		}
	}
	
	/**
	 * Adds a node to a route when both the ids of the route and the node is known
	 * @param int $halt_id The id of the node
	 * @param int $route_id The id of the route
	 */
	public function addHaltToRouteById($halt_id, $route_id) {
		$query ="INSERT INTO rt_hlt(halt_id,route_id) values(".
		$halt_id.",".
		$route_id.
			")";
		$this->db->doUpdateQuery($query);
		echo 'Executed: '.$query;
	}
}
?>