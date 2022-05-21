<?php
$title = "Users";

// include functions & files 
include 'FunctionsCode/dbCode.php';
include 'Shared_Pages/header.php';
include 'Shared_Pages/navigation.php';


?>
<style>
    .productImg{
        width: 10em;
        height: 10em;
    }
</style>
 <section class="content">
    <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Users</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" id="searchBar" class="form-control" placeholder="Search User By First Name">
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
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#AddUser">
                    <i class="fa fa-plus"></i>
                  </button>
                  <button type="button" id="deleteBTN" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
              </div>
              <div class="table-responsive mailbox-messages">
            <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%"></th>
                      <th style="width: 10%">
                          #
                      </th>
                      <th style="width: 10%">
                          Username
                      </th>
                      <th style="width: 15%">
                          First Name
                      </th>
                      <th style="width: 10%">
                        Last Name
                      </th>
                      <th style="width: 20%">
                          Email
                      </th>
                      <th style="width: 10%">
                          Phone
                      </th>
                      <th style="width: 10%">
                          Date Joined
                      </th>
                  </tr>
              </thead>
                  <tbody>
                  <tr>            
                     <?php
                        $sql = "SELECT * FROM `users` WHERE `userType` = '0'";
                        $result = mysqli_query($conn, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $username = $row['username'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $joinDate= $row['joinDate'];
                            echo '<tr class="userTR">
                                    <td><div class="icheck-primary"><input type="checkbox" value="" name="ProductCheckbox"><label for="ProductCheckbox"></label></div></td>
                                    <td><small>User - </small><a href="#" class="userIDA">' . $row['id'] . '</a></td>
                                    <td>'. $username .'</td>
                                    <td class="userFirstName">' . $firstName . '</td>
                                    <td>' . $lastName . '</td>
                                    <td>' . $email . '</td>
                                    <td>' .  $phone . '</td>
                                    <td><span>' . $joinDate. '</span></td>
                                </tr>';
                            $counter++;
                        }
                        
                        if($counter==0) {
                            ?>
                      <td colspan="8">
                      <div class="col-md-12 my-5"><div class="card"> <div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>No Users.</strong></h3><h4>Press <bold>"+" </bold> button to add User.</h4></div></div></div></div>
                      </td>
                      
                      <?php
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
          </div>
          <!-- /.card -->
    </section>

<!-- /.Add Product -->

<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="AddUser" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkout">Enter User Details:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="FunctionsCode/addUser.php" method="post" oninput='confirmPass.setCustomValidity(confirmPass.value != pass.value ? "Passwords do not match." : "")'>
         <div class="input-group mb-3">
          <input type="text" class="form-control" name="firstName" required id="firstName"  placeholder="First name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastName" required id="lastName" placeholder="Last name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" required id="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <input type="number" class="form-control" name="phnNum" required id="phnNum" placeholder="Phone Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" required id="pass" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirmPass" required id="confirmPass" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="Add" class="btn btn-success">Add User</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div> 



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
 $(function () {
     $('#searchBar').on('keyup',function(){
         var searchText = $(this).val();
         var userTR = $('.userTR');
         var userFirstName = $('.userFirstName');
         var checkLength = userFirstName.length;
         for(var i = 0; i < checkLength; i++)
             {
                 if (!$(userFirstName[i]).text().toLowerCase().startsWith(searchText.toLowerCase())) {
                $(userTR[i]).hide();
                    } else {
                        $(userTR[i]).show();
                    }
             }
         
     });
     
     $('#deleteBTN').on('click',function(){
        var checkboxes = $('.mailbox-messages input[type=\'checkbox\']').filter(':checked');
         var isLastCall = false;
        for(var i = 0; i < checkboxes.length ; i++)
            {
                var prodIDA = $(checkboxes[i]).parent().parent().parent().find('.userIDA');
                        if(i+1 === checkboxes.length)
                            isLastCall = true;
                        AJAXCallToPHP($(prodIDA[i]).text(),isLastCall);
            }
         
     });
     
     function AJAXCallToPHP($userID, $isLastCall)
     {
         var URL = window.location.origin + '/SyedPizza/FunctionsCode/removeUser.php';
         $.ajax({
             url: URL,
             type:'POST',
             async:false,
             data:{$userID:$userID},
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