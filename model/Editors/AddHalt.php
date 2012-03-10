<?php
include_once '../DBAccess.php';

class HaltAdder{
	private $db;
	
	public function __construct(){
		$this->db = new DBAccess();
	}
	
	public function addHalt(array $halt) {
		$query ="INSERT INTO halt(id,name,latitude,longitude,alias,special) values(".
		        "NULL,'".
				$halt['name']."',".
				$halt['lat'].",".
				$halt['long'].",".
				"NULL, 0".
			")";
		$this->db->doUpdateQuery($query);
		echo 'Executed: '.$query;		
	}
}
?>