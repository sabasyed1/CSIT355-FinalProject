    <?php

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phnNum'];
    $pwd = $_POST['pass'];
    $pwd2 = $_POST['confirmPass'];
    include 'dbCode.php';

    if ($pwd !== $pwd) {
        echo 'Error: your passwords need to match.';
        echo '<a class = "link" href=../register.php>Try again.</a>';
        exit;
    }
    register($fname, $lname, $uname, $email, $phone, $pwd);
    ?>