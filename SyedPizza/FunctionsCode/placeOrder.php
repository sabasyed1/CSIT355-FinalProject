<?php

include 'dbCode.php';


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userID'];
    if(isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $zipcode = $_POST["zipcode"];
        $password = $_POST["password"];
        
        $passSql = "SELECT * FROM users WHERE id='$userId'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        $userName = $passRow['username'];
        if ($password ==  $passRow['password']){ 
            $sqlOrder = "INSERT INTO `orders` (`userId`, `address`, `zipCode`, `phoneNumber`, `amount`, `payment`, `orderStatus`, `orderDate`) VALUES ('$userId', '$address', '$zipcode', '$phone', '$amount', '0', '0', current_timestamp())";
            $result = mysqli_query($conn, $sqlOrder);
            $orderId = $conn->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `cart` WHERE userId='$userId'"; 
                $addResult = mysqli_query($conn, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $productId = $addrow['productId'];
                    $itemQuantity = $addrow['quantity'];
                    $itemSql = "INSERT INTO `orderitems` (`orderId`, `productId`, `quantity`) VALUES ('$orderId', '$productId', '$itemQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
                $deletesql = "DELETE FROM `cart` WHERE `userId`='$userId'";   
                $deleteresult = mysqli_query($conn, $deletesql);
                echo '<script>alert("Thanks for ordering with us. Your order id is ' .$orderId. '.");
                    window.history.back(1);
                    </script>';
                    exit();
            }
        } 
        else{
            echo '<script>alert("Incorrect Password! Please enter correct Password.");
                    window.history.back(1);
                    </script>';
                    exit();
        }    
    }
    
}

?>