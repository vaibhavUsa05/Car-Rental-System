<?php include '../webFiles/connDB.php';
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
    <link rel="stylesheet" href="../assests/createProduct.css">
    <title>CarHireHub.com/login</title>
  </head>
  <body>


<!--form for the users only  -->
<h3 class="headingBold">DashBoard</h3>
 
<?php
$sql="SELECT * FROM `bookingdata` WHERE `Company_Name`='".$_SESSION["companyName"]."' " ;
$searchResult=mysqli_query($conn,$sql);
$num=mysqli_num_rows($searchResult);
try{
if($num>0){
while($row=mysqli_fetch_assoc($searchResult)){
  echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Customer Email</th>
      <th scope="col">Vehicle Model</th>
      <th scope="col">Vehicle Number</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">'.$row["S.NO"].'</td>
      <td>'.$row["USERNAME"].'</td>
      <td>'.$row["USER_EMAIL"].'</td>
      <td>'.$row["VEHICLE_MODEL"].'</td>
      <td>'.$row["VEHICLE_NUMBER"].'</td>
    </tr>
  </tbody>
</table>';
}
}
else{
  echo'<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">No Data To Display</h1>
    <p class="lead">Currently no bookings are there for the cars</p>
  </div>
</div>';
}}catch(Exception $e){
echo'<div class="alert alert-info" role="alert">
<div class="container">
  <h1 class="display-4">Oops seems like there has some error occured. Try Again !!</h1>
</div>';
}
?>

    </body>

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src=""></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
</html>