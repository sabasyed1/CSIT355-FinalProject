<?php

$orderID = $_POST['orderID'];
include 'dbCode.php';
deleteOrderDetails($orderID);
