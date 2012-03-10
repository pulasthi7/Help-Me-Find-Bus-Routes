<?php
include_once '../DBAccess.php';

class HaltModel{
	private $db;
	
	public function __construct(){
		$this->db = new DBAccess();
	}
	
	public function getHalt($id) {
		$query = "SELECT * FROM halts WHERE halts.id=$id";
		$result = $this->db->getResults($query);
		if($result){
			return array_pop($result);
		}
	}
	
	public function getHaltsOf($route_id) {
		$query = "SELECT halts.id from halts, rt_hlt WHERE rt_hlt.id=$nodeId";
		return $this->db->getResults($query,'array');
	}
	
	public function getHaltsForSelectField() {
		$query = "SELECT id, name FROM halt";
		$results = $this->db->getResults($query,"array");
		$resultString = "";
		foreach ($results as $node) {
			$resultString = $resultString."<option value=".$node["id"].">".$node["name"]."</option>";
		}
		return $resultString;
	}
}

?>