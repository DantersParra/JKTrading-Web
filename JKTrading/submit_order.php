<?php
include_once('common-db.php');


	session_start();
	$formdata = array();
	$qty = $_POST['itemQty'];

	$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $current_time = $dt ->format('Y-m-d G:i:s');

	if ( isset($_POST) && isset($_SESSION['userID']) ) {
		$suserID = $_SESSION['userID'];
		$formdata["itemQty"] = $_POST['itemQty'];
		$formdata["typeId"] = $_POST['typeId'];


			$sql = "INSERT INTO order_request( request_status,request_orderedBy,dateOrdered) VALUES ('Received','".$_SESSION['branch_id']."','".$current_time."')";
			mysqli_query($conn, $sql);
			$requestId = mysqli_insert_id($conn);

			for ($i=0; $i < count($formdata["typeId"]) ; $i++) { 
				$sql2 = "INSERT INTO order_details(request_id,type_id,order_quantity,dateOrdered) VALUES('".$requestId."','".$formdata["typeId"][$i]."','".$formdata["itemQty"][$i]."','".$current_time."')";
				mysqli_query($conn, $sql2);
			}

			
			echo "<p style='color:green;'>Success.</p>";


	
	}

	
	header('Location: orders.php');
	    
?>
<?php include_once('order.php'); ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

</body>
</html>