<?php
$success_message = '';
    $error_message = '';
    $has_error=false;
    $has_success=false;

if (array_key_exists("chosenID", $_POST)) {
	
		date_default_timezone_set('Asia/Manila');
		$timezone = date_default_timezone_get();
		$date = date('Y/m/d h:i:s', time());
    

        $formdata["itemID"] = $_POST["chosenID"];
	   
        $formdata["itemStock"] = $_POST["txtupdateStock"];
        
	    //$itemID = $formdata["itemID"];
        $itemID = $formdata["itemID"];
        
		$itemStock = $formdata["itemStock"];

		if((empty($itemID) ||empty($itemStock ))  || !is_numeric($itemStock) || $itemStock <0){
			//echo "<p style='color:red;'>Invalid input. try again.</p>";
			$error_message= "<div class='alert alert-danger' role='alert'>
				  Invalid Input. Try again!
				</div>";
			$has_error=true;
		}
		else{
        $sql = "UPDATE commissary_inventory as a, item_type as b SET citem_stock = '".$formdata["itemStock"]."' , dateModified_item='".$date."',expectedExpiry_date=DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY)  WHERE  citem_id='".$formdata["itemID"]."' AND a.type_id=b.type_id ";  
		
		if (mysqli_query($conn, $sql)) {
	        //echo "<p style='color:green;'>change of info successful</p>";

	        $success_message= "<div class='alert alert-success' role='alert'>
								  Change of Info Successful!
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
	
	//start of insert
	if (array_key_exists("newItem", $_POST)) {
	
		date_default_timezone_set('Asia/Manila');
		$timezone = date_default_timezone_get();
		$date = date('Y/m/d h:i:s', time());
	
        $formdata["newitemID"] = $_POST["newItem"];
	    $formdata["newSafetylvl"] = $_POST["txtnewSafety"];
        $formdata["newitemStock"] = $_POST["txtnewStock"];
		$_currTime = date_default_timezone_get();


        //$itemID = $formdata["itemID"];
        $newitemID = $formdata["newitemID"];
		
		$newitemStock = $formdata["newitemStock"];
		$flag = 0;
		if((empty($newitemID) ||empty($newitemStock ))  || !is_numeric($newitemStock) || $newitemStock <0){
			//echo "<p style='color:red;'>Invalid input. try again.</p>";
			$error_message= "<div class='alert alert-danger' role='alert'>
				  Invalid Input. Try again!
				</div>";
			$has_error=true;

		}
		else{
        //$sql = "UPDATE item_type SET item_name='".$formdata["itemName"]."', item_unit ='".$formdata["itemUnit"]."' WHERE type_id='".$formdata["itemID"]."'";
		//$sql="UPDATE commissary_inventory SET citem_stock ='".$formdata["itemStock"]."'  WHERE citem_id='".$formdata["itemID"]."'";
		//"UPDATE commissary_inventory as a, item_type as b SET citem_stock = '".$formdata["itemStock"]."' , dateModified_item='".$date."',expectedExpiry_date=DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY)  WHERE  citem_id='".$formdata["itemID"]."' AND a.type_id=b.type_id ";  
		
		$sql = "INSERT INTO commissary_inventory(type_id,citem_ever,citem_stock,dateReceived_item,dateModified_item, expired_flag) VALUES('".$formdata["newitemID"]."','".$formdata["newSafetylvl"]."', '".$formdata["newitemStock"]."','".$date."','".$date."','".$flag."')";
		//"INSERT INTO commissary_inventory as type_id,citem_ever,citem_stock,dateReceived_item,dateModified_item, expired_flag,expectedExpiry_date) VALUES('".$formdata["newitemID"]."','".$formdata["newSafetylvl"]."', '".$formdata["newitemStock"]."','".$date."','".$date."','".$flag."', DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY)) ";
		
		if (mysqli_query($conn, $sql)) {

			$sql3= "UPDATE commissary_inventory as a, item_type as b SET expectedExpiry_date=DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY) WHERE a.type_id=b.type_id ";  
			if (mysqli_query($conn, $sql3)) {
				//echo "<p style='color:green;'>Insert of new item info successful</p>";
				$sql66= "UPDATE com_onhand_inventory SET item_qty = item_qty + ".$formdata["newitemStock"]." WHERE type_id='".$formdata["newitemID"]."' ";
				mysqli_query($conn, $sql66);
			
				$success_message= "<div class='alert alert-success' role='alert'>
								  Insert of New Item Info Successful!
								</div>";
				$has_success=true;
				//log
			
			}
			else
			{

				//echo "<p style='color:red;'>Error</p>";

				$error_message= "<div class='alert alert-danger' role='alert'>
				  Error. Try again!
				</div>";
				$has_error=true;
			}




	        //log
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Insert new inventory stock info', '".$dateandtime."')";
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
	}//end of insert
        
    }

?>