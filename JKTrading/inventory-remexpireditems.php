<?php

if (array_key_exists("removebranchItems", $_POST)) {

	if($_SESSION['branch_id']=="1")
				{
				$sql4= "UPDATE b1_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql4);
				}
	else if($_SESSION['branch_id']=="2")
				{
				$sql5= "UPDATE b2_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql5);
				}

	else if($_SESSION['branch_id']=="3")
				{
				$sql5= "UPDATE b3_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql6);
				}	
			
		$sql ="DELETE FROM restaurant_inventory WHERE expired_flag=1";
	//	$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, '".$formdata["level"]."')";
		if (mysqli_query($conn, $sql)) {
			//log
			
	        $userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql3 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Removed expired items', '".$dateandtime."')";
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