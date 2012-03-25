<?php
   $db = new mysqli('localhost', 'root' ,'', 'busroute');
	
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $db->query("SELECT * FROM halt WHERE name LIKE '%$queryString%' OR alias LIKE '%$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill'.$_POST['number'].'(\''.addslashes($result->name).'\',\''.$result->longitude.'\',\''.$result->latitude.'\',\''.$result->id.'\');">'.$result->name.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>