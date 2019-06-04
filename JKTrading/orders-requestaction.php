<?php
$success_message = '';
    $error_message = '';
    $has_error=false;
    $has_success=false;
if(array_key_exists("requestAction", $_POST)) {
      $sql = "UPDATE order_request SET request_status = 'Processing' WHERE request_id=".$_POST['request_id'];
      $result = $conn->query($sql);
}

if(array_key_exists("requestActions", $_POST)) {
	




        $orderQuantity=array();
		    	$item_qty=array();
		    	$itemID=array();
		    	//$sql = "SELECT * FROM order_details JOIN order_request ON order_details.request_id=order_request.request_id JOIN commissary_inventory ON commissary_inventory.type_id=order_details.type_id where order_details.request_id=".$_POST['request_id'];
				//$sql = "SELECT * FROM order_details JOIN order_request ON order_details.request_id=order_request.request_id JOIN commissary_inventory ON com_onhand_inventory.type_id=order_details.type_id where order_details.request_id=".$_POST['request_id'];
				$sql = "SELECT * FROM order_details JOIN order_request ON order_details.request_id=order_request.request_id JOIN com_onhand_inventory ON com_onhand_inventory.type_id=order_details.type_id where order_details.request_id= ".$_POST['request_id'];
				if ($result = $conn->query($sql)) {


				if($result->num_rows>0){

		        for($i=0; $i<$result->num_rows; $i++) {
		        	
		            $obj = $result->fetch_object();
					//var_dump($obj);
		            array_push($itemID,$obj->type_id);
		            array_push($orderQuantity,$obj->order_quantity);
	            	array_push($item_qty,$obj->item_qty);
	            	
		        }

		        } else {
		            //fail
		            
		        }
				$lowStock=false;
		        $result->close();
				}
				for($i=0; $i<sizeof($itemID); $i++){
	        		if((int)$item_qty[$i]<(int)$orderQuantity[$i])
		        		{
							$lowStock=true;
						}
        		}

		
		

		



        if($lowStock==false)
        {
	        for($i=0; $i<sizeof($itemID); $i++){

					//$sql = "UPDATE commissary_inventory SET citem_stock = ".(int)((int)$itemStock[$i]-(int)$orderQuantity[$i])." WHERE type_id = ".$itemID[$i];
					$sql = "UPDATE com_onhand_inventory	SET item_qty = ".(int)((int)$item_qty[$i]-(int)$orderQuantity[$i])." WHERE type_id = ".$itemID[$i];
					mysqli_query($conn, $sql);
					}
			        $success_message= "<div class='alert alert-success' role='alert'>
								  Delivered
								</div>";
				$has_success=true;
			$sql = "UPDATE order_request SET request_status = 'Delivered' WHERE request_id=".$_POST['request_id'];
        	$result = $conn->query($sql);
        }

			else
			{
				$error_message= "<div class='alert alert-danger' role='alert'>
				  Some of the products are on Low Stock
				</div>";
				$has_error=true;
			}
        //$sql = "UPDATE commissary_inventory SET citem_stock = 'Delivered' WHERE request_id=".$_POST['request_id'];
        //$sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'User Delivery Request', '".$dateandtime."')";
				
		$result = $conn->query($sql);
	            	
	            	
	            

    }