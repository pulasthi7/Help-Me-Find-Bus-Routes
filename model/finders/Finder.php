<?php
class ListedHalt{
	private $haltId;
	private $haltCameFrom;
	private $routeCameFrom;
	
	/**
	 * Constructor
	 * @param int $id Halt ID
	 * @param int $from ID of the halt came from
	 * @param int $along ID of the route came along
	 */
	public function ListedHalt($id, $from, $along) {
		$this->haltId = $id;
		$this->haltCameFrom = $from;
		$this->routeCameFrom = $along;
	}
	
	public  function getHaltCameFrom() {
		return $this->haltCameFrom;
	}
	
	public function getRouteCameFrom() {
		return $this->routeCameFrom;
	}
}

class Finder {
	private $openRoutes;
	private $openNodes;
	
	private $closedRoutes;
	private $closedNodes;
	
	private $nodeModel;
	private $routeModel;
	
	public function Finder(){
		
		$this->nodeModel = new HaltModel();
		$this->routeModel = new RouteModel();
	}
	
	private function closeRoute($routeID) {
		$nodes = $this->nodeModel->getHaltsOf($routeID);
		foreach ($nodes as $node) {
			if (!array_key_exists($node, $this->closedNodes)) {
				if(!array_key_exists($node, $this->openNodes)){
					$this->openNodes[$node] = new ListedHalt($node, $this->openRoutes[$routeID], $routeID);
				}
			}
		}
		$this->closedRoutes[] = $routeID;
		unset($this->openRoutes[$routeID]);
	}
	
	private function closeNode($nodeID) {
		$routes = $this->routeModel->getRoutesAcross($nodeID);
		foreach ($routes as $route) {
			if(!array_key_exists($route, $this->closedRoutes)){
				if(!array_key_exists($route, $this->openRoutes)){
					$this->openRoutes[$route] = $nodeID;
				}
			}
		}
		$this->closedNodes[$nodeID] = $this->openNodes[$nodeID];
		unset($this->openNodes[$nodeID]);
	}
	
	public function findRoute($from, $to) {
		$this->init();
		$this->openNodes[$from] = new ListedHalt($from, NULL, NULL);
		$routeFound = false;
		while($currentNode=array_shift($this->openNodes)) {
			$this->closeNode($currentNode);
			
			foreach ($this->openRoutes as $currentRoute) {
				$this->closeRoute($currentRoute);
			}
			
			if (!isset($this->openNodes[$to])) {
				$routeFound = true;
				break;
			}
		}
		$result = false;
		if ($routeFound) {
			$result = $this->buildPath($from, $to);
		}
		$this->releaseResources();
		return $result;
	}
	
	private function releaseResources(){
		unset($this->closedNodes);
		unset($this->closedRoutes);
		unset($this->openNodes);
		unset($this->openRoutes);
	}
	
	private function buildPath($from, $to) {
		$path = array();
		$path[] = $this->openNodes[$to];
		$previous = $this->openNodes[$to]->getHaltCameFrom();
		while($previous){
			$path[] = $this->closedNodes[$previous];
			$previous = $this->closedNodes[$previous]->getHaltCameFrom();
		}
		return $path;
	}
	
	private function init() {
		$this->closedNodes=array();
		$this->closedRoutes = array();
		$this->openNodes = array();
		$this->openRoutes = array(); //route_id => node_id_from_where_the_route_added
	}
}

?>