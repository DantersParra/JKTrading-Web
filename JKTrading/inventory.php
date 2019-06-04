<?php
  include_once("common-db.php");
  session_start();

  $suserID = $_SESSION['userID'];
  $sname = $_SESSION['name'];
  $ulevel = $_SESSION['userLevel'];
  $sbranchID = $_SESSION['branch_id'];
  

  date_default_timezone_set('Asia/Manila');
		$timezone = date_default_timezone_get();
		$date = date('Y/m/d h:i:s', time());
	

  if (!isset($_SESSION['userID']))
  {
    header("Location: login.php");
  }


  

  if($ulevel == 0){
    //$sql3 = "Update restaurant_inventory as a ,item_type as b set expired_flag = 1 where DATEDIFF( CURRENT_DATE, dateReceived_item) >shelf_life and a.type_id=b.type_id";
    
    //$sql3= "UPDATE restaurant_inventory as a ,item_type as b set expired_flag = 1 where ((TIMESTAMPDIFF(SECOND,expectedExpiry_date,CURRENT_TIMESTAMP))) >0 and a.type_id=b.type_id";

    $sql3= "UPDATE restaurant_inventory as a ,item_type as b set expired_flag = 1 where ((TIMESTAMPDIFF(SECOND,expectedExpiry_date,'".$date."'))) >0 and a.type_id=b.type_id";
    
    $conn->query($sql3);
    include_once("inventory-consumeaction.php");
    include_once('order.php'); 
    include_once('inventory-expiredaction.php');
    include_once('inventory-dmgaction.php');
    include_once('inventory-remexpireditems.php');
  } else {
    date_default_timezone_set('Asia/Manila');
		$timezone = date_default_timezone_get();
		$date = date('Y/m/d h:i:s', time());
    //$sql2 = "Update commissary_inventory as a ,item_type as b set expired_flag = 1 where ((DATEDIFF( CURRENT_DATE, dateModified_item))) >shelf_life and a.type_id=b.type_id";
    
    //$sql2= "UPDATE commissary_inventory AS a, item_type AS b SET expired_flag =1 WHERE ( ( TIMESTAMPDIFF( SECOND , expectedExpiry_date, CURRENT_TIMESTAMP ) ) ) >0 AND a.type_id = b.type_id";
    $sql2= "UPDATE commissary_inventory AS a, item_type AS b SET expired_flag =1 WHERE ( ( TIMESTAMPDIFF( SECOND , expectedExpiry_date, '".$date."' ) ) ) >0 AND a.type_id = b.type_id";
    
    $conn->query($sql2);

    include_once("inventory-expiredaction.php");
    include_once("inventory-recycleaction.php");
    include_once("inventory-editsafety.php");
    include_once("inventory-edititem.php");
    include_once("inventory-managedmgitems.php");
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

        <!-- Page Content -->

        <?php 
          if($ulevel==1){
            include_once("inventory-ownercomm.php");
          }
          if($ulevel==2){
            include_once("inventory-ownercomm.php");
          }
          if($ulevel==0){
            include_once("inventory-branch.php");
          }


        ?>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->
<?php
      include_once("common-footer.php");
      ?>

</body>

</html>
<?php
                        
  $conn->close();