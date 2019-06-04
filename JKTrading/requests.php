<?php 
require_once("connection.php");
class OrderRequests
{
	public $id;
	public $status;
	public $orderedBy;
	public $orderList = array();
	function getAllOrders()
    {
		 global $connection;
   	 	 $query = "SELECT * FROM order_request where request_status='Delivered'";
   		 $results = mysqli_query($connection, $query);
   		 $this->orderList = $results;
   		 mysqli_close($connection);
   	 }
}
?>