<?php
require_once("constants.php");
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//echo "connected!";

$itemtype_query = "SELECT * FROM `com_onhand_inventory`";
$comInventory_query = "SELECT * FROM `commissary_inventory`";
//$resInventory1_query ="SELECT a . * , b . * FROM restaurant_inventory AS a INNER JOIN item_type AS b ON a.type_id = b.type_id WHERE a.branch_id =1";
$resInventory1_query ="SELECT * FROM `b1_onhand_inventory` ";
$resInventory2_query ="SELECT * FROM `b2_onhand_inventory` ";
$resInventory3_query ="SELECT * FROM `b3_onhand_inventory` ";

$result1 = mysqli_query($conn,$itemtype_query);
$result2 = mysqli_query($conn,$comInventory_query);
$result3 = mysqli_query($conn,$resInventory1_query);
$result4 = mysqli_query($conn,$resInventory2_query);
$result5 = mysqli_query($conn,$resInventory3_query);
?>