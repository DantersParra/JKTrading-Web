<div class="row">
            <div class="col-lg-7">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-feather-alt"></i> Make Order
                </div>
                <div class="card-body">
                    <div id="cartContainer">
                    <table id="itemTable">
                      <tr id="itemRow" name="itemRow">
                        <td>Item : <select id="itemName" onchange="setItemType(this)" name="itemName[]" class="form-control">
                        
                        <?php 
                        $itemCart = new ItemCart();
                        $itemCart->getProducts();    
                            
                        foreach($itemCart->itemList as $iList){?>

                            <option value="<?php echo $iList["type_id"];?>">

                            <?php 
                              echo $iList["item_name"]; 
                            ?>

                            </option>
                            
                            <?php  
                              } 
                            ?>
                        
                        </select></td>
                        <input type="hidden" id="typeId" name ="typeId[]" value="1">
                        <td>Quantity: <input type="number" name="itemQty[]" min="0" step="1" oninput="validity.valid||(value='');" class="form-control"> </td>
                      </tr>

                  
                    </table>
                    
                    <br>
                  <button onclick="showSummaryOfOrder()" class="btn btn-success">Finalize Order</button>
                  <button onclick="addNewItem()" class="btn btn-info ">Add Item</button>
                  </div>

                  <div id="orderSummary" style="display: none;">
                    <form method = "POST" action="submit_order.php" >
                    <h5>Order Summary</h5>
                    <table id="tableOrderSummary" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Item Name</th>
                          <th>Item Quantity</th>
                        </tr>
                      </thead>
                      <tbody></tbody>


                    </table>

                    <button type="submit" class="btn btn-success">Checkout Order</button>  
                    <button onclick="showCartContainer()" type="button" class="btn btn-danger">Cancel</button>   
                        </form>
                      
                    </div>
               </div>
              </div>
            
            </div>
            <div class="col-lg-5">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-truck-loading"></i> Confirm Order Delivery
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                      <th> Request ID</th>
                      <th> Request Status</th>
                      <th> Action</th>
                        <?php 
                        $requests = new OrderRequests();
                        $requests->getAllOrders();            
                        foreach($requests->orderList as $oList){?>
                          <form method = "POST" action=""> 
                      <tr>
                        <td><input type="hidden" id="reqId" name="reqId" value="<?php echo $oList["request_id"];?>"><?php echo $oList["request_id"];?></td>
                        <td><input type="hidden" id="reqStatus" name ="reqStatus" value="<?php echo $oList["request_status"];?> "><?php echo $oList["request_status"];?></td>
                        <td><input type="submit" onclick="showId()" class="button btn btn-primary" value="Confirm Delivery"></td>
                        
                      </tr>
                      </form>
                        <?php }?>
                      
                    </table>
               </div>
              </div>
            
            </div>

          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-search"></i> Restaurant Order History
                </div>
                <div class="card-body">
                  <?php 

                      $sql = "SELECT a.*, b.* FROM order_request as a INNER JOIN resto_branch as b ON a.request_orderedby=b.branch_id WHERE a.request_orderedby = '1' ORDER BY request_id DESC ";
                      
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {

                    ?>
                      <table class="table">
                        
                        <tr>
                          <td>Request ID</td> 
                          <td>Branch</td> 
                          <td>Branch Address</td>
                          <td>Status</td>
                          <td>Date Ordered</td>
                          <td>Actions</td>
                        </tr>
                    <?php
                  
                      while($row = $result->fetch_assoc()) {
                      
                    ?>
                      <form action="" method="post">
                        <tr>
                          <td align ="center"><?php echo $row["request_id"] ?></td>
                          <td align ="center"><?php echo $row["branch_name"] ?></td>
                          <td align ="center"><?php echo $row["branch_address"] ?></td>
                          <td align ="center"><?php echo $row["request_status"] ?></td>
                          <td align ="center"><?php echo $row["dateOrdered"] ?></td>
                          <td><button type="button" onclick="showRequest(<?php echo $row["request_id"] ?>)"  data-toggle="modal" data-target="#OrderModal"  name="" class="btn btn-info">View</button></td>
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