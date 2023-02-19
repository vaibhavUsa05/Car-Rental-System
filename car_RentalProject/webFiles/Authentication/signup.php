<?php include '../connDB.php'?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assests/authentication.css">
    <title>CarHireHub.com/login</title>
  </head>
  <body>


<!--form for the users only  -->
<h3 class="heading">New User Signup Now</h3>
  <form method="POST" class="form" style="width:90%;">
    <!-- add some jumbotraon for error handling else redirect to login page -->
    <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputText1"  placeholder="Enter your username" required>
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<div class="redirect"><a href="./login.php">Already have an Account?</a></div>
<?php
if(isset($_POST["submit"])){
$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$sql="SELECT * FROM `users` WHERE (`EMAIL`='$email' && `PASSWORD`='$password') || `USERNAME`='$username'";
$searchResult=mysqli_query($conn,$sql);
$num=mysqli_num_rows($searchResult);
try{
if($num==0){
  
$sql="INSERT INTO `users`(`EMAIL`, `PASSWORD`,`USERNAME`) VALUES ('$email','$password','$username')";
$res=mysqli_query($conn,$sql);
if($res){
  //   echo'<div class="jumbotron jumbotron-fluid alertJumpbotron">
  //   <div class="container">
  //     <h1 class="display-4">Data inserted successfully</h1>
  //     <p class="lead">Congratulations user your account is been created!!!</p>
  //   </div>
  // </div>';
    header("location:./login.php");
  }}
  else{
    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong> The credentials you entered already exist</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
}catch(Exception $e){
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Oops seems like there has some error occured. Try Again !!'.$e->getMessage().'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
}
?>





  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</html>