<?php

$prodID = $_POST['$prodID'];
include 'dbCode.php';
deleteProductDetails($prodID);