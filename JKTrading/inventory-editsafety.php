<?php

$success_message = '';
    $error_message = '';
    $has_error=false;
    $has_success=false;

if (array_key_exists("chosenID", $_POST)) {
	
        $formdata["itemID"] = $_POST["chosenID"];
	    $formdata["itemSafetyLevel"] = $_POST["txtnewSafetyLevel"]; 
        


        //$itemID = $formdata["itemID"];
        $itemID = $formdata["itemID"];
        $itemSafetyLevel = $formdata["itemSafetyLevel"];
		
		if((empty($itemID)  || empty($itemSafetyLevel)) || !is_numeric($itemSafetyLevel) || $itemSafetyLevel <=0 ){
			//echo "<p style='color:red;'>Invalid input. try again.</p>";
			$error_message= "<div class='alert alert-danger' role='alert'>
				  Invalid Input. Try again!
				</div>";
			$has_error=true;
		}
		else{
        //$sql = "UPDATE item_type SET item_name='".$formdata["itemName"]."', item_unit ='".$formdata["itemUnit"]."' WHERE type_id='".$formdata["itemID"]."'";
        $sql="UPDATE com_onhand_inventory SET safety_lvl='".$formdata["itemSafetyLevel"]."'  WHERE type_id='".$formdata["itemID"]."'";
				$sql2="UPDATE b1_onhand_inventory SET safety_lvl='".$formdata["itemSafetyLevel"]."'  WHERE type_id='".$formdata["itemID"]."'";
        $sql3="UPDATE b2_onhand_inventory SET safety_lvl='".$formdata["itemSafetyLevel"]."'  WHERE type_id='".$formdata["itemID"]."'";
        $sql4="UPDATE b3_onhand_inventory SET safety_lvl='".$formdata["itemSafetyLevel"]."'  WHERE type_id='".$formdata["itemID"]."'";
        
				if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)&& mysqli_query($conn, $sql3)&& mysqli_query($conn, $sql4)) {
	        //echo "<p style='color:green;'>change of info successful</p>";
        	$success_message= "<div class='alert alert-success' role='alert'>
								  Change of Item Info Successful!
								</div>";
			$has_success=true;

	        //log
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Updated inventory stock info', '".$dateandtime."')";
			if ($result = $conn->query($sql)) {
           //     echo "<p style='color:green;'>change of info successful</p>";	
			}
	    } else {
            //echo "<p style='color:red;'>Wrong Item Info. try again.</p>";
	        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	        $error_message= "<div class='alert alert-danger' role='alert'>
				  Wrong Item Info. Try again!
				</div>";
				$has_error=true;
		}
	}//end of update
        
    }

    ?>