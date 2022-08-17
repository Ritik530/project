<?php
// require_once "partical/_databconnect>.php";
$username  =$dob=$gender= $email= $password = $confirm_password = $phone=$address=$city=$state=$zip = "";
$username_err =$dob_err= $gender_err=$password_err = $confirm_password_err =$phone_err=$address_err=$city_err=$state_err=$zip_err = "";
$host = "localhost";
$user = "root";
$password = "";
$db_name = "loginform";

$conn = mysqli_connect($host, $user, $password, $db_name);
if (mysqli_connect_errno()) {
    die("database not connected");
} else {
    echo "success connect";

    // if (isset($_POST['submit'])) {
    //     $username = $_REQUEST['username'];
    //     $dob = $_REQUEST["dateofbirth"];
    //     $gender = $_REQUEST['gender'];
    //     $email = $_REQUEST['email'];
    //     $password = $_REQUEST['password'];
    //     $phone = $_REQUEST['phonenumber'];
    //     $address = $_REQUEST['address'];
    //     $city = $_REQUEST['city'];
    //     $state = $_REQUEST['state'];
    //     $zip = $_REQUEST['zip_code'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if username is empty
        if (empty(trim($_POST["username"]))) {
            $username_err = "Username cannot be blank";
        } else {
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set the value of param username
                $param_username = trim($_POST['username']);

                // Try to execute this statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken";
                    } else {
                        $username = trim($_POST['username']);
                    }
                } else {
                    echo "Something went wrong";
                }
            }
        }
        //username check end

        mysqli_stmt_close($stmt);
        //email start
        if (empty(trim($_POST['email']))) {
            $email_err = "email cannot be blank";
        } else {
            $email = trim($_POST["email"]);
        }
        //email check end

        // Check for password
        if (empty(trim($_POST['password']))) {
            $password_err = "Password cannot be blank";
        } elseif (strlen(trim($_POST['password'])) < 5) {
            $password_err = "Password cannot be less than 5 characters";
        } else {
            $password = trim($_POST['password']);
        }
        //check password end

        // Check for confirm password field
        if (trim($_POST['password']) !=  trim($_POST['confirm_password'])) {
            $password_err = "Passwords should match";
        }
        //check confirm password end


        $sql = "INSERT INTO users VALUES ('$username','$dob','$gender','$email','$password','$phone','$address','$city','$state','$zip')";
        $stmt = mysqli_query($conn, $sql);
        // if ($stmt) {
            //     mysqli_stmt_bind_param($stmt);

            //     // Set these parameters
            //     $param_username = $username;
            //     $param_password = $password;
            //     $param_email = $email;


            //  }
            // Try to execute the query
            if(mysqli_query($conn, $sql))
            // if (mysqli_fetch_assoc($stmt))
             {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        // }
        echo "successed entered";
    }
}
// mysqli_stmt_close($stmt);
mysqli_close($conn);
?>





<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <title>Trignosoft!</title>
</head>

<body>
    <?php
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LoginSystem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact As</a>
                </li>

            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>




            </ul>
        </div>
    </nav>';
    ?>




    <div class="container mt-4">
        <h3>Please Register Here:</h3>
        <hr>
        <form class="form-col" action="" method="post">
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputusernamel4">Username</label>
                    <input type="text" class="form-control" name="username" id="inputusername4" placeholder="username">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputgender">Gender</label>
                    <select id="inputgender" class="form-control" name="gender">
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputdate4" class="form-label">Date-Of-Birth</label>
                    <input type="date-local" class="form-control" name="dateofbirth" id="inputdateofbirth4" placeholder="DD/MM/YYYY">
                </div>


                <div class="form-group col-md-6 ">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="inputPassword4">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="Confirm Password">
                </div>
            </div>

            <div class="form-group ">
                <label for="inputphonenumber4">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" id="inputphonenumber4" placeholder="Phone number">
            </div>


            <div class="form-group">
                <label for="inputAddress2">Address</label>
                <input type="text" class="form-control" name="address" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" name="city" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="state">
                        <option selected>Choose...</option>
                        <option>uttar pradesh</option>
                        <option>uttarakhand</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip Code</label>
                    <input type="text" class="form-control" name="zip_code" id="inputZip">
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
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>