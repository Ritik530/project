session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
}

if (isset($_REQUEST['submit'])) {
    $image = $_FILES['image']['name'];
    // $username = $_REQUEST['username'];
    // $fullname = $_REQUEST['fullname'];
    // $dob = $_REQUEST['dob'];
    // $gender = $_REQUEST['gender'];
    // $email = $_REQUEST['email'];
    // // $password = $_REQUEST['password'];
    // $phone = $_REQUEST['phone'];
    // $address = $_REQUEST['address'];
    // $city = $_REQUEST['city'];
    // $state = $_REQUEST['state'];
    // $zip = $_REQUEST['zip'];

    // $userId = $_SESSION['loggedin'];



    // if (!empty($username) && !empty($fullname) && !empty($dob) && !empty($gender) && !empty($email) && !empty($phone) && !empty($address) && !empty($city) && !empty($state) && !empty($zip)) {
    $userId = $_SESSION['loggedin'];
    echo "hhhh";
    // $up = mysqli_query($conn, "UPDATE `users`( `fullname`, `dob`, `gender`, `email`, `phone`, `address`, `state`, `city`, `zip`) SET ('fullname'='$fullname', 'dob' = '$dob', 'gender'='$gender','email'='$email', 'phone'='$phone','address'='$address', 'city'='$city','state'='$state','zip'='$zip' WHERE `id` = '$userId' )");
    // $up = mysqli_query($conn, "UPDATE `users` SET 'fullname'='$fullname', 'dob' = '$dob', 'gender'='$gender','email'='$email', 'phone'='$phone','address'='$address', 'city'='$city','state'='$state','zip'='$zip' WHERE `id` = '$userId' ");
    // $_SESSION['successMsg'] = "Profile has been updated";

    // echo "wwwwww";
}
if (!empty($image)) {
    $tmpName = $_FILES['image']['tmp_name'];
    $uploadDir = "image/";
    move_uploaded_file($tmpName, $uploadDir . $image);
    $up = mysqli_query($conn, "UPDATE `users` SET 'image' ='$image' Where 'image' = '$image' ");
} else {
    $_SESSION['errorMsg'] = "all fields are required";
}
// }
echo "sadjajsdk";

// $userId = $_SESSION['loggedin'];
// $getdate = mysqli_query($conn, "SELECT *FROM `users` Where `id` = " ;);
// $row = mysqli_fetch_assoc($getdate);
//
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






div class="form-group col-md">
                    <label for="inputusername4">Username</label>
                    <input type="text" value="<?php echo $row['username']; ?>" class="form-control" name="username" id="inputusername4" placeholder="username" required>

                </div>
                <div class="form-group col-md">
                    <label for="inputfullname4">Full Name</label>
                    <input type="text" value="<?php echo $row['fullname']; ?>" class="form-control" name="fullname" id="inputfullname4" placeholder="Full Name" required>
                </div>
                <div class="form-group col-md">
                    <label for="inputdate4" class="form-label">Date-Of-Birth</label>
                    <input type="text" value="<?php echo $row['dob'];  ?>" class="form-control" name="dob" id="inputdateofbirth4" placeholder="DD/MM/YYYY" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
                </div>
                <div class="form-group col-md">
                    <label for="inputgender">Gender</label>
                    <select id="inputgender" class="form-control" name="gender">
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <div class="form-group col-md">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" value="<?php echo $row['email']; ?>" class="form-control" name="email" id="inputEmail4" placeholder="email">
                </div>
            </div>
            <div class="form-group col-md-4 ">
                <label for="inputphonenumber4">Phone Number</label>
                <input type="text" value="<?php echo $row['phone']; ?>" class="form-control" name="phone" id="inputphonenumber4" placeholder="Phone number">
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress2">Address</label>
                <input type="text" value="<?php echo $row['address']; ?>" class="form-control" name="address" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-group col-md-4">
                    <label for="inputCity">City</label>
                    <input type="text" value="<?php echo $row['city'];  ?>" class="form-control" name="city" id="inputCity" placeholder="Enter city">
                </div>
            
               
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="state">
                        <option>Choose...</option>
                        <option>uttar pradesh</option>
                        <option>uttarakhand</option>
                    </select>
     
                <div class="form-group col-md-4">
                    <label for="inputZip">Zip Code</label>
                    <input type="text" value="<?php echo $row['zip']; ?>" class="form-control" name="zip" id="inputZip">
                </div>

            </div>


            <?php
// $showAlert = false;
// $showError = false;
require_once "partical/_databconnect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } 
    else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } 
            else {
                echo "Something went wrong";
            }
        }
    }

    


    // Check password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for confirmpassword 
    if (trim($_POST['password']) !=  trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }


    // there were no errors, go a head and insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        // $showAlert = true;
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // $showAlert = true;

            // Setparameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // execute  query
            if (mysqli_stmt_execute($stmt)) {


                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
                // $showError = "Password do not match";
            }
        }
        mysqli_stmt_close($stmt);
    }
    //  else {
    //     $showError = "Password do not match";
    // }
    mysqli_close($conn);
}

?>



login 
$username = $email =  $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        // $err = "Please enter username + password";
        $_SESSION['errorMsg'] = "Please enter the right username and password";
    } else {
        $username = trim($_POST['username']);
        
        $password = trim($_POST['password']);
    }


    if (empty($err)) {
        // $password = md5($password);

        $sql = "SELECT  username, password FROM users WHERE username = '$username'  AND password = '$password'";
        $stmt = mysqli_query($conn, $sql);
       
        if (mysqli_num_rows($stmt) == 1) {
            
            if (mysqli_fetch_assoc($stmt)) {
                // 
                if ($password != "" && $username != "") {
                    // this means the password is corrct. Allow user to login
                    session_start();
                    $_SESSION["username"] = $username;
                   
                    $_SESSION["id"] = $id;
                    $_SESSION["loggedin"] = true;

                    //Redirect user to nextpage
                    header("location: dashboard.php");
            
                }
                
            }
        }
        else{
            $_SESSION['errorMsg'] = "Please enter the right username and password";
        }
        
    }
}



if(isset($_REQUEST['submit'])){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $sql = mysqli_query($conn , "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
    $row = mysqli_num_rows($sql);

    if($row >0){
        $_SESSION['successMsg'] = "Welcome";
        header("location: dashboard.php");
        exit;
    }
    else{
        $_SESSION['errorMsg'] = "invalid";
        header("location: login.php");
        exit;
    }
}