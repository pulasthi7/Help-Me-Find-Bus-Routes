<?php
include_once '../model/Editors/AddRoute.php';
include_once '../model/Editors/RouteEditor.php';

if(
	isset($_POST['rt_number'])&&
	isset($_POST['rt_start'])&&
	isset($_POST['rt_end'])
){
	$route = array();
	$route['number'] = $_POST['rt_number'];
	$route['start'] = $_POST['rt_start'];
	$route['end'] = $_POST['rt_end'];
	$adder =  new RouteAdder();
	$adder->addRoute($route);
	$editor = new RouteEditor();
	$editor->addHaltIDToRoute($_POST['rt_start'], $_POST['rt_number']);
	$editor->addHaltIDToRoute($_POST['rt_end'], $_POST['rt_number']);
}
header("Location:../view/AddRoute.php");
?>