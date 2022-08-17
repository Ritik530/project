<?php

session_start();
$_SESSION = array();
// session_unset($_SESSION['loggedin']);
session_destroy();
header("location: login.php");

?>