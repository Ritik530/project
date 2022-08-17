<?php
require_once "partical/_databconnect>.php";

$username = $dob = $gender =  $email = $password = $confirm_password = $phonenumber = "";
$username_err =  $dob_err = $gender_err =  $email_err  = $password_err = $confirm_password_err = $phonenumber_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
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

    mysqli_stmt_close($stmt);
    echo"dd";

    if (empty(trim($_POST['email']))) {
        $email_err = "email cannot be blank";
    }  else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
    }

    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for confirm password field
    if (trim($_POST['password']) !=  trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }
    echo"ddd";


    // If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email))
    // if(isset($_POST['Sign in']))
    {
        // $username=data_funct($_REQUEST['username']);
        // $dob=data_funct($_REQUEST['dateofbirth']);
        // $gender=data_funct($_REQUEST['gender']);

        // $email=data_funct($_REQUEST['email']);
        // $passowd=data_funct($_REQUEST['passowd']);
        // $phonenumber=data_funct($_REQUEST['phonenumber']);
        echo"dd";

        $sql = "INSERT INTO users (username, password,email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set these parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            // $param_email = $email;
            // echo"wdddew";


            // Try to execute the query
            if (mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } 
            else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>

<!-- login -->
<?php
// $loginn = false;
// $showError = false;
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: dashboard.php");
    exit;
}
// require_once "partical/_databconnect.php";
$host="localhost";
$user="root";
$password="";
$db_name="login";

$conn=mysqli_connect($host,$user,$password,$db_name);
if (mysqli_connect_errno()) 
    {
     die ("database not connected");
    }
    else
    {
        echo "success connect";
    }

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    // $password = md5($password);
   
    $sql = "SELECT  username, password FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = mysqli_query($conn, $sql);
    // if($stmt){
    // mysqli_stmt_bind_param($results, "s", $param_username);
    // $param_username = $username;
    
    
    // Try to execute this statement
    // if(mysqli_($stmt)){
    //     mysqli_num_result($stmt);
        if(mysqli_num_rows($stmt) == 1)
                {
                    // mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_fetch_assoc($stmt))
                    {
                        // 
                        if ($password != "" && $username != "")
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            // $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to nextpage
                            header("location: dashboard.php");
                            
                        }
                    }

                }

    }
}    





?>
