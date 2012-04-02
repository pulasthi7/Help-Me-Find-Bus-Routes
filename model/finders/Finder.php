<?php

include_once '../model/HaltModel.php';
include_once '../model/RouteModel.php';
include_once '../model/finders/BusTour.php';

class Finder {

    private $openRoutes;
    private $openNodes;
    private $closedRoutes;
    private $closedNodes;
    private $nodeModel;
    private $routeModel;
    private $dest_lon;
    private $dest_lat;

    public function Finder() {

        $this->nodeModel = new HaltModel();
        $this->routeModel = new RouteModel();
    }

    private function closeRoute($routeID) {
        $nodes = $this->nodeModel->getHaltsOf($routeID);
        foreach ($nodes as $node) {
            if (!array_key_exists($node['id'], $this->closedNodes)) {
                if (!array_key_exists($node['id'], $this->openNodes)) {
                    $this->openNodes[$node['id']] = new BusTour($node['id'], $this->openRoutes[$routeID]->getID(), $routeID);
                }
            }
        }
        $this->closedRoutes[$routeID] = $routeID;
        unset($this->openRoutes[$routeID]);
    }

    private function closeRouteHeu($routeID) {
        $nodes = $this->nodeModel->getHaltsWithLonLat($routeID);
        foreach ($nodes as $node) {
            if (!array_key_exists($node->id, $this->closedNodes)) {
                if (!array_key_exists($node->id, $this->openNodes)) {
                    $this->openNodes[$node->id] = array("bus"=>new BusTour($node->id, $this->openRoutes[$routeID]["bus"]->getID(), $routeID),
                        "lat"=>$node->latitude,"lon"=>$node->longitude);
                }
            }
        }
        $this->closedRoutes[$routeID] = $routeID;
        unset($this->openRoutes[$routeID]);
    }

    private function closeNode($node) {
        $routes = $this->routeModel->getRoutesAcross($node->getID());
        foreach ($routes as $route) {
            if (!array_key_exists($route['id'], $this->closedRoutes)) {
                if (!array_key_exists($route['id'], $this->openRoutes)) {
                    $this->openRoutes[$route['id']] = $node;
                }
            }
        }
        $this->closedNodes[$node->getID()] = $node;
    }
    
    private function closeNodeHeu($node) {
        $routes = $this->routeModel->getRoutesAcross($node["bus"]->getID());
        foreach ($routes as $route) {
            if (!array_key_exists($route['id'], $this->closedRoutes)) {
                if (!array_key_exists($route['id'], $this->openRoutes)) {
                    $this->openRoutes[$route['id']] = $node;
                }
            }
        }
        $this->closedNodes[$node["bus"]->getID()] = $node;
    }

    public function findRoute($from, $to) {
        $this->init();
        $this->openNodes[$from] = new BusTour($from, NULL, NULL);
        $routeFound = false;
        while ($currentNode = array_shift($this->openNodes)) {
            $this->closeNode($currentNode);

            foreach ($this->openRoutes as $route => $from) {
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

    public function findRouteWithHeuristics($from, $to) {
        $this->init();
        $destObject = $this->nodeModel->getHalt($to);
        $this->dest_lon = $destObject->longitude;
        $this->dest_lat = $destObject->latitude;
        $sourceObject = $this->nodeModel->getHalt($from);
        $this->openNodes[$from] = array("bus"=>new BusTour($from, NULL, NULL), "lon" => $sourceObject->longitude, "lat" => $sourceObject->latitude);
        $routeFound = false;
        while ($currentNode = $this->getNearest()) {
            $this->closeNodeHeu($currentNode);

            foreach ($this->openRoutes as $route => $from) {
                $this->closeRouteHeu($route);
            }

            if (isset($this->closedNodes[$to])) {
                $routeFound = true;
                break;
            }
        }
        $result = false;
        if ($routeFound) {
            $result = $this->buildPathHeu($from, $to);
        }
        $this->releaseResources();
        return $result;
    }
    
    function getNearest() {
        return $this->getNearestEuc();
    }
    
    function getNearestEuc() {
        $nearest;
        $nearest_euc = PHP_INT_MAX;
        $index;
        foreach ($this->openNodes as $i=>$node) {
            $delta_long = $node["lon"] - $this->dest_lon;
            $delta_lat = $node["lat"] - $this->dest_lat; 
            $cur_euc = $delta_lat * $delta_lat + $delta_long * $delta_long;
            if($cur_euc < $nearest_euc){
                $nearest_euc = $cur_euc;
                $nearest = $node;
                $index = $i;
            }
        }
        unset ($this->openNodes[$index]);
        return $nearest;
    }
    
    function getNearestManhatton(){
        $nearest;
        $nearest_manhtn = PHP_INT_MAX;
        $index;
        foreach ($this->openNodes as $i=>$node) {
            $cur_manhtn = abs($node["lat"] - $this->dest_lat) + abs($node["lon"] - $this->dest_lon);
            if($cur_manhtn < $nearest_manhtn){
                $nearest_manhtn = $cur_manhtn;
                $nearest = $node;
                $index = $i;
            }
        }
        unset ($this->openNodes[$index]);
        return $nearest;
    }

    function nearestFirst($node1, $node2) {
        $manhatton_dis1 = abs($node1["lat"] - $this->dest_lat) + abs($node1["lon"] - $this->dest_lon);
        $manhatton_dis2 = abs($node2["lat"] - $this->dest_lat) + abs($node2["lon"] - $this->dest_lon);
        return $manhatton_dis1 - $manhatton_dis2;
    }

    private function releaseResources() {
        unset($this->closedNodes);
        unset($this->closedRoutes);
        unset($this->openNodes);
        unset($this->openRoutes);
    }

    private function buildPath($from, $to) {
        $path = array();
        $path[] = $this->openNodes[$to];
        $previous = $this->openNodes[$to]->getHaltCameFrom();
        while ($previous) {
            $path[] = $this->closedNodes[$previous];
            $previous = $this->closedNodes[$previous]->getHaltCameFrom();
        }
        return $path;
    }
    
    private function buildPathHeu($from, $to) {
        $path = array();
        $path[] = $this->closedNodes[$to]["bus"];
        $previous = $this->closedNodes[$to]["bus"]->getHaltCameFrom();
        while ($previous) {
            $path[] = $this->closedNodes[$previous]["bus"];
            $previous = $this->closedNodes[$previous]["bus"]->getHaltCameFrom();
        }
        return $path;
    }

    private function init() {
        $this->closedNodes = array();
        $this->closedRoutes = array();
        $this->openNodes = array();
        $this->openRoutes = array(); //route_id => node_id_from_where_the_route_added
    }

}

?>