<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
       <a class="nav-link" href="cartitems.php">
          <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
          <span class="badge badge-warning navbar-badge" style="font-size:0.7em">
              <?php
              $cartCount = countCartItemsForUser($_SESSION['userID']);
              echo $cartCount;
              ?>
              
           </span>
        </a>
      </li>
    </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="products.php" class="brand-link">
            <img src="dist/img/logo.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">NJ Pizzeria</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/profilepic.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="userprofile.php" class="d-block ">
                        <?php
                        $user = getUserInfoByID($_SESSION['userID']);
                        $userInfo = $user->fetch_assoc();
                        echo $userInfo['firstName'].' '. $userInfo['lastName'];
                        ?>
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->

                    <?php
                    $current = basename($_SERVER['PHP_SELF']);
                    $products = "nav-link";
                    $orderhistory = "nav-link";
                    $inventory = "nav-link";
                    $users = "nav-link";
                    
                    if ($current == 'products.php') {
                        $products = 'nav-link active';
                    }
                    if ($current == 'orderhistory.php') {
                        $orderhistory = 'nav-link active';
                    }
                    if ($current == 'inventory.php') {
                        $inventory = 'nav-link active';
                    }
                    if ($current == 'users.php') {
                        $users = 'nav-link active';
                    }
                    ?>

                    <li class="nav-item">
                        <a href="products.php" class="<?php echo $products ?>">
                          <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                   <li class="nav-item">
                        <a href="orderhistory.php" class="<?php echo $orderhistory ?>">
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>
                                Order History
                            </p>
                        </a>
                    </li>
                     <?php 
                    if($_SESSION['isAdmin'] === '1')
                    {
                     ?>
                     <li class="nav-item">
                        <a href="inventory.php" class="<?php echo $inventory ?>">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Inventory
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="<?php echo $users ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    
                    
                        
                    <?php    
                    }
                    ?>
                    <li class="nav-item">
                        <a href="FunctionsCode/logoutCode.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?php echo $title ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><?php echo $title ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->