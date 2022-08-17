<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'loginform');

// Try connecting to  Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if(mysqli_connect_errno()){
    die("Error: Cannot connect");  
}
else
{
    echo"connect";
}

    



?>