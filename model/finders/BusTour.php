<?php
class BusTour{
	private $haltId;
	private $haltCameFrom;
	private $routeCameFrom;

	/**
	 * Constructor
	 * @param int $id Halt ID
	 * @param int $from ID of the halt came from
	 * @param int $along ID of the route came along
	 */
	public function BusTour($id, $from, $along) {
		$this->haltId = $id;
		$this->haltCameFrom = $from;
		$this->routeCameFrom = $along;
	}
	
	public function getID() {
		return $this->haltId;
	}

	public  function getHaltCameFrom() {
		return $this->haltCameFrom;
	}

	public function getRouteCameFrom() {
		return $this->routeCameFrom;
	}
}
?>