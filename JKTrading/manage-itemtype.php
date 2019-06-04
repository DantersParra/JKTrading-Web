<?php
$hasAlertMessage = false;

//============================================================================================================= manage item type

if(array_key_exists("emptyInv", $_POST)) {

  $formdata["itemID"] = $_POST["txtDeleteItem"];
  $itemID = $formdata["itemID"];


    
    $sql1 ="DELETE FROM `b1_onhand_inventory` WHERE 1";
    $sql2 ="DELETE FROM `b2_onhand_inventory` WHERE 1";
    $sql3 ="DELETE FROM `b3_onhand_inventory` WHERE 1";
    $sql4 ="DELETE FROM `item_type` WHERE 1";
    $sql5 ="DELETE FROM `com_onhand_inventory` WHERE 1";
    $sql6 ="DELETE FROM `commissary_inventory` WHERE 1";
    $sql7 ="DELETE FROM `restaurant_inventory` WHERE 1";
    $sql8 ="DELETE FROM `order_request` WHERE 1";
    $sql9 ="DELETE FROM `order_details` WHERE 1";
      
      if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5) && mysqli_query($conn,$sql6) && mysqli_query($conn,$sql7) && mysqli_query($conn,$sql8) && mysqli_query($conn,$sql9)) {
        //echo "<p style='color:green;'>change of info successful</p>";
        $sql6 = "ALTER TABLE  `b1_onhand_inventory` AUTO_INCREMENT =1";
        $sql7 = "ALTER TABLE  `b2_onhand_inventory` AUTO_INCREMENT =1";
        $sql8 = "ALTER TABLE  `b3_onhand_inventory` AUTO_INCREMENT =1";
        $sql9 = "ALTER TABLE  `item_type` AUTO_INCREMENT =1";
        $sql10 ="ALTER TABLE  `com_onhand_inventory` AUTO_INCREMENT =1";
        $sql11 ="ALTER TABLE `commissary_inventory` AUTO_INCREMENT = 1";
        $sql12 ="ALTER TABLE `order_request` AUTO_INCREMENT = 1";
        $sql13 ="ALTER TABLE `order_details` AUTO_INCREMENT = 1";
        
        if (mysqli_query($conn, $sql6) && mysqli_query($conn, $sql7) && mysqli_query($conn, $sql8) && mysqli_query($conn, $sql9) && mysqli_query($conn, $sql10) && mysqli_query($conn,$sql11) && mysqli_query($conn,$sql12) && mysqli_query($conn,$sql13) ) {
        $alertMessage = "<div class='alert alert-black' role='alert'>
                        Sucessful Reset
                      </div>";
    $hasAlertMessage = true;

        }
        
        //log
    $userloggedin = $_SESSION["userID"];
    $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
    $sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed item info', '".$dateandtime."')";
    if ($result = $conn->query($sql)) {
         //     echo "<p style='color:green;'>change of info successful</p>"; 
    }
    } else {
         // echo "<p style='color:red;'>Wrong Item Info. try again.</p>";

          $alertMessage = "<div class='alert alert-danger' role='alert'>
                        Wrong Item Info. Try Again!
                      </div>";
           $hasAlertMessage = true;
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}    


