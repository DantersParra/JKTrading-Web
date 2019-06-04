<?php
  include_once("common-db.php");
  session_start();
  if (isset($_SESSION['userID']))
  {
    header("Location: index.php");
  }


  include_once("login_action.php");

  /*if(array_key_exists("resetonline", $_GET)){
      $onlineflag = "UPDATE user_account SET isOnline = 0";
      $result = $conn->query($onlineflag);

      die();
  }*/

  
  if ($loginactiondone) {
    if($accountActive==1 ){

            if($isOnline == 0){
            //echo "<p style='color:green;'>login success</p>";
            
               // $onlineflag = "UPDATE user_account SET isOnline = 1 WHERE userID = ". $userloggedin ." ";
                //$result = $conn->query($onlineflag);

                if($level==0){
                  //redirect
                  header('Location: index.php');
                  die();
                }
                if($level==1){
                   //redirect
                  header('Location: index.php');
                  die();
                }
                if($level==2){
                  //redirect
                  header('Location: index.php');
                  
                }
            }else{
                $has_error = true;
                $error_message = "Account already logged in";
            }

      } else {
        $has_error = true;
        $error_message = "Your account is not active. Please contact main office.";
    
      }
  }
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include_once("common-head.php");
  ?>
</head>

<body class="bg-dark">

  <div class="container">
    <br><br>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">
        <img src="icon.png" class="" style="width: 200px;">
      </div>
      <div class="card-body">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div class="form-group">
            <div class="form-label-group">
              <input name="username" type="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputEmail">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <?php if($has_error){ ?>
          <p style='color:red;'><?php echo $error_message ?></p>
          <?php } ?>
          <input type="submit" class="btn btn-primary btn-block" value="Login">
        </form>
        <div class="text-center">
          
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
