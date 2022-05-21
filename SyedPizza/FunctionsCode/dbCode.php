<?php

$db = new mysqli('localhost', 'syeds3_syeds3', '4X&8}R?lPdsN', 'syeds3_NJPizzeria');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}
$server = "localhost";
$username = "syeds3_syeds3";
$password = "4X&8}R?lPdsN";
$database = "syeds3_NJPizzeria";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

function disconnectDB()
{
    global $db;
    $db->close();
}

function login($uname, $pwd)
{
    session_start();
    global $db;
    $query = "SELECT * FROM users WHERE username = '$uname'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $confirmPass = $row['password'];

    if (mysqli_num_rows($result) == 0) {
        header('Location: ../login.php?msg=error');
        exit;
    }
    if ($pwd != $confirmPass) {
        echo $pwd;
        header('Location: ../login.php?msg=incorrectpass');
        $result->free();
    } else {
        $_SESSION['userID'] = $row['id'];
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['isAdmin'] = $row['userType'];
        $result->free();
        header('Location: ../products.php');
    }
}


function register($fname, $lname, $uname, $email, $phone, $pwd)
{
    global $db;
    try {
        $query = "INSERT INTO `users`( `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`)  VALUES ('$uname','$fname', '$lname', '$email', '$phone',TRUE, '$pwd')";
        $result = $db->query($query);
        echo $result;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        echo $error_message;
        header("Location: ../register.php?msg='$error_message'");
    }

    // checks for successful result
    if ($result) {
        $query = "SELECT * FROM users WHERE username = '$uname'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        if($row['userType'] == 0)
            {
                $_SESSION['isAdmin'] = 'FALSE';
            }
            else
            {
                $_SESSION['isAdmin'] = 'TRUE';
            }
        if (isset($_SESSION['loggedin'])) {
            $userID = $row['id'];
            echo 'User.' . $userID;
            header('Location: ../products.php?userid=' . $userID);
        } else {
            session_start();
            $_SESSION['userID'] = $row['id'];
            $_SESSION['loggedin'] = TRUE;
            $result->free();
            header('Location: ../products.php');
            exit;
        }
    } else {
        header('Location: ../register.php?msg=error');
    }
}
// gets all categories
function getAllCategories()
{
    global $db;
    $query = "SELECT * FROM categories";
    $result = $db->query($query);
    return $result;
}

// get category name by ID
function getCategoryName($catID)
{
    global $db;
    $query = "SELECT `name` FROM categories where `categorieId` = '$catID'";
    $result = $db->query($query);
    return $result->fetch_assoc();
}

// gets all products
function getAllProducts()
{
    global $db;
    $query = "SELECT * FROM `product` ORDER BY `name` ASC";
    $result = $db->query($query);
    return $result;
}

// get single product
function getSingleProduct($prodID)
{
    global $db;
    $query = "SELECT * FROM `product` where `productId` = '$prodID'";
    $result = $db->query($query);
    return $result->fetch_assoc();
}

// get user info by ID
function getUserInfoByID($userID)
{
    global $db;
    $query = "SELECT * FROM `users` WHERE `id` = '$userID'";
    $result = $db->query($query);
    return $result;
}

// check if item is added in cart
function checkCartItemForUser($itemId,$userId)
{
    global $db;
    $query = "SELECT * FROM `cart` WHERE productId = '$itemId' AND `userId`='$userId'";
    $result = $db->query($query);
    $numExistRows = mysqli_num_rows($result);
    return $numExistRows;
}

// cart count
function countCartItemsForUser($userId)
{
    global $db;
    $query = "SELECT * FROM `cart` WHERE `userId`='$userId'";
    $result = $db->query($query);
    $numExistRows = mysqli_num_rows($result);
    return $numExistRows;
}

//get cart items
function getCartItemsForUser($userId)
{
    global $db;
    $query = "SELECT * FROM `cart` WHERE `userId`='$userId' ORDER BY `addedDate` DESC";
    return $result = $db->query($query);
}

