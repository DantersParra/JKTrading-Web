<?php 
  if($hasAlertMessage){
    echo $alertMessage;
  }
  if($has_error){
    echo $error_message;
  } 
  if($has_success) {
    echo $success_message;
  }
  include_once("debug-commands.php");
?>  
        <div class="row">
          
          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-pie"></i> Edit Account
              </div>
              <div class="card-body">
                    <form method="POST">
                      <div class="form-group">
                        <h5>Change User Information:</h5>
                        <label for="txtusername">Username</label>
                        <input type="text" value="<?php echo $user; ?>" name="txtusername" class="form-control" id="txtusername">
                        <label for="txtusername">Name</label>
                        <input type="text" value="<?php echo $name; ?>" name="txtname" class="form-control" id="txtname">
                        <label for="txtusername">Department</label>
                        <input type="text" value="<?php echo $dept; ?>" name="txtdepartment" class="form-control" id="txtdept">
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="save changes">
                      </div>
                    </form>
                    <br>
                    
                    <form method="POST">
                      <div class="form-group">
                        <h5>Change Password:</h5>
                        <label for="txtopw">Old Password</label>
                        <input type="password" value="" name="txtoldpass" class="form-control" id="txtopw">
                        <label for="txtnpw">New Password</label>
                        <input type="password" value="" name="txtnewpass" class="form-control" id="txtnpw">
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="change password">
                      </div>
                    </form>
              </div>
            </div>
          </div>
          
          <div class="col-lg-7">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> Manage Accounts
              </div>
              <div class="card-body">
                  <?php 

                    //$sql = "SELECT userID, name, department,branch_id, isActive FROM user_account";

                    $sql = "SELECT a.userID, a.name, a.department, b.branch_name, a.isActive FROM user_account as a INNER JOIN resto_branch as b ON a.branch_id = b.branch_id ORDER BY a.userID";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                  ?>
                    <table class="table table-hover">
                        
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Department</td>
                            <td>Branch</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    <?php
                      while($row = $result->fetch_assoc()) {
              
                      // output data of each row

                      $activeValue = $row["isActive"];
                      if($activeValue==0){
                        $activeStatus = 'deactivated';
                      } else if ($activeValue==1){
                        $activeStatus = 'activated';
                      }
                    ?>
                      <form action="" method="post">
                          <input type="hidden" name="accountID" value="<?php echo $row["userID"] ?>">
                          <input type="hidden" name="accountStatus" value="<?php echo $activeValue ?>">
                            <tr>
                              <td><?php echo $row["userID"] ?></td>
                              <td><?php echo $row["name"] ?></td>
                              <td><?php echo $row["department"] ?></td>
                              <td><?php echo $row["branch_name"] ?></td>
                              <td><?php echo $activeStatus ?></td>
                              <td>
                                  <input type="submit" name="accountAction" value="<?php echo $activeValue ? 'Deactivate':'Activate' ?>">
                              </td>
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
            <div class="col-lg-7">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i> View Item Types
                </div>
                <div class="card-body">
                    <?php 

                      $sql = "SELECT `type_id` ,`item_name` ,`item_unit` ,`shelf_life`  FROM `item_type`";
                      
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                    ?>
                      <table class="table">
                          
                        <tr>
                          <td align ="center">Item ID</td>
                          <td align ="center">Item Name</td>
                          <td align ="center">Item Unit</td>
                          <td align ="center">Shelf life</td>
                      
                        </tr>
                    <?php
                          while($row = $result->fetch_assoc()) {
                    ?>
                      <form action="" method="post">
                        <tr>
                            <td align ="center"><?php echo $row["type_id"] ?></td>
                            <td align ="center"><?php echo $row["item_name"] ?></td>
                            <td align ="center"><?php echo $row["item_unit"] ?></td>
                            <td align ="center"><?php echo $row["shelf_life"] ?></td>
                        </tr>
                      </form>
                    <?php
                      }
                      echo "</table>";

                        //$conn->close();
                      }
                   ?>

                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i> Manage Item Types
                </div>
                <div class="card-body">
                      <form method="POST"> 
                        <div class="form-group">
                          <h5>Add new item</h5>
                          <label for="nin">New Item Name</label>
                          <input type="text" value="" name="txtnewIName" class="form-control" id="nin">

                          <label>New Item Unit:</label> 
                            <select name="newitemtype" class="form-control">
                              <option value="Bottle">Bottle</option>
                              <option value="kg">kg</option>
                              <option value="Liter">Liter</option>  
                              <option value="Sack">Sack</option>
                              <option value="Pack">Pack</option>
                              <option value="Gallon">Gallon</option>
                              <option value="Carton">Carton</option>
                              <option value="BigCan">Big Can</option>
                              <option value="CanWithBox">Can (With Box)</option>
                              <option value="Box">Box</option>
                              <option value="Tray">Tray</option>
                              <option value="OneLBottle">1L Bottle</option>
                              <option value="3.2kg">3.2 Kg</option>
                              <option value="28.5x30_Pack">28.5x30 Pack</option>
                              <option value="Loaf">Wheat Loaf</option>
                              <option value="kgpack">1 Kg Pack</option>
                              <option value="Jar">Jar</option>
                              <option value="Piece">Piece</option>
                            </select>

                          <label>New Item Shelf Life(days):</label> <input type="text" value="" name="txtnewILife" class="form-control"> <br>
                          
                          <label>Item Safety Level</label>
                          <input type="text" value="" name="txtnewSLevel" class="form-control">
                          <br>

                          <input type="submit" value="Add new item info" class="btn btn-primary form-control">
                        </div>
                      </form>
                      <hr>
                      <form method="POST"> 
                        <div class="form-group">
                        <h5>Edit existing item</h5>
                          <label>Select Item to be Edited:</label>
                          <select name ="txtIId" class="form-control">
                              <option value "Select item ID" selected> Please select an item </option>
                              <?php include 'common-db.php'; ?>
                              <?php while($row1 = mysqli_fetch_array($result1)):;?>
                              <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?> </option>
                              <?php endwhile;?>
                          </select>
                          <label>New Item Type:</label><input type="text" value="" name="txtIName" class="form-control">
                          <label>New Item Unit:</label> 
                          <select name="updateditemtype" class="form-control">
                          <option value="Bottle">Bottle</option>
                              <option value="kg">kg</option>
                              <option value="Liter">Liter</option>  
                              <option value="Sack">Sack</option>
                              <option value="Pack">Pack</option>
                              <option value="Gallon">Gallon</option>
                              <option value="Carton">Carton</option>
                              <option value="BigCan">Big Can</option>
                              <option value="CanWithBox">Can (With Box)</option>
                              <option value="Box">Box</option>
                              <option value="Tray">Tray</option>
                              <option value="OneLBottle">1L Bottle</option>
                              <option value="3.2kg">3.2 Kg</option>
                              <option value="28.5x30_Pack">28.5x30 Pack</option>
                              <option value="Loaf">Wheat Loaf</option>
                              <option value="kgpack">1 Kg Pack</option>
                              <option value="Jar">Jar</option>
                              <option value="Piece">Piece</option>
                            
                          </select>
                          <label>New Item Shelf Life(days):</label> <input type="text" value="" name="txtILife" class="form-control"> <br> 
                          <input type="submit" value="Update item info" class="btn btn-primary form-control"><br>
                          <h5> Empty Inventory On-Hand & Item Types(For showcase / testing purpose only) </h5>

                          <input type="submit" value="Remove" name ="emptyInv" class="btn btn-warning"> 

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
                <i class="fas fa-user-plus"></i> Add New Account
              </div>
              <div class="card-body">
                    <form method="POST">
                      <div class="form-group">
                        <h5>New User Information:</h5>
                        <label for="txtusername">Username</label>
                        <input type="text" name="username" class="form-control">
                        <label for="txtpword">Password</label>
                        <input type="password" name="password" class = "form-control">
                        <label for="txtusername">Fullname</label>
                        <input type="text" name="fullname" class = "form-control">
                        <label for="txtbranch">Branch</label>
                        <select name="chosenbranch" class = "form-control">
                        <option value="1">Seolhwa</option>
                        <option value="2">Pork Heroes</option>
                        <option value="3">The Cook</option>
                        <option value="4">Commissary</option>
                        </select>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Add new Manager">
                      </div>
                    </form>
                    <br>
                    
              </div>
            </div>
          </div>
          
          </div>

        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> View Activity Log
              </div>
              <div class="card-body">
                  <h5>Recent Activity</h5>
                  
                  <?php 

                    $sql = "SELECT * FROM `activity_log` ORDER BY activity_id DESC LIMIT 10";
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                  ?>
                    <table class="table">
                      
                      <tr>
                        <td>Activity ID</td> 
                        <td>User ID</td> 
                        <td>Action</td>
                        <td>Time </td>
                      </tr>
                  <?php
                
                    while($row = $result->fetch_assoc()) {
                    
                  ?>
                    <form action="" method="post">
                      <tr>
                        <td align ="center"><?php echo $row["activity_id"] ?></td>
                        <td align ="center"><?php echo $row["userID"] ?></td>
                        <td align ="center"><?php echo $row["action"] ?></td>
                        <td align ="center"><?php echo $row["time"] ?></td>
                      </tr>
                   </form>
                  <?php
                        }
                        echo "</table>";

                  }

                 ?>
                 <a href="activity_log.php" target="_blank">View All Activity</a>

              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-cogs"></i> FOR TESTING / SHOWCASE PURPOSE ONLY 
              </div>
              <div class="card-body">
                <h6> Empty Inventory On-Hand </h6>

                    <input type="submit" value="Remove" name ="emptyInv" class="btn btn-warning">
                  </form>

              </div>
            </div>
          </div>
        </div>