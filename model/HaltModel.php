<?php
include_once '../DBAccess.php';

class HaltModel{
	private $db;
	
	public function __construct(){
		$this->db = new DBAccess();
	}
	
	public function getHalt($id) {
		$query = "SELECT * FROM halt WHERE halt.id=$id";
		$result = $this->db->getResults($query);
		if($result){
			return array_pop($result);
		}
	}
        
        public function getHaltsWithLonLat($route_id){
            $query = "SELECT halt.id, halt.longitude, halt.latitude from halt, rt_hlt WHERE rt_hlt.route_id=$route_id AND halt.id=rt_hlt.halt_id";
            return $this->db->getResults($query);
        }


        public function getHaltsOf($route_id) {
		$query = "SELECT halt.id from halt, rt_hlt WHERE rt_hlt.route_id=$route_id AND halt.id=rt_hlt.halt_id";
		return $this->db->getResults($query,"array");
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