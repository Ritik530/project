<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partical/_databconnect.php';
$username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $exists = false;
    if (($password == $confirmpassword) && $exists == false) {
        $sql = "INSERT INTO `users` (`username`, `password`, `time`) VALUES ('$username', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
    } 
    else{
        $showError = "password do not match";
        
    }
}
?>






<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SignUp</title>
</head>

<body>
    <!-- <style>
        body{
            background-image: url(../ritik.jpeg);
        }
    </style> -->
    <?php require 'partical/_nav.php' ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You account is created and can login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <samp aria-hidden="true">&times;</samp>
        </button>
    </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <samp aria-hidden="true">&times;</samp>
            </button>
        </div>';
    }
    ?>

    <div class="container mt-4">
        <h3> Signin this website</h3>
        <hr>
        <form class="row g-3" action="/loginsystem/signup.php" method="post">
            <div class="row g-3">
                <div class="col">
                    <label for="inputEmail4" class="form-label">username</label>
                    <input type="text" class="form-control" name="username" placeholder="username">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="Email" id="inputEmail4" placeholder="Email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">password</label>
                <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="password">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">confirmpassword</label>
                <input type="password" class="form-control" name="confirmpassword" id="inputPassword" placeholder="confirmpassword">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" name="Address" id="inputAddress" placeholder="Permanent Address">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" name="Address 2" id="inputAddress2" placeholder="Address">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" name="City" id="inputCity" placeholder="City">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>

                <select id="inputState" class="form-select" name="state">
                    <option selected>Choose...</option>
                    <option>Uttar Pradesh</option>
                    <option>Uttarakhand</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Reminder Now
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>