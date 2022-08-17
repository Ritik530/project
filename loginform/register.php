<?php
// require_once "partical/_databconnect>.php";
session_start();
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
    $fullname = $_REQUEST['fullname'];
    $dob = $_REQUEST["dob"];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $regOn = date('y-m-d H:i:s');

    $getData = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'");
    $rowCount = mysqli_num_rows($getData);
    if (trim($_REQUEST['password']) !=  trim($_REQUEST['confirm_password'])) {
        $_SESSION['errorMsg'] = "password does not match";
    } elseif ($rowCount > 0) {
        if ($row = $getData->fetch_assoc()) {
            $uname = $row['username'];
            $mail = $row['email'];

            if ($username == $uname) {
                $_SESSION['errorMsg'] = "username is already regsitered";
            } elseif ($email == $mail) {
                $_SESSION['errorMsg'] = "email is already regsitered";
            } else {
                $_SESSION['errorMsg'] = "";
            }
        }




        // $_SESSION['errorMsg'] = "email is already regsitered";
    } else {
        // $password = md5($password);
        $_query = mysqli_query($conn, "INSERT INTO `users`( `username`, `fullname`, `dob`, `gender`, `email`, `password`, `phone`, `address`, `city`, `state`, `zip`, `registered_on`) VALUES ('$username','$fullname','$dob','$gender','$email','$password','$phone','$address','$city','$state','$zip','$regOn')");
        $_SESSION['successMsg'] = "Registered Succcessfully";
        header("location: login.php");
    }
} else {
    $_SESSION['errorMsg'] = ("Please submit the form");
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trignosoft!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <style>
        body {
            background-image: url(img.jpg);
            background-size: cover;
            background-attachment: local;
        }

        .container {
            background-color: white;
            width: 50%;
            padding: 40px;
            margin: 100px auto;

        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
    //         <li class="nav-item">
    //                 <a class="nav-link" href="login.php">Login</a>
    //             </li>
    //             <li class="nav-item">
    //                 <a class="nav-link" href="register.php">Register</a>
    //             </li>





    //         </ul>
    //     </div>
    // </nav>';
    ?>

    <div class="container md-4" id="div1">
        <h2>Please Register Here: </h2>
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
        <form class="form-col" action="" name="registerform" method="post">
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputusername4">Username</label>
                    <input type="text" class="form-control" name="username" id="inputusername4" placeholder="username" required>

                </div>
                <div class="form-group col-md-6">
                    <label for="inputfullname4">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="inputfullname4" placeholder="fullname" required>

                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputgender">Gender</label>
                    <select id="inputgender" class="form-control" name="gender" required>
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputdate4" class="form-label">Date-Of-Birth</label>
                    <input type="text" class="form-control" name="dob" id="inputdateofbirth4" placeholder="DD/MM/YYYY" required>
                </div>


                <div class="form-group col-md-6 ">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="inputPassword4">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="Confirm Password">
                </div>
            </div>

            <div class="form-group ">
                <label for="inputphonenumber4">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="inputphonenumber4" placeholder="Phone number" required>
            </div>


            <div class="form-group">
                <label for="inputAddress2">Address</label>
                <input type="text" class="form-control" name="address" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" name="city" id="inputCity" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="state">
                        <option selected>Choose...</option>
                        <option>uttar pradesh</option>
                        <option>uttarakhand</option>
                    </select>
                </div>
                <!-- <div class="form-group col-md-4">
                    <label for="validationServer04" class="form-label">State</label>
                    <select class="form-select is-invalid" id="validationServer04" aria-describedby="validationServer04Feedback" required>
                        <option selected disabled value="">Choose...</option>
                        <option>uttar pradesh</option>
                    </select>
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div> -->
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip Code</label>
                    <input type="text" class="form-control" name="zip" id="inputZip">
                </div>

            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Remider Now
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a></p>
        </form>

    </div>

</body>

</html>