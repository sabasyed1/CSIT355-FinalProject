<?php

$userID = $_POST['$userID'];
include 'dbCode.php';
deleteUserDetails($userID);