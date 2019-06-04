<?php
include_once("common-db.php");



			$sql = "SELECT * FROM order_request JOIN order_details ON order_request.request_id=order_details.request_id JOIN item_type  ON order_details.type_id=item_type.type_id where order_request.request_id=".$_GET['id'];
			$orderResult = $conn->query($sql);
			$data=[];
			while($dataDb = $orderResult->fetch_assoc()){
				array_push($data,json_encode($dataDb));
			}

			echo json_encode($data);


?>