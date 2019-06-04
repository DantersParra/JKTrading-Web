<?php

	$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $current_time = $dt ->format('Y-m-d G:i:s');

    $success_message = '';
    $error_message = '';
    $has_error=false;
    $has_success=false;

	if (isset($_POST["ritem_id"],$_POST["itemQty"]))  {
		$formdata["itemQty"] = $_POST['itemQty'];
		$formdata["ritem_id"] = $_POST['ritem_id'];
		$formdata["ritem_stock"] = $_POST['ritem_stock'];
		$formdata["type_id"] = $_POST['type_id'];
		if(!empty($formdata["itemQty"])&&$formdata["itemQty"]>0)
		{
			if($formdata["ritem_stock"]>=$formdata["itemQty"])
			{
				$sql = "INSERT INTO restaurant_consumed_inventory( ritem_id,branch_id,type_id,quantity,dateConsumed_item) VALUES ('".$formdata['ritem_id']."','".$_SESSION['branch_id']."','".$formdata['type_id']."','".$formdata['itemQty']."','".$current_time."')";
				mysqli_query($conn, $sql);
				$requestId = mysqli_insert_id($conn);
				$sql2 = "UPDATE restaurant_inventory SET ritem_stock = ".(int)((int)$formdata['ritem_stock']-(int)$formdata["itemQty"])." WHERE ritem_id = ".$formdata["ritem_id"];
				
				
				if($_SESSION['branch_id']=="1")
			   {
			   $sql4= "UPDATE b1_onhand_inventory SET item_qty = item_qty - ".(int)$formdata['itemQty']." WHERE type_id=".$formdata['type_id']."" ;
			   mysqli_query($conn, $sql4);

				 
			   }

			   else if($_SESSION['branch_id']=="2")
			   {
				$sql5= "UPDATE b2_onhand_inventory SET item_qty = item_qty - ".(int)$formdata['itemQty']." WHERE type_id=".$formdata['type_id']."" ;
				mysqli_query($conn, $sql5);
			   
			   }

			   else if($_SESSION['branch_id']=="3")
			   {
				$sql6= "UPDATE b3_onhand_inventory SET item_qty = item_qty - ".(int)$formdata['itemQty']." WHERE type_id=".$formdata['type_id']."" ;
				mysqli_query($conn, $sql6);
					 
			   }

				 


					mysqli_query($conn, $sql2);
				$success_message= "<div class='alert alert-success' role='alert'>
								  Action Successful
								</div>";
				$has_success=true;
			}
			else
			{
				$error_message= "<div class='alert alert-danger' role='alert'>
				  Consumed product is greater than the stock!
				</div>";
				$has_error=true;
			}
		}
		else
		{
			$error_message= "<div class='alert alert-danger' role='alert'>
				  Input appropriate Quantity value!
				</div>";
			$has_error=true;
		}
	}


	?>