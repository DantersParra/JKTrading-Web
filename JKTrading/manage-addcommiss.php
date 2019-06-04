<?php

	$formdata = array();
	$formdata["user"] = '';
	$formdata["pass"] = '';
	$formdata["name"] = '';

	if (array_key_exists("comm_username", $_POST)) {


		$formdata["user"] = $_POST["comm_username"];
	    $formdata["pass"] = $_POST["password"];
	    $formdata["name"] = $_POST["fullname"];
		$userName = $formdata["user"];
		$password = $formdata["pass"];
		$fullName = $formdata["name"];
		

		$pwd = md5($formdata["pass"]);

		if(empty($userName) ||empty($password) || empty($fullName) )
		{
			//echo "<p style='color:red;'>Invalid input, please try again</p>";
			$error_message = "<div class='alert alert-danger' role='alert'>
			                                Commissary Account Creation Failed!
			                              </div>";
			$has_error = true;
		}
		else{
		$sql = "INSERT INTO user_account (username, password, branch_id,name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '4',  '". $formdata["name"] ."', 'Commissary', 1, 1)";
        
        if (mysqli_query($conn, $sql)) {

			//echo "<p style='color:green;'>account created</p>";
			$success_message = "<div class='alert alert-success' role='alert'>
			                                Manager Account Creation Successful!
			                              </div>";
			$has_success = true;
			
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			
			$sql2 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed password', '".$dateandtime."')";
				if ($result = $conn->query($sql2)) {
					
				}

	    } else {
	        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}//end of insert
	}

?>