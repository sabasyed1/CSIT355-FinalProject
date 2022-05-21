<?php

include 'dbCode.php';


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Add'])) {
        $prodName = $_POST["prodName"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $description = $_POST["description"];
        addProduct($prodName, $price, $description, $category);
    }
    
}

?>