<?php

$uname = $_POST['username'];
$pwd = $_POST['pwd'];
include 'dbCode.php';
login($uname, $pwd);