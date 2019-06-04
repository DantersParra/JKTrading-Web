<?php


	$formdata = array();
	$formdata["user"] = '';
	$formdata["pass"] = '';
	$formdata["name"] = '';

	if (array_key_exists("username", $_POST)) {


		$formdata["user"] = $_POST["username"];
	    $formdata["pass"] = $_POST["password"];
	    $formdata["name"] = $_POST["fullname"];
		$formdata["branch"] = $_POST["chosenbranch"];
		$userName = $formdata["user"];
		$password = $formdata["pass"];
		$fullName = $formdata["name"];
		

		$pwd = md5($formdata["pass"]);

		if(empty($userName) ||empty($password) || empty($fullName) )
		{
			//echo "<p style='color:red;'>Invalid input, please try again</p>";
			$error_message = "<div class='alert alert-danger' role='alert'>
			                                Account Creation Failed!
			                              </div>";
			$has_error = true;
		}
		else{
		if($formdata["branch"]==4)
		{
			$sql = "INSERT INTO user_account (username, password, branch_id,name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '".$formdata["branch"]."',  '". $formdata["name"] ."', 'none', 1, 2)";
        	
		}
		else{	
		$sql = "INSERT INTO user_account (username, password, branch_id,name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '".$formdata["branch"]."',  '". $formdata["name"] ."', 'none', 1, 0)";
		}
        if (mysqli_query($conn, $sql)) {

			//echo "<p style='color:green;'>account created</p>";
			$success_message = "<div class='alert alert-success' role='alert'>
			                                Account Creation Successful!
			                              </div>";
			$has_success = true;
			
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			
			$sql2 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'added new manager', '".$dateandtime."')";
				if ($result = $conn->query($sql2)) {
					
				}

	    } else {
	        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}//end of insert
	}

	
	if(array_key_exists("emptyInv", $_POST)) {

		$formdata["itemID"] = $_POST["txtDeleteItem"];
		$itemID = $formdata["itemID"];
	

		  
		  $sql1 ="DELETE FROM `b1_onhand_inventory` WHERE 1";
		  $sql2 ="DELETE FROM `b2_onhand_inventory` WHERE 1";
		  $sql3 ="DELETE FROM `b3_onhand_inventory` WHERE 1";
		  $sql4 ="DELETE FROM `item_type` WHERE 1";
		  $sql5 ="DELETE FROM `com_onhand_inventory` WHERE 1";
		  
			if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)) {
			  //echo "<p style='color:green;'>change of info successful</p>";
			  $sql6 = "ALTER TABLE  `b1_onhand_inventory` AUTO_INCREMENT =1";
			  $sql7 = "ALTER TABLE  `b2_onhand_inventory` AUTO_INCREMENT =1";
			  $sql8 = "ALTER TABLE  `b3_onhand_inventory` AUTO_INCREMENT =1";
			  $sql9 = "ALTER TABLE  `item_type` AUTO_INCREMENT =1";
			  $sql10 = "ALTER TABLE  `com_onhand_inventory` AUTO_INCREMENT =1";

			  if (mysqli_query($conn, $sql6) && mysqli_query($conn, $sql7) && mysqli_query($conn, $sql8) && mysqli_query($conn, $sql9) && mysqli_query($conn, $sql10)) {
			  $alertMessage = "<div class='alert alert-success' role='alert'>
							  Change of Info Successful!
							</div>";
		  $hasAlertMessage = true;

			  }
			  
			  //log
		  $userloggedin = $_SESSION["userID"];
		  $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
		  $sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed item info', '".$dateandtime."')";
		  if ($result = $conn->query($sql)) {
			   //     echo "<p style='color:green;'>change of info successful</p>"; 
		  }
		  } else {
			   // echo "<p style='color:red;'>Wrong Item Info. try again.</p>";

				$alertMessage = "<div class='alert alert-danger' role='alert'>
							  Wrong Item Info. Try Again!
							</div>";
				 $hasAlertMessage = true;
			  //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
	  
	}

?>