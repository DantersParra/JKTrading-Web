<?php
	include_once("common-db.php");
	session_start();

	//log
	$userloggedin = $_SESSION["userID"];
	$dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
	$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'logged out', '".$dateandtime."')";
	if ($result = $conn->query($sql)) {
		
	
    }

	/*$onlineflag = "UPDATE user_account SET isOnline = 0 WHERE userID = ". $userloggedin ." ";

	if ($result = $conn->query($onlineflag)) {
					
	}*/
	$_SESSION["userID"] = "";
	$_SESSION["name"] = "";
	session_destroy();

	header('Location: login.php');
	
	exit;

?>