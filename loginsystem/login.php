<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'partical/_databconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select*from users where username = '$username' AND password ='$password'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $login = true;
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("location: nextpage.php");
  } else {
    $showError = "Invalid Credentials";
  }
}

?>


<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Login</title>
</head>

<body>
  <?php require 'partical/_nav.php' ?>
  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are log in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <samp aria-hidden="true">&times;</samp>
        </button>
    </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <samp aria-hidden="true">&times;</samp>
            </button>
        </div>';
  }
  ?>

  <div class="container mt-4">
    <h3> Login this website</h3>
    <hr>
    <form class="row g-10" action="/loginsystem/login.php" method="post">
      <div class="row g-3">
        <div class="col">
          <label for="inputEmail4" class="form-label">username</label>
          <input type="text" class="form-control" name="username" placeholder="username">
        </div>
      </div>

      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">password</label>
        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="password">
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
        <button type="submit" class="btn btn-primary" href="">login</button>
      </div>
    </form>
  </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  
</body>

</html>