if (array_key_exists("txtIId", $_POST)) {
    
          $formdata["itemID"] = $_POST["txtIId"];
          $formdata["itemName"] = $_POST["txtIName"]; 
          $formdata["itemUnit"] = $_POST["updateditemtype"];
          $formdata["shelf_life"] = $_POST["txtILife"];
        
          $itemID = $formdata["itemID"];
          $itemName = $formdata["itemName"];
          $itemUnit = $formdata["itemUnit"];
          $sLife = $formdata["shelf_life"];
          if(empty($itemID) ||empty($itemName) || !is_numeric($sLife)){
            //echo "<p style='color:red;'>Missing Field. try again.</p>";
            $alertMessage = "<div class='alert alert-danger' role='alert'>
                                Missing Field. Try Again!
                              </div>";
            $hasAlertMessage = true;
          }
          else{
              $sql = "UPDATE item_type SET item_name='".$formdata["itemName"]."', item_unit ='".$formdata["itemUnit"]."' , shelf_life ='".$formdata["shelf_life"]."' WHERE type_id='".$formdata["itemID"]."'";
              if (mysqli_query($conn, $sql)) {
                //echo "<p style='color:green;'>change of info successful</p>";

              $alertMessage = "<div class='alert alert-success' role='alert'>
                              Change of Info Successful!
                            </div>";
              $hasAlertMessage = true;


                //log
                $userloggedin = $_SESSION["userID"];
                $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
                $sql3 = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Updated an existing item type', '".$dateandtime."')";
                if ($result = $conn->query($sql3)) {
               //     echo "<p style='color:green;'>change of info successful</p>"; 
                }
            } else {
                    //echo "<p style='color:red;'>Wrong Item Info. try again.</p>";

                    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);

                    $alertMessage = "<div class='alert alert-danger' role='alert'>
                                Wrong Item Info. Try again!
                              </div>";
                     $hasAlertMessage = true;
              }
          }//end of update
          
    }

      
    if(array_key_exists("txtnewIName", $_POST)) {
      
        $formdata["itemName"] = $_POST["txtnewIName"]; 
        $formdata["itemUnit"] = $_POST["newitemtype"];
        $formdata["shelf_life"]= $_POST["txtnewILife"];
        $formdata["safety_lvl"]= $_POST["txtnewSLevel"];

        $itemLife = $formdata["shelf_life"];
        $txtnewIName = $formdata["itemName"];
        $txtnewIUnit = $formdata["itemUnit"];

        //echo $formdata["safety_lvl"];
        if(empty($txtnewIName) || empty($txtnewIUnit) || empty($itemLife)){
          //echo "<p style='color:red;'>Missing Field. try again.</p>";
          $alertMessage = "<div class='alert alert-danger' role='alert'>
                                Missing Field. Try Again!
                              </div>";
            $hasAlertMessage = true;
        }
            //$sql = "INSERT INTO user_account (username, password, name, department, isActive, userLevel) VALUES ('". $formdata["user"] ."','". $pwd ."', '". $formdata["name"] ."', 'none', 1, 0)";
        else {
          $sql11 = "INSERT INTO item_type(item_name,item_unit,shelf_life) VALUES ('".$formdata["itemName"]." ','".$formdata["itemUnit"]."','".$formdata["shelf_life"]."')";
          $sql22 ="INSERT INTO com_onhand_inventory(item_name, item_unit,shelf_life,item_qty, safety_lvl) VALUES ('".$formdata["itemName"]." ','".$formdata["itemUnit"]."' ,'".$formdata["shelf_life"]."',0,'".$formdata["safety_lvl"]."')";
          $sql33 ="INSERT INTO b1_onhand_inventory(item_name, item_unit,shelf_life,item_qty , safety_lvl) VALUES ('".$formdata["itemName"]." ','".$formdata["itemUnit"]."' ,'".$formdata["shelf_life"]."',0,'".$formdata["safety_lvl"]."')";
          $sql44 ="INSERT INTO b2_onhand_inventory(item_name, item_unit,shelf_life,item_qty,safety_lvl) VALUES ('".$formdata["itemName"]." ','".$formdata["itemUnit"]."' ,'".$formdata["shelf_life"]."',0,'".$formdata["safety_lvl"]."')";
          $sql55 ="INSERT INTO b3_onhand_inventory(item_name, item_unit,shelf_life,item_qty,safety_lvl) VALUES ('".$formdata["itemName"]." ','".$formdata["itemUnit"]."' ,'".$formdata["shelf_life"]."',0,'".$formdata["safety_lvl"]."')";
          
          
          if (mysqli_query($conn, $sql11) && mysqli_query($conn, $sql22) && mysqli_query($conn,$sql33) && mysqli_query($conn,$sql44) && mysqli_query($conn,$sql55)) {
            //echo "<p style='color:green;'>Add of new info successful</p>";
            
            $alertMessage = "<div class='alert alert-success' role='alert'>
                                Add of new info Successful!
                              </div>";
            $hasAlertMessage = true;

                //log
            $userloggedin = $_SESSION["userID"];
            $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
            $sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'Inserted new Item Type', '".$dateandtime."')";
            if ($result = $conn->query($sql)) {
                 //     echo "<p style='color:green;'>change of info successful</p>"; 
            }
          }
           else {
                //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        } //end of insert

      }
      

      if(array_key_exists("txtDeleteItem", $_POST)) {

          $formdata["itemID"] = $_POST["txtDeleteItem"];
          $itemID = $formdata["itemID"];
      
        if(empty($itemID))
        {
          //echo "<p style='color:red;'>Invalid input, please try again</p>";
          $alertMessage = "<div class='alert alert-danger' role='alert'>
                                Invalid Input. Try Again!
                              </div>";
            $hasAlertMessage = true;
        }

        else{
              $sql ="DELETE FROM item_type WHERE type_id ='".$formdata["itemID"]."'";
              if (mysqli_query($conn, $sql)) {
                //echo "<p style='color:green;'>change of info successful</p>";

                $alertMessage = "<div class='alert alert-success' role='alert'>
                                Change of Info Successful!
                              </div>";
            $hasAlertMessage = true;

                //log
            $userloggedin = $_SESSION["userID"];
            $dateandtime = date("Y/m/d") . ' at ' . date("h:i:sa");
            $sql = "INSERT INTO activity_log (userID, action, time) VALUES (".$userloggedin.", 'changed item info', '".$dateandtime."')";
            if ($result = $conn->query($sql)) {
                 //     echo "<p style='color:green;'>change of info successful</p>"; 
            }
            } else {
                 // echo "<p style='color:red;'>Wrong Item Info. try again.</p>";

                  $alertMessage = "<div class='alert alert-danger' role='alert'>
                                Wrong Item Info. Try Again!
                              </div>";
                   $hasAlertMessage = true;
                //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
      }



?>