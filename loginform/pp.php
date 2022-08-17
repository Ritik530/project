<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "login";

$conn = mysqli_connect($host, $username,$password,$db_name);
if(mysqli_connect_errno($conn)){
    die("does not connect");
}


?>