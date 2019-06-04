<?php
$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
	$current_time = $dt ->format('Y-m-d G:i:s');
	$date = date('Y/m/d h:i:s', time());
if ( isset($_POST["reqId"]) ) 
{
	$requestIDUpdate = $_POST["reqId"];
	
	global $connection;
    $sql = "UPDATE order_request SET request_status = 'Received Delivery' WHERE request_id = {$requestIDUpdate} ";
    mysqli_query($connection, $sql);


    $sql="SELECT * from order_details WHERE request_id=".$_POST["reqId"];
    $result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {

			$sql = "INSERT INTO restaurant_inventory(branch_id,type_id,ritem_ever,ritem_stock,dateReceived_item,ritem_id) VALUES (".$_SESSION['branch_id'].",".$row['type_id'].","."50".",".$row['order_quantity'].", '".$current_time."','".$_POST["reqId"]."')";
   			mysqli_query($connection, $sql);

			   $sql3= "UPDATE restaurant_inventory as a, item_type as b SET expectedExpiry_date=DATE_ADD('".$date."', INTERVAL (b.shelf_life + 1) DAY) WHERE a.type_id=b.type_id ";  
			   mysqli_query($conn, $sql3);
			   
			   if($_SESSION['branch_id']=="1")
			   {
			   $sql4= "UPDATE b1_onhand_inventory SET item_qty = item_qty + ".$row['order_quantity']." WHERE type_id=".$row['type_id']."" ;
			   mysqli_query($conn, $sql4);
			   
			   }

			   else if($_SESSION['branch_id']=="2")
			   {
			   $sql5= "UPDATE b2_onhand_inventory SET item_qty = item_qty + ".$row['order_quantity']." WHERE type_id=".$row['type_id']."" ;
			   mysqli_query($conn, $sql5);
			   
			   }

			   else if($_SESSION['branch_id']=="3")
			   {
			   $sql6= "UPDATE b3_onhand_inventory SET item_qty = item_qty + ".$row['order_quantity']." WHERE type_id=".$row['type_id']."" ;
			   mysqli_query($conn, $sql6);
			   
			   }

		}

	}

   
}

?>