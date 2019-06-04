<?php
$success_message = '';
$error_message = '';
$has_error=false;
$has_success=false;

if (array_key_exists("removeItems", $_POST)) {

		$sql ="DELETE FROM commissary_recbin";
	//	$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, '".$formdata["level"]."')";
		if (mysqli_query($conn, $sql)) {
			//log
			
	        $userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql3 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Removed items from recycle bin at ', '".$dateandtime."')";
			if ($result = $conn->query($sql3)) {
				
			//echo "<p style='color:green;'>Item(s) permanently deleted </p>";
			$success_message= "<div class='alert alert-success' role='alert'>
								  Item(s) permanently deleted!
								</div>";
			$has_success=true;
           }

			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	//end of insert
	}

	?>