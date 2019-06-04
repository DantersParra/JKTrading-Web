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
  
  include_once('order.php'); 
  include_once('requests.php');
  include_once("orders-requestaction.php");
  include_once("orders-confirmaction.php");
  
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
            include_once("orders-ownercomm.php");
          }
          if($ulevel==2){
            include_once("orders-ownercomm.php");
          }
          if($ulevel==0){
            include_once("orders-branch.php");
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



      <div id="OrderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Request Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="orderDetails_wrapper">
          <table id="requestDetailsTable" class="table table-bordered">
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

      


</body>




<script type="text/javascript">
  

   function showRequest(id){
    $("#requestDetailsTable tbody").html('');
    var table=document.getElementById("requestDetailsTable").getElementsByTagName('tbody')[0];
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



  //===========================================================================
  function showCartContainer(){
    document.getElementById("cartContainer").style.display='block';
    document.getElementById("orderSummary").style.display='none';

  }

  function showSummaryOfOrder(){
    document.getElementById("cartContainer").style.display='none';
    document.getElementById("orderSummary").style.display='block';
    $("#tableOrderSummary tbody").html('');

    var table=document.getElementById("tableOrderSummary").getElementsByTagName('tbody')[0];

    for(var i=0; i<document.getElementsByName('itemName[]').length; i++){

      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);


      cell1.innerHTML=document.getElementsByName('itemName[]')[i][document.getElementsByName('itemName[]')[i].selectedIndex].label + ' <input type="hidden" id="typeId" name ="typeId[]" value="'+document.getElementsByName('itemName[]')[i][document.getElementsByName('itemName[]')[i].selectedIndex].value+'">';

      cell2.innerHTML=document.getElementsByName('itemQty[]')[i].value+' <input type="hidden" id="itemQty" name ="itemQty[]" value="'+document.getElementsByName('itemQty[]')[i].value+'">';

    }

  }

  function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("itemTable").deleteRow(i);
  }

  function addNewItem(){

    var table=document.getElementById('itemTable');
    var row = table.insertRow(-1);


    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4= row.insertCell(3);


    cell1.innerHTML = 'Item : <select id="itemName" onchange="setItemType(this)" name="itemName[]" class="form-control">'
    <?php 
      $itemCart = new ItemCart();
      $itemCart->getProducts();    
                  
      foreach($itemCart->itemList as $iList){?>
            +'<option value="<?php echo $iList["type_id"];?>"><?php echo $iList["item_name"];?></option>'
            
            <?php }?>
            +'';

    cell2.innerHTML = 'Quantity: <input type="text" name="itemQty[]" class="form-control">';
    cell3.innerHTML ='<br><button onclick="deleteRow(this)" class="btn btn-danger">Remove</button>';
    cell4.innerHTML ='<input type="hidden" id="typeId" name ="typeId[]" value="1" >'

  }

  function setItemType(r){
    var i = r.parentNode.parentNode.rowIndex;
  
    var e=document.getElementsByName('itemName[]')[i];
    var selectedId=e.options[e.selectedIndex].value;
    document.getElementsByName('typeId[]')[i].value=selectedId;
    

      //alert(document.getElementsByName('typeId').value);



  }
</script>

</html>
<?php
                        
  $conn->close();