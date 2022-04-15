<?php
include '../includes/db_connect.php';

	if(!$DBcon) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $DBcon->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $DBcon->query("SELECT customer_name, id_number FROM customer WHERE customer_name LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->customer_name).'\');">'.$result->customer_name.' - '.$result->id_number.'</li>';
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