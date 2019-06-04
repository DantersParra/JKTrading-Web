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
  
  include_once("orders-requestaction.php");
    
?>    
<!doctype html>
<html lang="en">
<head>
	<?php
  include_once("common-head.php");
  ?>
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">J&K Trading</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i> <?php echo $sname ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>

</nav>

<div id="wrapper">

    <div id="content-wrapper">

      <div class="container-fluid">

      	<h5>All Activity</h5>
	      <?php 

            $sql = "SELECT a.*, b.* FROM order_request as a INNER JOIN resto_branch as b ON a.request_orderedby=b.branch_id ORDER BY request_id LIMIT 10";
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

          ?>
            <table id="all_request_table" class="table">
              <thead>
              <tr>
                <th>Request ID</th> 
                <th>Branch</th> 
                <th>Branch Address</th>
                <th>Status</th>
                <th>Date Ordered</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
          <?php
        
            while($row = $result->fetch_assoc()) {
            
          ?>
          
           
              <tr >
                <td align ="center"><?php echo $row["request_id"] ?></td>
                <td align ="center"><?php echo $row["branch_name"] ?></td>
                <td align ="center"><?php echo $row["branch_address"] ?></td>
                <td align ="center"><?php echo $row["request_status"] ?></td>
                <td align ="center"><?php echo $row["dateOrdered"] ?></td>
                <td><button type="button" onclick="showRequestAll(<?php echo $row["request_id"] ?>)" data-toggle="modal" data-target="#AllOrderModal" name="" class="btn btn-info">View</button></td>
              </tr>

              
           
           
          <?php
                }
                echo "</tbody>";
                echo "</table>";

          }

         ?>

      </div>
</div>

<?php
      include_once("common-footer.php");
      ?>


  <div id="AllOrderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Request Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="orderAllDetails_wrapper">
          <table id="requestAllDetailsTable" class="table table-bordered">
            <thead>
              <tr>
                <th>Request ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody></tbody>

          </table>
         
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#all_request_table').DataTable();
} );

   function showRequestAll(id){
    $("#requestAllDetailsTable tbody").html('');
    var table=document.getElementById("requestAllDetailsTable").getElementsByTagName('tbody')[0];
     $.ajax({
                type: 'GET',
                url: 'functionGetOrderData.php',
                data: {id: id},
                dataType: 'json',
                success: function(data) {
                  var dataArr=data;


                  for (var i = 0; i < dataArr.length; i++) {
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML=JSON.parse(dataArr[i])['request_id'];
            cell2.innerHTML=JSON.parse(dataArr[i])['item_name'];
            cell3.innerHTML=JSON.parse(dataArr[i])['order_quantity'];
                  }

                }
            });
  

  }


</script>
</body>
</html>