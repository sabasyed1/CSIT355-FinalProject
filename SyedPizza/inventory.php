<?php
$title = "Inventory";

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
              <h3 class="card-title">Inventory</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" id="searchBar" class="form-control" placeholder="Search Product By Name">
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
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#AddProduct">
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
                          Image
                      </th>
                      <th style="width: 15%">
                          Product
                      </th>
                      <th style="width: 10%">
                        ($) Price
                      </th>
                      <th style="width: 20%">
                          Description
                      </th>
                      <th style="width: 10%">
                          Category
                      </th>
                      <th style="width: 10%">
                          Date Created
                      </th>
                  </tr>
              </thead>
                  <tbody>
                  <tr>            
                     <?php
                        $sql = "SELECT * FROM `product`";
                        $result = mysqli_query($conn, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $productId = $row['productId'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $category = $row['categorieId'];
                            $dateCreated = $row['madeDate'];
                            $category = getCategoryName($category);
                            echo '<tr class="productTR">
                                    <td><div class="icheck-primary"><input type="checkbox" value="" name="ProductCheckbox"><label for="ProductCheckbox"></label></div></td>
                                    <td><small>PR - </small><a href="#" class="prodIDA">' . $productId . '</a></td>
                                    <td><img src="dist/img/'. $row['img'] .'" alt="Product Image Here"  class = "productImg" /></td>
                                    <td class="prodName">' . $name . '</td>
                                    <td>' . $price . '</td>
                                    <td>' . $description . '</td>
                                    <td>' .  $category['name'] . '</td>
                                    <td><span>' . $dateCreated. '</span></td>
                                </tr>';
                            $counter++;
                        }
                        
                        if($counter==0) {
                            ?>
                      <td colspan="8">
                      <div class="col-md-12 my-5"><div class="card"> <div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>There are no Products.</strong></h3><h4>Press <bold>"+" </bold> button to add product.</h4></div></div></div></div>
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

<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="AddProduct" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkout">Enter Product Details:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="FunctionsCode/addProduct.php" method="post">
                <div class="form-group">
                    <b><label for="prodName">Product Name:</label></b>
                    <input class="form-control" id="prodName" name="prodName" placeholder="Product Name" type="text" required minlength="3" maxlength="500">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="price">Price:</label></b>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">$</span>
                        </div>
                        <input type="number" class="form-control" id="price" name="price" placeholder="0" required  maxlength="2">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="category">Category:</label></b>
                        <select name="category" id="category" class="form-control" required>
                            <option value="0">Please Select Category</option>
                            <?php
                                $allCategories = getAllCategories();
                            while ($row = $allCategories->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['categorieId']?>"><?= $row['name']?></option>
                        <?php
                            }
                                ?>
                        </select>                 
                    </div>
                </div>
                <div class="form-group">
                    <b><label for="description">Description:</label></b>    
                    <textarea class="form-control" id="description" name="description" placeholder="Description">
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="Add" class="btn btn-success">Add Product</button>
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
         var prodTR = $('.productTR');
         var prodName = $('.prodName');
         var checkLength = prodName.length;
         for(var i = 0; i < checkLength; i++)
             {
                 if (!$(prodName[i]).text().toLowerCase().startsWith(searchText.toLowerCase())) {
                $(prodTR[i]).hide();
                    } else {
                        $(prodTR[i]).show();
                    }
             }
         
     });
     
     $('#deleteBTN').on('click',function(){
        var checkboxes = $('.mailbox-messages input[type=\'checkbox\']').filter(':checked');
         var isLastCall = false;
        for(var i = 0; i < checkboxes.length ; i++)
            {
                         var prodIDA = $(checkboxes[i]).parent().parent().parent().find('.prodIDA');
                        if(i+1 === checkboxes.length)
                            isLastCall = true;
                        AJAXCallToPHP($(prodIDA).text(),isLastCall);
            }
         
     });
     
     function AJAXCallToPHP($prodID, isLastCall)
     {
         var URL = window.location.origin + '/SyedPizza/FunctionsCode/removeProduct.php';
         $.ajax({
             url: URL,
             type:'POST',
             async:false,
             data:{$prodID:$prodID},
             success: function(result){
                 if(result === 'True' && isLastCall){
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