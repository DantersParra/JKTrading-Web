<?php

$success_message = '';
    $error_message = '';
    $has_error=false;
    $has_success=false;

	include_once("common-db.php");

	$suserID = $_SESSION['userID'];
	$sname = $_SESSION['name'];
	$ulevel = $_SESSION['userLevel'];

    $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $current_time = $dt ->format('Y-m-d G:i:s');
    
	$sql2 = "SELECT shelf_life FROM item_type";
	

	if (!isset($_SESSION['userID']))
	{
    header("Location: login.php");
	}
    
    /*
	if($ulevel ==0)
	{
		header("Location: restaurant_index.php");
		
	}
    */


	if(array_key_exists("accountAction", $_POST)) {

		//var_dump($_POST);
		$newStatus = $_POST['accountStatus'];
		$newStatus = !$newStatus;

		$sql = "UPDATE user_account SET isActive = '". $newStatus ." ' WHERE userID = ". $_POST['accountID'] ." ";
		$result = $conn->query($sql);
        
	            

    }

    if (array_key_exists("removedmgItems", $_POST)) {

		
		$sql = "DELETE FROM commissary_dmgrecbin";
		if (mysqli_query($conn, $sql)) {
				$userloggedin = $_SESSION["userID"];
				$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
				$sql4 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Removed damaged Items', '".$dateandtime."')";
			if (mysqli_query($conn, $sql4)) {
					//echo "<p style='color:green;'>Damaged Item(s) deleted</p>";
					$success_message= "<div class='alert alert-success' role='alert'>
								  Damaged Item(s) Deleted!
								</div>";
					$has_success=true;
			
				}
			
			
			
			
			
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	//end of insert
	}
    
?> 