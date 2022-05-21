<?php
$title = "Order History";

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
            <!-- /.card-header -->
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
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $orderID = $_GET['orderID'];
                  $orderItems = getOrderItemsForOrder($orderID);
                  $num_results = $orderItems->num_rows;
                   if ($num_results != 0) {
                       $i = 1;
                       $totalPrice = 0;
                       $totalQuantity = 0;
                           while ($row = $orderItems->fetch_assoc()) {
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
                               echo '<input type="number" value="'. $row['quantity'] .'" min="1" disabled class="form-control"/>';
                               echo '</td>';
                               echo '<td>';
                               echo '<span>'. $product['description'] .'</span>';
                               echo '</td>';
                               echo '</tr>';
                               $i++;
                           }
                       }
                  ?>
              </tbody>
          </table>
        </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </section>

<!-- footer -->
<?php include 'Shared_Pages/footer.php';?>