<?php
include_once '../DBAccess.php';
class RouteModel{
	private $db;

	public function __construct(){
		$this->db = new DBAccess();
	}

	public function getRoutesByID($id) {
		$query = "SELECT * FROM routes WHERE routes.id=$id";
		$this->db->connect();
		$this->db->prepare($query);
		$this->db->query();
		$result = $this->db->fetch();
		$this->db->disconnect();
		return $result;
	}

	public function getRoutesAcross($nodeId) {
		$query = "SELECT routes.id from routes, rt_hlt WHERE rt_hlt.id=$nodeId";
		return $this->db->fetch('array');
	}

	public function getRoutesForSelectField($node_id=NULL) {
		$query;
		if($node_id){
			$query = "SELECT * from route where start_id=".$node_id." OR end_id=".$node_id;
		} else{
			$query = "SELECT * from route";
		}
		$results = $this->db->getResults($query,"array");
		$resultString = "";
		foreach ($results as $route) {
			$resultString = $resultString."<option value=".$route["id"].">".$route["number"]."</option>";
		}
		return $resultString;
	}
}

?>