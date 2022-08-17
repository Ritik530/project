<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
}



$host = "localhost";
$userName = "root";
$password = "";
$db_name = "login";

$conn = mysqli_connect($host, $userName, $password, $db_name);
if (mysqli_connect_errno()) {
    die("database not connected");
} 

if (isset($_POST['submit'])) {
    // $username = $_REQUEST['username'];
    $fullname = $_REQUEST['fullname'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];
    $image = $_FILES['image']['name'];
    





    if (!empty($fullname) && !empty($dob) && !empty($gender) && !empty($email) && !empty($phone) && !empty($address) && !empty($city) && !empty($state) && !empty($zip)) {
        $userId = $_SESSION['username'];

        $up = mysqli_query($conn, "UPDATE users SET fullname='$fullname', dob = '$dob', gender='$gender',email='$email', phone='$phone',address='$address', city='$city',state='$state',zip='$zip' WHERE username = '$userId'");
        $_SESSION['successMsg'] = "Profile has been updated";
        header("location: dashboard.php");

        if (!empty($image)) {


            $tmpname = $_FILES['image']['tmp_name'];

            $uploadDir = "images/";
            move_uploaded_file($tmpname, $uploadDir . $image);
            $up = mysqli_query($conn, "UPDATE users SET image = '$image' WHERE username = '$userId'");
        }
    } else {
        $_SESSION['errorMsg'] = "Profile has not been updated";
    }
} else {
    $_SESSION['errorMsg'] = "all fields are required";
}


$userId = $_SESSION['username'];
$getdate = mysqli_query($conn, "SELECT *FROM `users` Where username = '$userId'");
$row = mysqli_fetch_assoc($getdate);


?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylee.css">
    <style>
        body {
            background-image: url(image1.jpg);
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            background-color: white;
            width: 50%;
            padding: 40px;
            margin: 100px auto;
        }

        #div1 {
            width: 50%;
            padding: 40px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <title>Trignosoft!</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LoginSystem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mi-auto" id="navbarNavDropdown">
        </div>
        <li class="nav-item dropdown  ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images/<?php echo $row['image']; ?>" alt="" height="40" class="rounded-circle border"><?php echo "Welcome " . $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>

        </li>

        </ul>
        </li>

    </nav>


    <div class="container mt-4" id="div1">
        <h3>Upadte your profile:</h3>
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
        <form class="form-col-md" action="" method="post" enctype="multipart/form-data">

            <!-- <div class="col-md"> -->

                <div class="form-floating mt-1 col-6">
                    <img src="images/<?php echo $row['image']; ?>" class="img-thumbnail my-3" style="height:150px;" alt="...">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change Profile Picture</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>



                <div class="form-group col-md">
                    <label for="inputfullname4">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="inputfullname4" placeholder="Full Name" value="<?php echo $row['fullname']; ?>" required>
                </div>
                <div class="form-group col-md">
                    <label for="inputdate4" class="form-label">Date-Of-Birth</label>
                    <input type="text" class="form-control" name="dob" id="inputdateofbirth4" placeholder="DD/MM/YYYY" value="<?php echo $row['dob']; ?>" required>
                </div>
                <div class="form-group col-md">
                    <label for="inputgender4" class="form-label">Gender</label>
                    <input type="text" class="form-control" name="gender" id="inputdateofbirth4" placeholder="gender" value="<?php echo $row['gender']; ?>" required>
                </div>

                <!-- <div class="form-group col-md">
                    <label for="inputgender">Gender</label>
                    <select id="inputgender" class="form-control" name="gender">
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div> -->

                <div class="form-group col-md">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="email" value="<?php echo $row['email']; ?>">
                </div>
                <!-- </div> -->
                <div class="form-group col-md ">
                    <label for="inputphonenumber4">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="inputphonenumber4" placeholder="Phone number" value="<?php echo $row['phone']; ?>">
                </div>
                <div class="form-group col-md">
                    <label for="inputAddress2">Address</label>
                    <input type="text" class="form-control" name="address" id="inputAddress2" placeholder="Apartment, studio, or floor" value="<?php echo $row['address']; ?>">
                </div>
                <div class="form-group col-md">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" name="city" id="inputCity" placeholder="Enter city" value="<?php echo $row['city']; ?>">
                </div>


                <!-- <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control" name="state">
                    <option>Choose...</option>
                    <option>uttar pradesh</option>
                    <option>uttarakhand</option>
                </select> -->
                <div class="form-group col-md">
                    <label for="inputstate4" class="form-label">State</label>
                    <input type="text" class="form-control" name="state" id="inputstate4" placeholder="state" value="<?php echo $row['state']; ?>" required>
                </div>

                <div class="form-group col-md">
                    <label for="inputZip">Zip Code</label>
                    <input type="text" class="form-control" name="zip" id="inputZip" placeholder="Enter Zip code" value="<?php echo $row['zip']; ?>">
                </div>

                <!-- </div> -->




                 <br>

                <button type="submit" class="btn btn-primary" name="submit">Done</button>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>