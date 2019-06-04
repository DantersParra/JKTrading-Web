<?php
  include_once("common-db.php");
  session_start();

  $success_message = '';
  $error_message = '';
  $has_error=false;
  $has_success=false;

  $suserID = $_SESSION['userID'];
  $sname = $_SESSION['name'];
  $ulevel = $_SESSION['userLevel'];


  if (!isset($_SESSION['userID']))
  {
    header("Location: login.php");
  }

  //

  if(array_key_exists("accountAction", $_POST)) {

    //var_dump($_POST);
    $newStatus = $_POST['accountStatus'];
    $newStatus = !$newStatus;

    $sql = "UPDATE user_account SET isActive = '". $newStatus ." ' WHERE userID = ". $_POST['accountID'] ." ";
    $result = $conn->query($sql);

  }

  include_once("manage-update.php");
  include_once("manage-itemtype.php");
  include_once("manage-addcommiss.php");
  include_once("manage-addmanager.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>

<?php
  include_once("common-head.php");
  ?>
</head>

<body id="page-top">

<?php
  include_once("common-nav.php");
  ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include_once("common-sidenav.php");
      ?>

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Page Content -->

        

        <?php


          if($ulevel==1){
            include_once("manage-commissary.php");
          
          }
          if($ulevel==2){
            include_once("manage-owner.php");
            include_once("debug-commands.php");
          }
          if($ulevel==0){
            include_once("manage-branch.php");

            // echo "<hr>
            //       <div style='font-size:50px; text-align:center;'><i class='fas fa-ban'></i></div>
            //       <p class='text-center font-weight-bold'>You have no use for manage</p>
            //       <p class='text-center font-weight-light'>Please contact main office for inquiries.</p>
            //       <hr>";
          }
          


        ?>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php
      include_once("common-footer.php");
      ?>

</body>

</html>
<?php
                        
  $conn->close();
