<?php 

if (array_key_exists("txtusername", $_POST)) {
		$formdata["user"] = $_POST["txtusername"];
	    $formdata["name"] = $_POST["txtname"];
	    $formdata["dept"] = $_POST["txtdepartment"];

	    $user = $formdata["user"];
        $name = $formdata["name"];
        $dept = $formdata["dept"];

		$sql = "UPDATE user_account SET username = '". $formdata["user"]." ', name = '". $formdata["name"]."', department = '". $formdata["dept"]." ' WHERE userID = {$suserID} ";

	    if (mysqli_query($conn, $sql)) {
	        //echo "<p style='color:green;'>change of info successful</p>";

	    	$success_message = "<div class='alert alert-success' role='alert'>
			                                Change of Info Successful!
			                              </div>";
			$has_success = true;

			

	        //log
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed info', '".$dateandtime."')";
			if ($result = $conn->query($sql)) {
				
			}
	    } else {
	        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	    
	}
	else {

		$sql = "SELECT username,name,department,password FROM user_account WHERE userID LIKE $suserID";

		if ($result = $conn->query($sql)) {

	        if ($result->num_rows > 0) {
	        	
	            $obj = $result->fetch_object();
				//var_dump($obj);
	            
	            $user = $obj->username;
	            $name = $obj->name;
	            $dept = $obj->department;
	            $pass = $obj->password;

	        } else {
	            //fail
	            
	        }

	        $result->close();
		}
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

	if (array_key_exists("txtoldpass", $_POST)) {
		$formdata["oldpass"] = $_POST["txtoldpass"];
	    $formdata["newpass"] = $_POST["txtnewpass"];
	
	    if($pass == md5($formdata["oldpass"])){

		    $sql = "UPDATE user_account SET password = '". md5($formdata["newpass"])."' WHERE userID = $suserID ";
		    //747bda46b83d0f642ccb846d9a8c1cbe

		    if (mysqli_query($conn, $sql)) {
		        //echo "<p style='color:green;'>change of info successful</p>";

		        $success_message = "<div class='alert alert-success' role='alert'>
			                                Change of Info Successful!
			                              </div>";
				$has_success = true;

		        //log
				$userloggedin = $_SESSION["userID"];
				$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
				$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed password', '".$dateandtime."')";
				if ($result = $conn->query($sql)) {
					
				}


		    } else {
		        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		    }
		}
		else { 
			//echo "<p> style='color:red;'>Wrong Password. try again.</p>"; 

			$error_message = "<div class='alert alert-danger' role='alert'>
			                                Wrong password. Try Again!
			                              </div>";
			$has_error = true;
		}
	}

?>