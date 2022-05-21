<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: ../login.php');
    exit;
}

include 'dbCode.php';
$userID = $_SESSION['userID'];

if (isset($_POST['updateInfo'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    updateuUserProfile($userID, $fname, $lname, $uname, $email, $phone, $addr);
}
