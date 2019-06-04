<?php
  include_once("common-db.php");
  session_start();

  $suserID = $_SESSION['userID'];
  $sname = $_SESSION['name'];
  $ulevel = $_SESSION['userLevel'];


  if (!isset($_SESSION['userID']))
  {
    header("Location: login.php");
  }

  if($_SESSION['isActive'] == 0)
  {
    header("Location:login.php");
  }
  

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

        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-user"></i><strong> Welcome <?php echo $sname ?>! </strong>
              </div>
              <div class="card-body">
                  <!-- asdasdasdasda  -->
              </div>
            </div>
        </div>
      </div>

        <div class="row">
          <div class="col-lg-7">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i> Reminders
              </div>
              <div class="card-body">
                  <!-- asdasdasdasda  -->
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-pie"></i> How To Use
              </div>
              <div class="card-body">
                  <!-- asdasdasdasda  -->
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
      <?php
      include_once("common-footer.php");
      ?>
      

</body>

</html>
<?php
                        
  $conn->close();