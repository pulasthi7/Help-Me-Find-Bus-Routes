<?php
include_once '../DBAccess.php';
class RouteModel{
	private $db;

	public function __construct(){
		$this->db = new DBAccess();
	}

	public function getRoutesByID($id) {
		$query = "SELECT * FROM route WHERE route.id=$id";
		$result = $this->db->getResults($query);
		if($result){
			return array_pop($result);
		}
	}

	public function getRoutesAcross($nodeId) {
		$query = "SELECT route.id from route, rt_hlt WHERE rt_hlt.halt_id=$nodeId AND rt_hlt.route_id=route.id";
		return $this->db->getResults($query,'array');
	}

	public function getRoutesForSelectField($node_id=NULL) {
		$query;
		if($node_id){
			$query = "SELECT id,description from route where start_id=".$node_id." OR end_id=".$node_id;
		} else{
			$query = "SELECT id,description from route";
		}
		$results = $this->db->getResults($query,"array");
		$resultString = "";
		foreach ($results as $route) {
			$resultString = $resultString."<option value=".$route["id"].">".$route["description"]."</option>";
		}
		return $resultString;
	}
}

?>