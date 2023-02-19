<?php include'../webfiles/connDB.php';
session_start();
// if(!$_SESSION["companyName"]){
//   header("location:../webFiles/Authentication/admin.php");
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../assests/createProduct.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <h4 class="greetingAgency">HELLO<?php echo " ".$_SESSION["companyName"] ?><h4>
      
<a href="./dashboard.php" class="link-success dashboard">View DashBoard</a>
    <h1 class="heading">ADD new Cars</h1>
    <form method="POST" class="form" enctype="multipart/form-data">
    <input class="form-control " name="vehicle_model" type="text" placeholder="Vehicle Model" required>
    <input class="form-control form-control-lg" name="vehicle_number" type="number"  min="0"placeholder="Vehicle Number" required>
    <input class="form-control form-control-lg" name="seating_capacity" type="number" min="0" placeholder="Seating Capacity" required>
    <input class="form-control form-control-lg" name="rent_per_day" type="number"  min="0"placeholder="Rent per Day(in $)" required>
    <input class="form-control form-control-lg" name="number_of_days" type="number"  min="0"placeholder="Number of Days" required>
  <div class="form-group">
    <label for="exampleFormControlFile1">Insert the Car Image</label>
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
    <button type="submit" name="submit" class="btn btn-primary ">Submit</button>
</form>

<?php
if(isset($_POST["submit"])){
$vehicleModel=$_POST["vehicle_model"];
$vehicleNumber=$_POST["vehicle_number"];
$seatingCapacity=$_POST["seating_capacity"];
$rentPerDay=$_POST["rent_per_day"];
$numberOfDays=$_POST["number_of_days"];
$file_name = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$file_type = $_FILES['file']['type'];
$file_size = $_FILES['file']['size'];
$file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));

// Allowed file extensions
$allowed_ext = array("jpeg", "png", "jpg", "txt");

if(in_array($file_ext, $allowed_ext) && $file_size < 500000){
    // Set upload directory path
    $upload_dir = "uploads/";
    
    // Set the file destination
    $destination = $upload_dir . $file_name;
    
    // Move the uploaded file to the specified destination
    if(move_uploaded_file($file_tmp, $destination)){
        echo "File uploaded successfully.";
    } else{
        echo "File upload failed, please try again.";
    }
} else{
    echo "Invalid file format or size too large.";
}
try{
  $sql = "INSERT INTO `warehouse`(`Company_Name`, `VEHICLE_MODEL`, `VEHICLE_NUMBER`, `SEATING_CAPACITY`, `RENT_PER_DAY`, `NUMBER_OF_DAYS`,`IMAGE`) VALUES ('{$_SESSION['companyName']}', '$vehicleModel', '$vehicleNumber', '$seatingCapacity', '$rentPerDay', '$numberOfDays','$destination')";
  $res = mysqli_query($conn, $sql);
  header('location: ../webFiles/index.php?companyName=' . $_SESSION['companyName']);
  
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
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</html>