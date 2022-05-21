<?php

include 'dbCode.php';


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Add'])) {
       $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phnNum'];
    $pwd = $_POST['pass'];
    addUser($uname, $fname, $lname, $email,$phone,$pwd);
    }
    
}

?>