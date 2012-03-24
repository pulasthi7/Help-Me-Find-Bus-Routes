<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



// This is a sample code in case you wish to check the username from a mysql db table

if(isSet($_POST['username']))
{
$username = $_POST['username'];

$dbHost = 'localhost'; // usually localhost
$dbUsername = 'root';
$dbPassword = '';
$dbDatabase = 'busroute';

$db = mysql_connect($dbHost, $dbUsername, $dbPassword)
 or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db)
 or die ("Could not select database.");

$sql_check = mysql_query("select name from halt where name='".$username."'")
 or die(mysql_error());

if(mysql_num_rows($sql_check))
{
echo '<font color="red">The place <strong>'.$username.'</strong>'.' is already in use.</font>';
}
else
{
echo 'OK';
}
}



?>
