<?php
// require_once "partical/_databconnect>.php";
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "login";

$conn = mysqli_connect($host, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("database not connected");
} else {
    echo "success connect";
}
if (isset($_REQUEST['submit'])) {
    $username = $_REQUEST['username'];
    $fullname = $_REQUEST['fullname'];
    $dob = $_REQUEST["dob"];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $regOn = date('y-m-d H:i:s');

    $getData = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
    $rowCount = mysqli_num_rows($getData);
    if ($rowCount != 0) {
        $_SESSION['errorMsg'] = "username is already regsitered";
    } else {
        $_query = mysqli_query($conn, "INSERT INTO `users`( `username`, `fullname`, `dob`, `gender`, `email`, `password`, `phone`, `address`, `state`, `city`, `zip`, `registered_on`) VALUES ('$username','$fullname','$dob','$gender','$email','$password','$phone','$address','$city','$state','$zip','$regOn')");
        $_SESSION['successMsg'] = "Registered Succcessfully";
        header('location : login.php');
    }
}
 else {
    $_SESSION['errorMsg'] = ("Please submit the form");
}