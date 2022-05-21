<?php
$title = "Order History";

// include functions & files 
include 'FunctionsCode/dbCode.php';
include 'Shared_Pages/header.php';
include 'Shared_Pages/navigation.php';


?>
 <section class="content">
    <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Order History</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" id="searchBar" class="form-control" placeholder="Search Orders By ID">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                  <button type="button" id="deleteBTN" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                     <thead>
                    <tr>
                        <th></th>
                        <th>Order Id</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Amount</th>						
                        <th>Payment Mode</th>
                        <th>Order Date</th>
                        <th>Status</th>						
                        <th>Items</th>
                    </tr>
                </thead>
                  <tbody>
                  <tr>            
                     <?php
                        $userId = $_SESSION['userID'];
                        $sql = "SELECT * FROM `orders` WHERE `userId`= $userId";
                        $result = mysqli_query($conn, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $orderId = $row['orderId'];
                            $address = $row['address'];
                            $zipCode = $row['zipCode'];
                            $phoneNumber = $row['phoneNumber'];
                            $amount = $row['amount'];
                            $orderDate = $row['orderDate'];
                            $payment = $row['payment'];
                            if($payment == 0) {
                                $payment = "Cash on Delivery";
                            }
                            else {
                                $payment = "Online";
                            }
                            $orderStatus = OrderStatus(intval($row['orderStatus']));
                            
                            $sqlItems = "SELECT * FROM `orderitems` WHERE `orderId`= $orderId";
                            $resultItems = mysqli_query($conn, $sqlItems);
                            $totalItems = $resultItems->num_rows;
                            $counter++;
                            
                            echo '<tr class="orderTR">
                                    <td><div class="icheck-primary"><input type="checkbox" value="" name="OrderCheckbox"><label for="OrderCheckbox"></label></div></td>
                                    <td><small>OR - </small><a href="orderitems.php?orderID='. $orderId .'" class="orderIDA">' . $orderId . '</a></td>
                                    <td>' . substr($address, 0, 20) . '...</td>
                                    <td>' . $phoneNumber . '</td>
                                    <td>' . $amount . '</td>
                                    <td>' . $payment . '</td>
                                    <td>' . $orderDate . '</td>
                                    <td><span>' . OrderStatus($orderStatus) . '</span></td>
                                    <td><span>' . $totalItems . ' </span></td>
                                    
                                </tr>';
                        }
                        
                        if($counter==0) {
                            ?><script> document.getElementById("empty").innerHTML = '<div class="col-md-12 my-5"><div class="card"> <div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>You have not ordered any items.</strong></h3><h4>Keep Shopping...</h4> <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Continue shopping</a></div></div></div></div>';</script> <?php
                        }
                    ?>
                  </tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
          <!-- /.card -->
        </div>
    </section>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
 $(function () {
     $('#searchBar').on('keyup',function(){
         var searchText = $(this).val();
         var orderTR = $('.orderTR');
         var orderIDA = $('.orderIDA');
         var checkLength = orderIDA.length;
         for(var i = 0; i < checkLength; i++)
             {
                 if (!$(orderIDA[i]).text().toLowerCase().startsWith(searchText.toLowerCase())) {
                $(orderTR[i]).hide();
                    } else {
                        $(orderTR[i]).show();
                    }
             }
         
     });
     
     $('#deleteBTN').on('click',function(){
        var checkboxes = $('.mailbox-messages input[type=\'checkbox\']').filter(':checked');
         var isLastCall = false;
        for(var i = 0; i < checkboxes.length ; i++)
            {
                if($(checkboxes[i]).prop('checked')===true)
                    {
                         var orderIDA = $(checkboxes[i]).parent().parent().parent().find('.orderIDA');
                        if(i+1 === checkboxes.length)
                            isLastCall = true;
                        AJAXCallToPHP($(orderIDA[i]).text(),isLastCall);
                    }
            }
         
     });
     
     function AJAXCallToPHP($orderID, $isLastCall)
     {
         var URL = window.location.origin + '/SyedPizza/FunctionsCode/removeOrder.php';
         $.ajax({
             url: URL,
             type:'POST',
             async:false,
             data:{orderID:$orderID},
             success: function(result){
                 if(result === 'True' && $isLastCall){
                     window.location.reload();
                 }
             },
             error: function(result){
                 debugger;
             }
             
         });
     }
     
     
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    });
 });
</script>

<!-- footer -->
<?php include 'Shared_Pages/footer.php';?>