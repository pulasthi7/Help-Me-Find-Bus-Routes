<?php
class BusTour{
	private $haltId;
	private $haltCameFrom;
	private $routeCameFrom;
        private $haltModel;
        private $routeModel;
        
        private $fromObj;
        private $toObj;
        private $routeObj;

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
                
                $this->haltModel = new HaltModel();
                $this->routeModel = new RouteModel();
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
        
        public function getFromObj() {
            if (!$this->fromObj) {
                $this->fromObj= $this->haltModel->getHalt($this->haltCameFrom);
            }
            return $this->fromObj;
        }
        
        public function getToObj() {
            if(!$this->toObj){
                $this->toObj= $this->haltModel->getHalt($this->haltId);
            }
            return $this->toObj;
        }
        
        public function getRouteObj() {
            if(!$this->routeObj){
                $this->routeObj= $this->routeModel->getRoutesByID($this->routeCameFrom);
            }
            return $this->routeObj;
        }
}
?>