<?php

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
}

?>