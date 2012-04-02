<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



// This is a sample code in case you wish to check the username from a mysql db table
include_once '../DBAccess.php';
if (isset($_POST['nodeName'])) {
    $nodeName = $_POST['nodeName'];
    $query = "select name from halt where name='$nodeName'";
    $db = new DBAccess();
    $result = $db->getResults($query);
    if(count($result)>0){
        echo '<font color="red">The place <strong>' . $nodeName . '</strong>' . ' is already in use.</font>';
    } else {
        echo 'OK';
    }
}
?>
