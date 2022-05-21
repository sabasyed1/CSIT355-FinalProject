<?php
$title = "Products";

// include functions & files 
include 'FunctionsCode/dbCode.php';
include 'Shared_Pages/header.php';
include 'Shared_Pages/navigation.php';

?>

<style>
    .productImg{
        width: 50em;
        height: 20em;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-body">
                      <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form id="SearchForm" action="transactions-by-name.php" method="post">
                            <div class="input-group">
                                <input type="search"  id="searchedProduct" class="form-control form-control-lg" placeholder="Search By Product Name">                           
                                <div class="input-group-append">
                            <button type="button" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div>
                  <div class="btn-group w-100 mb-2">
                    <a class="btn btn-info active allItemsATag" href="javascript:void(0)" data-filter="all"> All items </a>
                      <?php
                      $categories = getAllCategories();
                      $num_results = $categories->num_rows;
                       if ($num_results != 0) {
                           while ($row = $categories->fetch_assoc()) {
                               echo '<a class="btn btn-info" href="javascript:void(0)" data-filter="' . $row['categorieId'] . '">' . $row['name'] . '</a>';
                           }
                       }
                      ?>
                  </div>
                </div>
                <div>
                  <div class="filter-container p-0 row">
                      
                       <?php
                      $products = getAllProducts();
                      $num_results = $products->num_rows;
                       if ($num_results != 0) {
                           while ($row = $products->fetch_assoc()) {
                               echo '<div class="filtr-item col-sm-3 divProducts" data-category="'. $row['categorieId'] .'" data-sort="white sample">';
                               echo '<a class="btn btn-info" href="dist/img/'. $row['img'] .'" data-toggle="lightbox" data-img="'. $row['img'] .'" data-footer="'. $row['description'] .'" data-title="'. $row['name'] .' - $'. $row['price'] .'">';
                               echo '<img src="dist/img/'. $row['img'] .'" class="img-fluid mb-2 productImg" alt="'. $row['name']  .' - $'. $row['price'] .'"/>';
                               echo '<span class = "productNameSpan"> '. $row['name'] .' </span> ';
                               echo '</a>';
                               echo '<form action="FunctionsCode/manageCartCode.php" method="POST">';
                               echo '<input type="hidden" name="itemId" value="'.$row['productId']. '">';
                               $numExistRows = checkCartItemForUser($row['productId'],$_SESSION['userID']);
                                if($numExistRows > 0){
                                    echo '<button type="submit" name="removeItem" class="btn btn-danger col-md-12">Remove From Cart</button>';
                                }
                               else{
                                   echo '<button type="submit" name="addToCart" class="btn btn-warning col-md-12">Add To Cart</button>';
                               }
                               
                               echo '</form>';
                               echo '</div>';
                           }
                       }
                      ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<script>
    
    $('#searchedProduct').on('keyup',function(){
        var searchValue = $(this).val();
        var spanProducts = $('.productNameSpan');
        var divProducts = $('.divProducts');
         var checkLength = spanProducts.length;
         for(var i = 0; i < checkLength; i++)
             {
                 var productName = $.trim($(spanProducts[i]).text());
                 if (!productName.toLowerCase().startsWith(searchValue.toLowerCase())) {
                $(divProducts[i]).hide();
                    } else {
                        $(divProducts[i]).show();
                        
                    }
             }
    });
    
      $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

<!-- footer -->
<?php include 'Shared_Pages/footer.php'; ?>