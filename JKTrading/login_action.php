<?php

	$formdata = array();
	$formdata["user"] = '';
	$formdata["pass"] = '';
	$formdata["lvl"] = '';
	
    $has_error = false;	
    $loginactiondone = false;

	date_default_timezone_set('Asia/Manila');
	$timezone = date_default_timezone_get();
	$date = date('Y/m/d h:i:sa', time());

	if (array_key_exists("username", $_POST)) {
		$formdata["user"]  = $_POST["username"];
    	$formdata["pass"]  = $_POST["password"];
		$loginactiondone = true;
		
    	$pwd = md5($formdata["pass"]);

    	$sql = "SELECT userID,name,userLevel,branch_id,isActive,isOnline FROM user_account WHERE username = '". $formdata["user"] ."' AND password = '". $pwd ."'";

    	if ($result = $conn->query($sql)) {

	        if ($result->num_rows > 0) {
	        	
	            $obj = $result->fetch_object();

	            $_SESSION['name'] = $obj->name;
				$_SESSION['userID'] = $obj->userID;
				$_SESSION['branch_id'] = $obj->branch_id;
				
				$_SESSION['isActive'] = $obj ->isActive;
				$isOnline = $obj->isOnline;
	            $level = $obj->userLevel;
	            $_SESSION['userLevel'] = $level;
	            $accountActive = $obj->isActive;
	            //echo $_SESSION['userID'];

	            //log
	            $userloggedin = $obj->userID;
	            $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
	            $sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'User Logged in', '".$dateandtime."')";
					
	            if ($result = $conn->query($sql)) {
	            	
	            }


	        } else {
	            $has_error = true;
	            $error_message = "Login Failed. Username or password does not match records!";
	        }

    	}
	}