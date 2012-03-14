<?php
/**
 * Database Configurations
 */

class DBAccess{

	private $connection;
	private $query;
	private $result;

	public function connect()
	{
		//connection parameters
		$host = 'localhost';
		$user = 'root';
		$password = 'root';
		$database = 'busRoute';

		//create new mysqli connection
		$this->connection = new mysqli($host , $user , $password , $database);
	}

	public function disconnect(){
		$this->connection->close();
		unset($this->result);
		return TRUE;
	}

	public function query(){
		if (isset($this->query)){
			$this->result = $this->connection->query($this->query);
			return TRUE;
		}
		return FALSE;
	}

	public function fetch($type = 'object'){
		$rows = array();
		if (isset($this->result))
		{
			switch ($type)
			{
				case 'array':
					while($row = $this->result->fetch_array()){
						$rows[] = $row;
					}					 
					break;
				case 'object':

				default:
					while($row = $this->result->fetch_object()){
						$rows[] = $row;
					}
					break;
			}

			return $rows;
		}

		return FALSE;
	}
	
	public function getResults($query, $type='object') {
		$this->connect();
		$this->query = $query;
		$this->query();
		$result = $this->fetch($type);
		$this->disconnect();
		return $result;
	}
	
	public function doUpdateQuery($query) {
		$this->query = $query;
		$this->connect();
		$this->query();
		$this->disconnect();
	}
}

?>