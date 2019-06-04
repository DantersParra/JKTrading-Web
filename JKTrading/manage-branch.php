 <?php 
          if($has_error){
            echo $error_message;
          } 
          if($has_success) {
            echo $success_message;
          }
        ?>

 <div class="row">
  <div class="col">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-pie"></i> Edit Account
      </div>
      
      <div class="card-body col-lg-5">
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
</div>