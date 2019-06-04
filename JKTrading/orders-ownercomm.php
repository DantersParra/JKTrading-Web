  <?php
  if($has_error)
    {
      echo $error_message;
    } 
  if($has_success) 
  {
    echo $success_message;
  }
          ?>
<div class="row">
          <div class="col-lg-7">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-truck-loading"></i> Process Orders
              </div>
              <div class="card-body">
                <h5>New Orders</h5>

                  <?php 

                    $sql = "SELECT * FROM order_request JOIN resto_branch ON order_request.request_orderedby=resto_branch.branch_id where request_status='Received'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    ?>
                          <table class="table table-hover">
                            <tr>
                              <td>ID</td> 
                              <td>Branch</td> 
                              <td>Status</td> 
                              <td>Date Ordered</td>
                              <td>Actions</td>
                
                            </tr>
                      <?php

                      while($row = $result->fetch_assoc()) {
                      ?>
                          <form action="" method="post">
                            <tr>
                                <td><?php echo $row["request_id"] ?></td>
                                <td><?php echo $row["branch_name"] ?></td>
                                <td class="text-success"><?php echo $row["request_status"] ?></td>
                                <td><?php echo $row["dateOrdered"] ?></td>
                          
                                <input type="hidden" name="request_id" value="<?php echo $row['request_id'] ?>">
                                
                                <td><input type="submit" name="requestAction" class="btn btn-primary" value="Accept"></td>
                                <td><button type="button" onclick="showRequest(<?php echo $row["request_id"] ?>)"  data-toggle="modal" data-target="#OrderModal"  name="viewRequest" class="btn btn-info">View</button></td>
                            </tr>
                          </form>
                      <?php 
                          }
                        }
                      ?>
                  </table>

                  </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-truck"></i> Deliver Orders
              </div>
              <div class="card-body">
                <h5>Processed Orders</h5>
                <?php 

                  $sql = "SELECT a.*, b.* FROM order_request as a INNER JOIN resto_branch as b ON a.request_orderedby=b.branch_id where request_status='Processing'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                ?>
                      <table class="table table-hover">
                            <tr>
                                <td>ID</td> 
                                <td>Branch</td> 
                                <td>Status</td> 
                                <td>Date Ordered</td>
                                <td>Actions</td>

                
                            </tr>
                    <?php
                  
                        while($row = $result->fetch_assoc()) {

                        // output data of each row
                      
                      
                        ?>
                          <form action="" method="post">
                            <tr>
                                <td><?php echo $row["request_id"] ?></td>
                                <td><?php echo $row["branch_name"] ?></td>
                                <td class="text-warning"><?php echo $row["request_status"] ?></td>
                                <td><?php echo $row["dateOrdered"] ?></td>
                                
                                <input type="hidden" name="request_id" value="<?php echo $row["request_id"] ?>">
                                    
                                <td><input type="submit" name="requestActions" class="btn btn-primary" value="Deliver"></td>

                           
                                
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
          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-search"></i> Order History
              </div>
              <div class="card-body">
                <h5>Recent Orders</h5>
                  
                  <?php 

                    $sql = "SELECT a.*, b.* FROM order_request as a INNER JOIN resto_branch as b ON a.request_orderedby=b.branch_id ORDER BY request_id";
                    
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
                        <td><button type="button"  onclick="showRequest(<?php echo $row["request_id"] ?>)"  data-toggle="modal" data-target="#OrderModal" name="" class="btn btn-info">View</button></td>
                      </tr>
                   </form>
                  <?php
                        }
                        echo "</table>";

                  }

                 ?>
                 <a href="orderhistory.php" target="_blank">View ALL Order History</a>

                 

              </div>
            </div>
          </div>
          
        </div>

        
