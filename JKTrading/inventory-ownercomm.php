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
                  <h5>Commissary Delivery Inventory</h5>
                  <?php 
                    //SELECT b.item_name, b.item_unit, a.citem_ever, a.citem_stock, a.dateReceived_item, a.dateModified_item, a.expectedExpiry_date FROM commissary_inventory as a INNER JOIN item_type as b ON a.type_id = b.type_id
                    $sql = "SELECT b.item_name, b.item_unit, a.citem_id, a.citem_stock, a.dateReceived_item,  a.expectedExpiry_date FROM commissary_inventory as a INNER JOIN item_type as b ON a.type_id = b.type_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                  ?>
                        <table class="table table-hover">
                            
                          <tr>
                          <td align ="center">Delivery ID</td> 
                          <td align ="center">Item Name</td> 
                          <td align ="center">Unit</td> 
                          <td align ="center">Ordered Quantity</td>
                          <td align ="center">Received Date </td>
                          <td align ="center">Expected Expiry Date</td>
                          </tr>
                    <?php
                  
                        while($row = $result->fetch_assoc()) {
                        ?>
                          <form action="" method="post">
                            <tr>
                              <td align ="center"><?php echo $row["citem_id"] ?></td>
                              <td align ="center"><?php echo $row["item_name"] ?></td>
                              <td align ="center"><?php echo $row["item_unit"] ?></td>
                              <td align ="center"><?php echo $row["citem_stock"] ?></td>
                              <td align ="center"><?php echo $row["dateReceived_item"] ?></td> 
                              
                              <td align ="center"><?php echo $row["expectedExpiry_date"] ?></td>
                        
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


          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> View On Hand Inventory
              </div>
              <div class="card-body">
                  <h5>Commissary On-Hand Inventory</h5>
                  <?php 
                    //SELECT b.item_name, b.item_unit, a.citem_ever, a.citem_stock, a.dateReceived_item, a.dateModified_item, a.expectedExpiry_date FROM commissary_inventory as a INNER JOIN item_type as b ON a.type_id = b.type_id
                    $sql = "SELECT b.item_name, b.item_unit, a.type_id,a.shelf_life, a.item_qty,a.safety_lvl FROM com_onhand_inventory as a INNER JOIN item_type as b ON a.type_id = b.type_id;";
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



        </div>

        <div class="row">
          
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-cogs"></i> Manage Expired Items
              </div>
              <div class="card-body">
                <h6> Expired Items </h6>
                <?php 

                    //$sql = "SELECT a.*,b.* from commissary_inventory as a, item_type as b where ((DATEDIFF( CURRENT_DATE,a.dateModified_item)) ) > b.shelf_life and a.type_id=b.type_id";
                    $sql="SELECT citem_id,type_id,citem_stock,expectedExpiry_date FROM commissary_inventory WHERE expired_flag = 1";

                    //$sql = "SELECT a.citem_id,b.type_id,a.citem_stock, a.expectedExpiry_date from commissary_inventory as a,item_type as b  where expired_flag =1";
                    $result = $conn->query($sql);
                    //$sql2 = "Update commissary_inventory as a ,item_type as b set expired_flag = 1 where ((DATEDIFF( CURRENT_DATE, dateModified_item))) >shelf_life and a.type_id=b.type_id";
                    //$conn->query($sql2);

                  if ($result->num_rows > 0) {
                ?>
                  <table class="table table-striped">
                      
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
                              <td align ="center"><?php echo $row["citem_id"] ?></td>
                              <td align ="center"><?php echo $row["type_id"] ?></td>
                              <td align ="center"><?php echo $row["citem_stock"] ?></td>
                              <td align ="center"><?php echo $row["expectedExpiry_date"] ?></td>
                          </tr>
                      </form>
                  <?php
                    }
                    echo "</table>";
                    }
                  ?>

                  <form method="POST">
                    <h6>Move all expired to recycle bin</h6>
                    <input type="submit" value="Move" name ="moveItems" class="btn btn-warning">
                  </form>

              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-dumpster"></i> Inventory Recycle Bin
              </div>
              <div class="card-body">
                <h6>Recycle Bin</h6>
                <?php 
                  $sql = "SELECT a.*, b.* FROM commissary_recbin as a INNER JOIN item_type as b ON a.type_id = b.type_id";
                  $result = $conn->query($sql);
                  $sql2 = "Update commissary_inventory as a ,item_type as b set expired_flag = 1 where ((DATEDIFF( CURRENT_DATE, dateModified_item))) >shelf_life and a.type_id=b.type_id";
                  $conn->query($sql2);

                  if ($result->num_rows > 0) {

                ?>
                  <table class="table table-striped">
                      
                  <tr>
                    <td>Item</td> 
                    <td>Unit</td>
                    <td>Stock</td>
                    <td>Item Expiry Date </td>  
                  </tr>
                  <?php
                  
                    while($row = $result->fetch_assoc()) {
                  ?>
                      <form action="" method="post">
                        <tr>
                          <td align ="center"><?php echo $row["item_name"] ?></td>
                          <td align ="center"><?php echo $row["item_unit"] ?></td>
                          <td align ="center"><?php echo $row["citem_stock"] ?></td>
                          <td align ="center"><?php echo $row["expectedExpiry_date"] ?></td>
                        </tr>
                      </form>
                    <?php
                        }
                        echo "</table>";

                  }
                    ?>

                    <form method="POST">
                      <h6>Permanently remove all items</h6>
                      <input type="submit" value="Delete" name ="removeItems" class="btn btn-danger" >
                    </form>

              </div>
            </div>
          </div>

        </div>



        <div class="row">
          <div class="col-lg-7">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-hard-hat"></i> View Items Below Safety Level
              </div>
              <div class="card-body">
                  <?php 

                  $sql = "SELECT item_name, item_unit, item_qty,safety_lvl FROM com_onhand_inventory WHERE item_qty<safety_lvl";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                  ?>
                    <table class="table table-striped">
                            
                      <tr>
                        <td>Item Name</td> 
                        <td>Item Unit</td>
                        <td>Item Stock</td>
                        <td>Safety Level</td>
                      </tr>
                    <?php
                  
                      while($row = $result->fetch_assoc()) {
                    ?>
                          <form action="" method="post">
                            <tr>
                              <td align ="center"><?php echo $row["item_name"] ?></td>
                              <td align ="center"><?php echo $row["item_unit"] ?></td>
                              <td align ="center"><?php echo $row["item_qty"] ?></td>
                              <td align ="center"><?php echo $row["safety_lvl"]?></td>
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
          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-edit"></i> Edit Safety Levels
              </div>
              <div class="card-body">
                  <form method="POST"> 
                    <div class="form-group">
                      <label>Select Item to be edited:</label>
                      <select name ="chosenID" class="form-control">
                        <option value "Select item ID" selected> Select an item </option>
                        <?php include 'common-db.php'; ?>
                        <?php while($row1 = mysqli_fetch_array($result1)):; ?>
                        <option value="<?php echo $row1[0];?>"><?php echo $row1[1]; ?> </option>
                       <?php endwhile; ?>
                      </select>

                      <label>Item Safety Level</label>
                      <input type="text" value="" name="txtnewSafetyLevel" class="form-control">
                      <br>
                      <input type="submit" name ="submit" value="Update Item Safety Level" class="btn btn-success form-control">
                    </div>
                </form>
              </div>
            </div>
          </div>

          
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-edit"></i> Edit Inventory Items
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <form method="POST">
                      <div class="form-group">
                        <h5>Add new item:</h5>
                        <label>New Item Type:</label>
                        <select name ="newItem" class="form-control">
                          <option value "Select item ID" selected> Select an item</option>
                          <?php include 'common-db.php'; ?>
                          <?php while($row1 = mysqli_fetch_array($result1)):;?>
                          <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?> </option>
                          <?php endwhile;?>
                        </select>
                      <!--
                        <label>Item Safety Level:</label>
                        <input type = "text" value="" name = "txtnewSafety" class="form-control">
                    --> <label>Item Stock:</label>
                         <input type="text" value="" name="txtnewStock" class="form-control">
                             <br>
                        <input type="submit" value="Insert New Item Info" class="btn btn-primary form-control">
                      </div>
                    </form>

                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          
        </div>

        <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-dumpster"></i> Returned damaged items
              </div>
              <div class="card-body">
                <h6>Damaged Items</h6>
                <?php 
                $sql = "SELECT branch_id, ritem_id, type_id, ritem_stock, remarks FROM commissary_dmgrecbin";
                $result = $conn->query($sql);
                  if ($result->num_rows > 0) {

                ?>
                  <table class="table table-striped">
                      
                  <tr>
                  <td>Branch ID &nbsp;&nbsp;</td> 
                  <td>Restaurant Item ID &nbsp;&nbsp;</td> 
                  <td>Type ID&nbsp;&nbsp;</td>
                  <td>Restaurant Stock&nbsp; &nbsp;</td>
                        <td align="center">Comment </td>
                  </tr>
                  <?php
                  
                    while($row = $result->fetch_assoc()) {
                  ?>
                      <form action="" method="post">
                        <tr>
                        <td align ="center"><?php echo $row["branch_id"] ?></td>
                        <td align ="center"><?php echo $row["ritem_id"] ?></td>
                        <td align ="center"><?php echo $row["type_id"] ?></td>
                        <td align ="center"><?php echo $row["ritem_stock"] ?></td>
                        <td align ="center"><?php echo $row["remarks"] ?></td>
                        </tr>
                      </form>
                    <?php
                        }
                        echo "</table>";

                  }
                    ?>

                    <form method="POST">
                      <h6>Permanently remove all damaged items</h6>
                      <input type="submit" value="Delete" name ="removedmgItems" class="btn btn-danger" >
                    </form>

              </div>
            </div>
          </div>
        </div>