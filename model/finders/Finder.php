<?php
include_once '../model/HaltModel.php';
include_once '../model/RouteModel.php';
include_once '../model/finders/ListedNode.php';

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
			if (!array_key_exists($node['id'], $this->closedNodes)) {
				if(!array_key_exists($node['id'], $this->openNodes)){
					$this->openNodes[$node['id']] = new ListedHalt($node['id'], $this->openRoutes[$routeID]->getID(), $routeID);
				}
			}
		}
		$this->closedRoutes[$routeID] = $routeID;
		unset($this->openRoutes[$routeID]);
	}

	private function closeNode($node) {
		$routes = $this->routeModel->getRoutesAcross($node->getID());
		foreach ($routes as $route) {
			if(!array_key_exists($route['id'], $this->closedRoutes)){
				if(!array_key_exists($route['id'], $this->openRoutes)){
					$this->openRoutes[$route['id']] = $node;
				}
			}
		}
		$this->closedNodes[$node->getID()] = $node;
	}

	public function findRoute($from, $to) {
		$this->init();
		$this->openNodes[$from] = new ListedHalt($from, NULL, NULL);
		$routeFound = false;
		while($currentNode=array_shift($this->openNodes)) {
			$this->closeNode($currentNode);

			foreach ($this->openRoutes as $route=>$from) {
				$this->closeRoute($route);
			}
				
			if (isset($this->openNodes[$to])) {
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