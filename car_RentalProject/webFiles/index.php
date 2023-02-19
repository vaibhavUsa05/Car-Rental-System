<?php  include './connDB.php';
session_start();
?>
<!doctype html> 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                  <!-- custom css  -->
    <link rel="stylesheet" href="../assests/index.css">
    <title>CarHireHub.com</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">CarHireHub</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navbar-container" id="navbarNavDropdown">
    <ul class="navbar-nav navbar-list" >
      <li class="nav-item active host" >
        <a class="nav-link" href="./Authentication/signup_admin.php">Become a Host<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
       
      <div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Login
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="./Authentication/login.php">Login As User</a>
    <a class="dropdown-item" href="./Authentication/admin.php">Login As a Host</a>
  </div>
</div>


      </li>
      <li class="nav-item">
        <a class="nav-link" href="./Authentication/signup.php">SIGNUP</a>
      </li>
    </ul>
  </div>
</nav>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="../img/front_carImages.jpg" alt="carImage">
    </div>
  </div>
<!-- adding the text message -->
<div class="jumbotron jumbotron-fluid jumbotron-navbar">
  <div class="container">
    <h1 class="display-4">Want To Rent a Car</h1>
    <p class="lead">Unlock your journey with our unbeatable car rental options</p>
  </div>
</div>
</div>

<!-- Display of all cars available -->
<?php
$sql = "SELECT * FROM `warehouse`";
$res = mysqli_query($conn, $sql);
$num=mysqli_num_rows($res);
if($num>0){
  $popUp=0;
while ($row = mysqli_fetch_assoc($res)){
?>

<form  method="post">
  <div class="card" style="width: 80%; margin:auto;margin-top:5%;">
    <img class="card-img-top" src="<?php echo "../img/car_1.jpg" ?>" alt="Card image cap">
    <div class="card-body">
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Vehicle Model : <?php echo $row["VEHICLE_MODEL"]; ?> </li>
    <li class="list-group-item">Vehicle Number : <?php echo $row["VEHICLE_NUMBER"]; ?></li>
    <li class="list-group-item">Seating Capacity : <?php echo $row["SEATING_CAPACITY"]; ?></li>
    <li class="list-group-item">Rent per Day: <?php  echo $row["RENT_PER_DAY"]; ?></li>
    <div class="card-body">
<button type="submit" name ="book" class="btn btn-success">Book Now</button>
</ul>
      </div>
  </div>
      </form>
    <?php
if(isset($_POST["book"])){
  
  if($popUp<1){
    $popUp++;
  try{
    // If the user is not logged in or if user is a part of the organisation itself
    if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && isset($_SESSION['companyName'])) || (isset($_SESSION['companyName'])) ){
      echo'<div class="alert alert-warning alert-dismissible fade show popup" role="alert">
    <strong>Either you are an agent or not logged in</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    }
else{
    $sessionUser= $_SESSION["username"];
    $vehicleName=$row["VEHICLE_MODEL"];
    $vehicleNumber=$row["VEHICLE_NUMBER"];
    $sessionEmail=$_SESSION["email"];
    $companyName=$row["Company_Name"];
    $sql="INSERT INTO `bookingdata`(`Company_Name`,`VEHICLE_MODEL`, `VEHICLE_NUMBER`, `USERNAME`, `USER_EMAIL`) VALUES ('$companyName','$vehicleName','$vehicleNumber','$sessionUser','$sessionEmail')";
    $add=mysqli_query($conn,$sql); // give different name other than $res else error would come
      echo'<div class="alert alert-success alert-dismissible fade show popup" role="alert">
    <strong>Congratulations your car is booked now</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
 // some sort of srver side error 
  }catch(Exception $e){
    echo'<div class="alert alert-warning alert-dismissible fade show popup" role="alert">
    <strong>Oops seems like  some error occurrred try again after sometime. You can first login if not.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
    }
  }
  }?>
<?php } }?>

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>