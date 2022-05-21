<?php
include 'dbCode.php';
session_start();

echo isset($_POST['updateQuan']);
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userID'];
    $cartID = $_POST["cartID"];
        $quan = $_POST["quantity"];
        updateCartQuantity($cartID,$quan);
        echo "<script>
                    window.history.back(1);
                    </script>";
}


?>