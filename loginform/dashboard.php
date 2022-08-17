<?php

session_start();
$host = "localhost";
$userName = "root";
$password = "";
$db_name = "login";

$conn = mysqli_connect($host, $userName, $password, $db_name);
if (mysqli_connect_errno()) {
    die("database not connected");
} 
// || $_SESSION['loggedin'] !== true
if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
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
    <link rel="stylesheet" href="style.css">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <style>
    
    </style>
    <title>Trignosoft!</title>
</head>

<body>
   

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LoginSystem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mi-auto" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                
                
            </ul>


        </div>
        
        <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/<?php echo $row['image']; ?>" alt="" height="40" class="rounded-circle border"> <?php echo "Welcome " . $_SESSION['username'];?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                    </ul>
                </li>
        <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
    </nav>


    <div class="container mr">
        <h3><?php echo "Welcome " . $_SESSION['username'] ?>! You can now use this website</h3>
        <hr>

    </div>



    <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="1.jpg" class="d-block w-100" alt="sun">
            </div>
            <div class="carousel-item">
                <img src="3.jpg" class="d-block w-100" alt="s">
            </div>
            <div class="carousel-item">
                <img src="2.jpeg" class="d-block w-100" alt="su">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->
    <iframe width="560" height="315" src="https://www.youtube.com/embed/sCbbMZ-q4-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <!-- <video src="HTML_Tutorial_For_Beginners_In_Hindi_(With_Notes)_🔥(2K).webm" autoplay controls width="470px"></video> -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>