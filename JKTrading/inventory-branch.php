<?php 
          if($has_error){
            echo $error_message;
          } 
          if($has_success) {
            echo $success_message;
          }
        ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> View Delivery Inventory
              </div>
              <div class="card-body">
                  <?php 
                    $sid = 2;
                    $formdata["sessionID"] = $sbranchID;
                    
                    $sql = "SELECT a . * , b . * FROM restaurant_inventory AS a INNER JOIN item_type AS b ON a.type_id = b.type_id WHERE a.branch_id = ".$_SESSION['branch_id']." ORDER BY `a`.`ritem_id` ASC";
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    ?>
                          <table class="table table-hover">
                            <tr>
                              <td>Delivery ID</td>
                              <td>Item</td>
                              <td>Unit</td>
                              <td class="text-warning">Safety Level</td>
                              <td class="text-success">Ordered Stock</td>
                              <td>Date Received</td>
                              <td class="text-warning">Expected Expiry Date</td>
                            </tr>
                      <?php
                    
                          while($row = $result->fetch_assoc()) {
                          ?>
                        <form action="" method="post">
                          <tr>
                            <td><?php echo $row["ritem_id"] ?></td>
                            <td><?php echo $row["item_name"] ?></td>
                            <td><?php echo $row["item_unit"] ?></td>
                            <td><?php echo $row["ritem_ever"] ?></td>
                            <td><?php echo $row["ritem_stock"] ?></td>
                            <td><?php echo $row["dateReceived_item"] ?></td>
                            <td><?php echo $row["expectedExpiry_date"]?></td>
                          </tr>
                      </form>
                    <?php
                        }
                        echo "</table>";
                        }
                    ?>
              </div>
            </div>
          </div>
          
        </div>

        
        <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> View On Hand Inventory
              </div>
              <div class="card-body">
                  <h5>Branch On-Hand Inventory</h5>
                  <?php 
                    //SELECT b.item_name, b.item_unit, a.citem_ever, a.citem_stock, a.dateReceived_item, a.dateModified_item, a.expectedExpiry_date FROM commissary_inventory as a INNER JOIN item_type as b ON a.type_id = b.type_id
                    if($_SESSION['branch_id']==1)
                    {
                    $sql = "SELECT type_id,item_name,item_unit,shelf_life,item_qty,safety_lvl FROM b1_onhand_inventory;";
                    }
                    else if($_SESSION['branch_id']==2)
                    {
                    $sql = "SELECT type_id,item_name,item_unit,shelf_life,item_qty,safety_lvl FROM b2_onhand_inventory;";
                    }

                    if($_SESSION['branch_id']==3)
                    {
                    $sql = "SELECT type_id,item_name,item_unit,shelf_life,item_qty,safety_lvl FROM b3_onhand_inventory;";
                    }
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                  ?>
                        <table class="table table-hover">
                            
                          <tr> 
                            
                          <td align="center">Item Name</td> 
                          <td align="center">Unit</td>
                          <td align="center">Type ID </td> 
                          <td class="text-warning" align="center">Shelf Life</td>
                          <td class="text-success" align="center">CURRENT STOCK</td>
                          <td class="text-warning" align="center">Safety Level</td>
                          </tr>
                    <?php
                  
                        while($row = $result->fetch_assoc()) {
                        ?>
                          <form action="" method="post">
                            <tr>
                              <td align ="center"><?php echo $row["item_name"] ?></td>
                              <td align ="center"><?php echo $row["item_unit"] ?></td>
                              <td align ="center"><?php echo $row["type_id"] ?></td>
                              <td align ="center"><?php echo $row["shelf_life"] ?></td>
                              <td align ="center"><?php echo $row["item_qty"] ?></td> 
                              <td align ="center"><?php echo $row["safety_lvl"] ?></td> 
                              
                          </tr>
                        </form>
                    <?php
                      }
                        echo "</table>";
                      }
                     ?>
              </div>
            </div>
          </div>



        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-user-minus"></i> Consume Items
              </div>
              <div class="card-body">
                <div class="form-group">
                  <table class="table table-striped">
                    <thead>
                      <td>Item Name</td>
                      <td>Date Ordered</td>
                      <td>Quantity </td>
                      <td></td>
                    </thead>
                    <tbody>
                      <?php 
                        $itemCart = new ItemCart();
                        $itemCart->consumeProducts($sbranchID);           
                        foreach($itemCart->itemList as $iList){
                      ?>
                        <form method = "POST" action="" >
                        <tr>
                            <td><label><?php echo $iList["item_name"]," (", $iList["item_unit"],")";?></label></td>
                            <td><label><?php echo $iList["dateReceived_item"];?></label></td>
                            <input name ="ritem_id" type="hidden" value="<?php echo $iList["ritem_id"];?> ">
                            <input name ="ritem_stock" type="hidden" value="<?php echo $iList["ritem_stock"];?> ">
                            <input name ="type_id" type="hidden" value="<?php echo $iList["type_id"];?> ">

                            <td><input type="number" name="itemQty" value='0' min="0" step="1" oninput="validity.valid||(value='');"class="form-control"> </td>
                            <td><button type="submit" name="consume" class="btn btn-warning">Consume Product</button> </td>
                        </form>
                      <?php }?>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>

          <div class="row">
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-search"></i> Manage Expired Items
              </div>
              <div class="card-body">
                <h6>Expired Restaurant Items</h6>
                  <?php 

                    $sql="SELECT ritem_id,type_id,ritem_stock,expectedExpiry_date FROM restaurant_inventory WHERE expired_flag = 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                            
                    ?>
                      <table>
                          <tr>
                              <td>Item Order ID</td> 
                              <td>Item Type ID</td>
                              <td>Item Stock</td>           
                              <td>Item Expected Expiry Date </td>
                          </tr>
                      <?php
                    
                          while($row = $result->fetch_assoc()) {
                        
                          ?>
                            <form action="" method="post">
                              <tr>
                                  <td align ="center"><?php echo $row["ritem_id"] ?></td>
                                  <td align ="center"><?php echo $row["type_id"] ?></td>
                                  <td align ="center"><?php echo $row["ritem_stock"] ?></td>
                                  <td align ="center"><?php echo $row["expectedExpiry_date"] ?></td>
                              </tr>
                          </form>
                      <?php
                        }
                          echo "</table>";
                        }
                      ?>

                      <hr>

                      <form method="POST">
                        <h6>Remove all expired items</h6>
                        <input type="submit" value="remove" name ="removebranchItems" class="btn btn-danger">
                      </form>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-edit"></i> Return Damaged Items
              </div>
              <div class="card-body">
                  <form method="POST"> 
                    <div class="form-group">
                      <label>Select Damaged Item to be returned: </label>
                      <select name ="dmgItem" class="form-control">
                          <?php include 'common-db.php'; ?>
                            <option value="Select item ID" selected> Please select an item</option>
                              <?php if($branchid ==1)
                                while($row1 = mysqli_fetch_array($result3)):;?>
                                  <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?> </option>
                                    <?php endwhile;?>        
                                      <?php if($branchid ==2)
                                        while($row1 = mysqli_fetch_array($result4)):;?>
                                          <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?> </option>    
                                            <?php endwhile;?>
                                              <?php if($branchid ==3)
                                                  while($row1 = mysqli_fetch_array($result5)):;?>
                                                    <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?> </option>
                                                      <?php endwhile;?>
                        </select>
                        <br>
                      <label>Quantity: </label>
                      <input type="text" value="" name="txtqty" class="form-control">
                      <label>Comment: </label>
                      <input type="text" value="" name="txtcomment" class="form-control">
                      
                      <br>
                      <input type="submit" name ="submit" value="Return Damaged Items" class="btn btn-success form-control">
                    </div>
                </form>
              </div>
            </div>


          </div>

        </div>