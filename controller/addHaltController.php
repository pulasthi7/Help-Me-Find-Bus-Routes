<?php
include_once '../model/Editors/AddHalt.php';
if(
	isset($_POST['nname'])&&
	isset($_POST['nlat'])&&
	isset($_POST['nlng'])
){
	$halt = array();
	$halt['name'] = $_POST['nname'];
	$halt['lat'] = $_POST['nlat'];
	$halt['long'] = $_POST['nlng'];
	$adder =  new HaltAdder();
	$adder->addHalt($halt);
}
header("Location:../view/AddHalt.php");
?>