<?php

if (array_key_exists("removeItems", $_POST)) {


	if($_SESSION['branch_id']=="1")
				{
				$sql4= "UPDATE b1_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql4);
				$expiredflag = 1;
				$sql ="DELETE FROM restaurant_inventory WHERE expired_flag ='".$expiredflag."' and branch_id = '".$sbranchID."'";
			//	$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, '".$formdata["level"]."')";
				if (mysqli_query($conn, $sql)) {
					//echo "<p style='color:green;'>Item deleted</p>";
					
			
			
			
				} else {
					//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			
					
				}
				}

				else if($_SESSION['branch_id']=="2")
				{
				$sql5= "UPDATE b2_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql5);
				$expiredflag = 1;
	$sql ="DELETE FROM restaurant_inventory WHERE expired_flag ='".$expiredflag."' and branch_id = '".$sbranchID."'";
//	$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, '".$formdata["level"]."')";
	if (mysqli_query($conn, $sql)) {
		//echo "<p style='color:green;'>Item deleted</p>";
		



	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
	}		
				}

				else if($_SESSION['branch_id']=="3")
				{
				$sql6= "UPDATE b3_onhand_inventory as a , restaurant_inventory as b SET a.item_qty = a.item_qty - b.ritem_stock WHERE b.expired_flag=1" ;
				mysqli_query($conn, $sql6);
				$expiredflag = 1;
	$sql ="DELETE FROM restaurant_inventory WHERE expired_flag ='".$expiredflag."' and branch_id = '".$sbranchID."'";
//	$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, '".$formdata["level"]."')";
	if (mysqli_query($conn, $sql)) {
		//echo "<p style='color:green;'>Item deleted</p>";
		



	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
	}					
				}


	
//end of insert
}