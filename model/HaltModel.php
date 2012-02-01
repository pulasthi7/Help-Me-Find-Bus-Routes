<?php

class HaltModel{
	private $db;
	
	public function __construct(){
		$this->db = new DBAccess();
	}
	
	public function getHalt($id) {
		$query = "SELECT * FROM halts WHERE halts.id=$id";
		return $this->db->getResults($query);
	}
	
	public function getHaltsOf($route_id) {
		$query = "SELECT halts.id from halts, rt_hlt WHERE rt_hlt.id=$nodeId";
		return $this->db->getResults($query,'array');
	}
}

?>