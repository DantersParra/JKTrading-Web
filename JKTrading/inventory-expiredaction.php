	<?php



	if (array_key_exists("moveItems", $_POST)) {

			$expiredflag = 1;
			//$sql6= "UPDATE com_onhand_inventory as a , commissary_inventory as b SET a.item_qty = a.item_qty - b.citem_stock WHERE b.expired_flag=1" ;
			$sql6= "UPDATE com_onhand_inventory as a , commissary_inventory as b SET a.item_qty = case when (a.item_qty - b.citem_stock) > 0 then (a.item_qty - b.citem_stock) else '0' end WHERE b.expired_flag=1" ;
			mysqli_query($conn, $sql6);
					
			$sql ="INSERT INTO commissary_recbin (citem_id,type_id,citem_ever,citem_stock,expectedExpiry_date) SELECT citem_id,type_id,citem_ever,citem_stock,expectedExpiry_date FROM commissary_inventory WHERE commissary_inventory.expired_flag = 1";
			$sql3 = "DELETE FROM commissary_inventory WHERE expired_flag = '".$expiredflag."'";
			
			if (mysqli_query($conn, $sql)) {
				if (mysqli_query($conn, $sql3)) {
					

					$userloggedin = $_SESSION["userID"];
					$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
					$sql4 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Moved items to recycle bin', '".$dateandtime."')";
				if (mysqli_query($conn, $sql4)) {
						//echo "<p style='color:green;'>Item(s) moved to recycle bin</p>";

						$success_message= "<div class='alert alert-success' role='alert'>
										Action Successful!
									</div>";
						$has_success=true;
				
					}
				
				
				
				
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