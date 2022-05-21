<?php
$title = "Cart";

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
<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header col-md-12">
            <div class="col-md-8">
                <h3 class="card-title">Cart Items</h3>
            </div>
            <?php 
                    $allCartItems = getCartItemsForUser($_SESSION['userID']);
                    $num_results = $allCartItems->num_rows;
            if ($num_results != 0) {
            ?>
            <div class="col-md-6 float-sm-right">
                 <button type="button" class="btn btn-block btn-warning float-sm-right col-md-4" data-toggle="modal" data-target="#checkout">Proceed to checkout</button>
            </div>
            <?php 
            
            }
            else
            {
                ?>
            <div class="col-md-6 float-sm-right">
                 <button type="button" class="btn btn-block btn-warning float-sm-right col-md-4" data-toggle="modal" data-target="#checkout" disabled>Proceed to checkout</button>
            </div>
            
            <?php 
            }
            ?>
          
            
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 15%">
                          Image
                      </th>
                      <th style="width: 15%">
                          Product
                      </th>
                      <th style="width: 10%">
                        ($) Price
                      </th>
                      <th style="width: 10%">
                          Quantity
                      </th>
                      <th style="width: 20%">
                          Description
                      </th>
                      <th style="width: 10%">
                          Added Date
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  
                 
                   if ($num_results != 0) {
                       $i = 1;
                       $totalPrice = 0;
                       $totalQuantity = 0;
                           while ($row = $allCartItems->fetch_assoc()) {
                               echo '<tr>';
                               echo '<td>';
                               echo $i;
                               $product = getSingleProduct($row['productId']);
                               $category = getCategoryName($product['categorieId']);
                               echo '</td>';
                               echo '<td>';
                               echo '<img src="dist/img/'. $product['img'] .'" alt="Product Image Here" class = "productImg" />';
                               echo '</td>';
                               echo '<td>';
                               echo '<a>'. $product['name'] .' </a> <br/> <small> Category: '. $category['name'] .' </small> ';
                               echo '</td>';
                               echo '<td>';
                               $totalQuantity = $totalQuantity +  intval($row['quantity']);
                               $totalPrice = $totalPrice + (intval($product['price']) * intval($row['quantity']));
                               echo '<span>$'. $product['price'] .'</span>';
                               echo '</td>';
                               echo '<td>';
                               echo '<form name="quanForm" action="FunctionsCode/updateCartQuantity.php" method = "POST">';
                               echo '<input type="number" name="quantity" onkeyup="updateCartQuantity(this)" onmouseup="updateCartQuantity(this)" value="'. $row['quantity'] .'" min="1" class="form-control"/>';
                               echo '<input type="hidden" name="cartID" value="'. $row['cartId'] .'"/>';
                               echo '<button type="submit" name="updateQuan" hidden></button>';
                               echo '</form>';
                               echo '</td>';
                               echo '<td>';
                               echo '<span>'. $product['description'] .'</span>';
                               echo '</td>';
                               echo '<td>';
                               echo '<span>'. DateTime::createFromFormat("Y-m-d H:i:s",$row['addedDate'])->format("m/d/Y") .'</span>';
                               echo '</td>';
                               echo '<td class="project-actions">';
                               echo '<form action="FunctionsCode/manageCartCode.php" method="POST">';
                               echo '<input type="hidden" name="itemId" value="'.$row['productId']. '">';
                               echo '<button type="submit" name="removeItem" class="btn btn-danger col-md-8">';
                               echo '<i class="fas fa-trash"> </i>';
                               echo '  Remove</button>';
                               echo '</form>';
                               echo '</td>';
                               echo '</tr>';
                               $i++;
                           }
                       }
                  else
                  {
                      
                  
                  ?>
                  <td colspan="8">
                      <div class="col-md-12 my-5"><div class="card"> <div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>No Cart Items.</strong></h3><h4>Keep Shoping To Add Products To Cart.</h4></div></div></div></div>
                      </td>
                      
                      <?php
                        }
                    ?>
              </tbody>
              <tfoot>
              <tr>
                      <th style="width: 1%">
                      </th>
                      <th style="width: 15%">
                      </th>
                      <th style="width: 15%">
                      </th>
                      <th style="width: 10%">
                        <?php
                          if ($num_results != 0) {
                            echo  'Total Price: $'. $totalPrice .' ' ;
                          }
                          ?>
                          
                      </th>
                      <th style="width: 11%">
                          <?php
                          if ($num_results != 0) {
                            echo  'Total Quantity: '. $totalQuantity .' ' ;
                          }
                          ?>
                          
                      </th>
                      <th style="width: 20%">
                      </th>
                      <th style="width: 10%">
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
 
<!-- Checkout  -->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="checkout" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkout">Enter Your Details:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="FunctionsCode/placeOrder.php" method="post">
                <div class="form-group">
                    <b><label for="address">Address:</label></b>
                    <input class="form-control" id="address" name="address" placeholder="Address" type="text" required minlength="3" maxlength="500">
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="phone">Phone Number:</label></b>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+1</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="zipcode">Zip Code:</label></b>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxxx" required pattern="[0-9]{6}" maxlength="6">                    
                    </div>
                </div>
                <div class="form-group">
                    <b><label for="password">Password:</label></b>    
                    <input class="form-control" id="password" name="password" placeholder="Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                    <button type="submit" name="checkout" class="btn btn-success">Place Order</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div> 
    </section>
<!-- footer -->
<?php include 'Shared_Pages/footer.php';?>