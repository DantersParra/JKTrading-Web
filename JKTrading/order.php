<?php
class ItemCart
{
  public $itemList = array();
  public $cartList = array();
  function getProducts()
    {
    global $conn;
       $query = "SELECT * FROM item_type";
       $results = mysqli_query($conn, $query);
       $this->itemList = $results;

     }
     function consumeProducts($branchID)
     {
       global $conn;
       $query = "select a.ritem_id, a.branch_id, a.dateReceived_item, b.item_name, a.type_id,b.item_unit, a.ritem_stock FROM restaurant_inventory as a, item_type as b WHERE a.branch_id ='".$branchID."' and a.type_id=b.type_id";
       $results = mysqli_query($conn, $query);
       $this->itemList = $results;
     }
}