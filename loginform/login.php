<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: dashboard.php");
    exit;
}

$host = "localhost";
$userName = "root";
$password = "";
$db_name = "login";

$conn = mysqli_connect($host, $userName, $password, $db_name);
if (mysqli_connect_errno()) {
    die("database not connected");
}
if (isset($_REQUEST['submit'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];


    $sql = "SELECT  username, password FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = mysqli_query($conn, $sql);

    if (mysqli_num_rows($stmt) == 1) {
        if (mysqli_fetch_assoc($stmt)) {
            // 
            if ($password != "" && $username != "") {
                // this means the password is corrct. Allow user to login
                $_SESSION["username"] = $username;
                $_SESSION["loggedin"] = true;

                //Redirect user to nextpage
                header("location: dashboard.php");
            }
        }
    } else {
        $_SESSION['errorMsg'] = "Please enter the right username and password";
    }
}







?>



<!-- // if ($password != "" && $username != "") { -->


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <style>
        body {
            /* background-image: url(image1.jpg); */
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            background-color: while;
            width: 50%;
            padding: 40px;
            margin: 100px auto;

        }

        #div1 {
            background-color: white;



        }
    </style>
    <title>Trignosoft!</title>
</head>

<body>
    <?php
    // echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    //     <a class="navbar-brand" href="#">LoginSystem</a>
    //     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    //         <span class="navbar-toggler-icon"></span>
    //     </button>
    //     <div class="collapse navbar-collapse" id="navbarNavDropdown">
    //         <ul class="navbar-nav">
    //             <li class="nav-item active">
    //                 <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
    //             </li>
    //             <li class="nav-item">
    //                 <a class="nav-link" href="#">About</a>
    //             </li>
    //             <li class="nav-item">
    //                 <a class="nav-link" href="#">Contact As</a>
    //             </li>

    //         </ul>
    //         <ul class="navbar-nav ml-auto">
    //             <li class="nav-item">
    //                 <a class="nav-link" href="register.php">Register</a>
    //             </li>
    //             <li class="nav-item">
    //                 <a class="nav-link" href="login.php">Login</a>
    //             </li>




    //         </ul>
    //     </div>
    // </nav>';
    ?>




    <div class="container mt-4" id="div1">
        <h3>Please Login Here:</h3>
        <hr>
        <?php
        if (isset($_SESSION['successMsg'])) {

        ?>
            <p style="color: green;"><?php echo $_SESSION['successMsg']; ?></p>

        <?php
            unset($_SESSION['successMsg']);
        }
        if (isset($_SESSION['errorMsg'])) {
        ?>
            <p style="color:red;"><?php echo $_SESSION['errorMsg']; ?></p>
        <?php
            unset($_SESSION['errorMsg']);
        }



        ?>

        <form action="?" method="post">
            <div class="form-group">
                <label for="exampleInputusername1">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputusername1" aria-describedby="emailHelp" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Reminder Now</label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='forget_password.php'">Forget Password</button>
            <p class="login-register-text">Don't have an account ? <a href="register.php">Register Here</a></p>

        </form>



    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>