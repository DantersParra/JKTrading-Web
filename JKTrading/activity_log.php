<?php
	include_once("common-db.php");
	session_start();

	$suserID = $_SESSION['userID'];
	$sname = $_SESSION['name'];
	$ulevel = $_SESSION['userLevel'];

	if(array_key_exists("accountAction", $_POST)) {

		//var_dump($_POST);
		$newStatus = $_POST['accountStatus'];
		$newStatus = !$newStatus;

		$sql = "UPDATE user_account SET isActive = '". $newStatus ." ' WHERE userID = ". $_POST['accountID'] ." ";
		$result = $conn->query($sql);

	}
	
	if (!isset($_SESSION['userID']))
	{
    header("Location: login.php");
	}
    
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

	        $sql = "SELECT * FROM `activity_log`";
	        
	        $result = $conn->query($sql);

	        if ($result->num_rows > 0) {

	      ?>
	        <table class="table" id="activity_log_table">
	          
	          <thead>
	          <tr>

	            <td>Activity ID</td> 
	            <td>User ID</td> 
	            <td>Action</td>
	        <td>Time </td>
	          </tr>
	      </thead>
	      <tbody>
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
	            

	        $conn->close();
	      }

	     ?>
	     </tbody>
	     <tfoot>
            <tr>
                <th>Activity ID</th>
                <th>UserID</th>
                <th>Action</th>
                <th>Time</th>
            </tr>
        </tfoot>
	 </table>

      </div>
</div>

<?php
      include_once("common-footer.php");
      ?>

<script type="text/javascript">


	$('#activity_log_table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

     var table = $('#activity_log_table').DataTable();

    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	

</script>
</body>
</html>