//update cart quantity
function updateCartQuantity($cartID,$quan)
{
    global $db;
    $query = "UPDATE`cart` SET `quantity`= '$quan' WHERE `cartId`='$cartID'";
    $result = $db->query($query);
    return $result;
}

// Get Order Status

function OrderStatus($value){
    if($value == 0)
    {
        return 'OrderPlace';
    }
    if($value == 1)
    {
        return 'OrderConfirmed';
    }
    if($value == 2)
    {
        return 'PreparingOrder';
    }
    if($value == 3)
    {
        return 'OnTheWay';
    }
    if($value == 4)
    {
        return 'OrderDelievered';
    }
    if($value == 5)
    {
        return 'OrderDenied';
    }
    if($value == 6)
    {
        return 'OrderCancelled';
    }
}

// Delete Order Details
function deleteOrderDetails($orderID)
{
        global $db;
        $query = "DELETE FROM `orderitems` WHERE `orderId`=$orderID";
        $result = $db->query($query);
        $query2 = "DELETE FROM `orders` WHERE `orderId`=$orderID";
        $result2 = $db->query($query2);
        echo 'True';
}

//get order items
function getOrderItemsForOrder($orderID)
{
    global $db;
    $query = "SELECT * FROM `orderitems` WHERE `orderId`='$orderID'";
    return $result = $db->query($query);
}

//get User profile data
function getUserProfileData($userID)
{
    global $db;
    $query = "SELECT * FROM `users` WHERE `id`='$userID'";
    $result = $db->query($query);
    $data = $result->fetch_assoc();
    return $data;
}

//update user profile
function updateuUserProfile($userID, $fname, $lname, $uname, $email, $phone)
{
    global $db;

    $query = "UPDATE `users` SET `firstName` = '$fname', `lastName` = '$lname', `username` = '$uname', `email` = '$email', `phone` = '$phone' WHERE `users`.`id` = '$userID'";
    echo $query;
    $result = $db->query($query);

    if (!$result) {
        echo 'Error updating info.';
    } else {
        if (isset($_SESSION['userID'])) {
            header("Location: ../products.php");
            exit;
        }
    }
}

// Delete Order Details
function deleteProductDetails($prodID)
{
        global $db;
        $query = "DELETE FROM `product` WHERE `productId`=$prodID";
        $result = $db->query($query);
        echo 'True';
}

//add Product
function addProduct($prodName, $price, $description, $category)
{
     global $db;
    try{
    $query = "INSERT INTO `product` ( `name`, `price`, `description`, `categorieId`, `madeDate`, `img`) VALUES ('$prodName', $price, '$description', '$category', current_timestamp(),'NewProduct.jpg')";
    $result = $db->query($query);
        echo '<script>alert("' .$prodName. ' is added.");
                    window.history.back(1);
                    </script>';
                    exit();  
        
    }
    catch (Exception $e) {
        $error_message = $e->getMessage();
        echo '<script>alert("' .$error_message. '");
                    window.history.back(1);
                    </script>';
                    exit();  
    }

}

// Delete Order Details
function deleteUserDetails($userID)
{
        global $db;
        $query = "DELETE FROM `users` WHERE `id`=$userID";
        $result = $db->query($query);
        echo 'True';
}

//add Product
function addUser($uname, $fname, $lname, $email,$phone,$pwd)
{
     global $db;
    try{
        $query = "INSERT INTO `users`( `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`)  VALUES ('$uname','$fname', '$lname', '$email', '$phone',TRUE, '$pwd')";
        $result = $db->query($query);
        echo '<script>alert("' .$uname. ' is added.");
                    window.history.back(1);
                    </script>';
                    exit();  
        
    }
    catch (Exception $e) {
        $error_message = $e->getMessage();
        echo '<script>alert("' .$error_message. '");
                    window.history.back(1);
                    </script>';
                    exit();  
    }

}