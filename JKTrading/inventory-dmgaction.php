<?php



	include_once("common-db.php");

	$suserID = $_SESSION['userID'];
	$sname = $_SESSION['name'];
	$ulevel = $_SESSION['userLevel'];
	$branchid = $_SESSION['branch_id'];
	//$sqli = "SELECT `item_name` FROM `item_type`";
	//$resultSet = $conn->query($sqli);
	
   
	if (!isset($_SESSION['userID']))
	{
    header("Location: login.php");
	}
	
	

	/* get local pc timezone */
	$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
	$current_time = $dt ->format('Y-m-d G:i:s');

	date_default_timezone_set('Asia/Manila');
	$timezone = date_default_timezone_get();
	$date = date('Y/m/d h:i:s', time());
	/*--------------------------*/

	if(array_key_exists("accountAction", $_POST)) {

		//var_dump($_POST);
		$newStatus = $_POST['accountStatus'];
		$newStatus = !$newStatus;

		$sql = "UPDATE user_account SET isActive = '". $newStatus ." ' WHERE userID = ". $_POST['accountID'] ." ";
		$result = $conn->query($sql);
    }
	
	

	if (array_key_exists("chosenID", $_POST)) {
	
        $formdata["itemID"] = $_POST["chosenID"];
	   
        $formdata["itemStock"] = $_POST["txtupdateStock"];
        


        //$itemID = $formdata["itemID"];
        $itemID = $formdata["itemID"];
        
		$itemStock = $formdata["itemStock"];

		if((empty($itemID) ||empty($itemStock ))  || !is_numeric($itemStock) || $itemStock <0){
			//echo "<p style='color:red;'>Invalid input. try again.</p>";
			$error_message= "<div class='alert alert-danger' role='alert'>
								  Invalid Input. Try Again!
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
								  Wrong Item Info. Try Again!
								</div>";
			$has_error=true;

		}
	}//end of update
        
	}
	
	//start of insert
	if (array_key_exists("dmgItem", $_POST)) {
    
        $formdata["itemID"] = $_POST["dmgItem"];
        $formdata["txtcomment"] = $_POST["txtcomment"];
		$formdata["txtqty"] = $_POST["txtqty"];
		$_currTime = date_default_timezone_get();

        if($formdata["txtcomment"] =="")
        {
            $formdata["txtcomment"] = "None";
        }

        //$itemID = $formdata["itemID"];
        $newitemID = $formdata["itemID"];
		
		$txtcomment = $formdata["txtcomment"];
		$flag = 0;
		if(empty($newitemID)){
			//echo "<p style='color:red;'>Invalid input. try again.</p>";

			$error_message= "<div class='alert alert-danger' role='alert'>
								  Invalid Input. Try Again!
								</div>";
			$has_error=true;
		}
		else{
        //$sql = "UPDATE item_type SET item_name='".$formdata["itemName"]."', item_unit ='".$formdata["itemUnit"]."' WHERE type_id='".$formdata["itemID"]."'";
		//$sql="UPDATE commissary_inventory SET citem_stock ='".$formdata["itemStock"]."'  WHERE citem_id='".$formdata["itemID"]."'";
		//"UPDATE commissary_inventory as a, item_type as b SET citem_stock = '".$formdata["itemStock"]."' , dateModified_item='".$date."',expectedExpiry_date=DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY)  WHERE  citem_id='".$formdata["itemID"]."' AND a.type_id=b.type_id ";  
		
//		$sql = "INSERT INTO commissary_inventory(type_id,citem_ever,citem_stock,dateReceived_item,dateModified_item, expired_flag) VALUES('".$formdata["newitemID"]."','".$formdata["newSafetylvl"]."', '".$formdata["newitemStock"]."','".$date."','".$date."','".$flag."')";
		$sql ="INSERT INTO commissary_dmgrecbin(branch_id, ritem_id,type_id,ritem_stock,remarks) SELECT branch_id, ritem_id,type_id,'".$formdata["txtqty"]."','".$formdata["txtcomment"]."' FROM restaurant_inventory WHERE restaurant_inventory.ritem_id = '".$formdata["itemID"]."' ";

        //"INSERT INTO commissary_inventory as type_id,citem_ever,citem_stock,dateReceived_item,dateModified_item, expired_flag,expectedExpiry_date) VALUES('".$formdata["newitemID"]."','".$formdata["newSafetylvl"]."', '".$formdata["newitemStock"]."','".$date."','".$date."','".$flag."', DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY)) ";
		
		if (mysqli_query($conn, $sql)) {

			/*
            $sql2 = "DELETE FROM restaurant_inventory WHERE ritem_id = '".$formdata["itemID"]."' ";
            mysqli_query($conn,$sql2);
*/
			if($_SESSION['branch_id']=="1")
				{
				$sql4= "UPDATE b1_onhand_inventory SET item_qty = item_qty - ".(int)$formdata["txtqty"]." WHERE type_id=".$formdata["itemID"]."" ;
				mysqli_query($conn, $sql4);
				
				}

				else if($_SESSION['branch_id']=="2")
				{
				$sql5= "UPDATE b2_onhand_inventory SET item_qty = item_qty - ".(int)$formdata["txtqty"]." WHERE type_id=".$formdata["itemID"]."" ;
				mysqli_query($conn, $sql5);
					
				}

				else if($_SESSION['branch_id']=="3")
				{
				$sql6= "UPDATE b3_onhand_inventory SET item_qty = item_qty - ".(int)$formdata["txtqty"]." WHERE type_id=".$formdata["itemID"]."" ;
				mysqli_query($conn, $sql6);
					
				}



				//echo "<p style='color:green;'>Damaged items returned</p>";
				//log
				$success_message= "<div class='alert alert-success' role='alert'>
								  Damaged Items Returned!
								</div>";
				$has_success=true;
            
  

	        //log
			$userloggedin = $_SESSION["userID"];
			$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
			$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Returned damaged items', '".$dateandtime."')";
			if ($result = $conn->query($sql)) {
           //     echo "<p style='color:green;'>change of info successful</p>";	
			}
	    } else {
            //echo "<p style='color:red;'>Wrong Item Info. try again.</p>";
	        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	        $error_message= "<div class='alert alert-danger' role='alert'>
								  Wrong Item Info. Try Again!
								</div>";
			$has_error=true;
		}
	}//end of insert
        
    }
    
?>    
