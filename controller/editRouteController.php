<?php
include_once '../model/Editors/RouteEditor.php';

if(
	isset($_POST['route'])&&
	isset($_POST['halt'])
){
	//FIXME Check whether the item already exists
	$editor = new RouteEditor();
	$editor->addHaltToRouteById($_POST['halt'], $_POST['route']);
}
header("Location:../view/AssignNodesToRoute.php");
?>