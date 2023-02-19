<?php
$servername="localhost";
$username="root";
$password="";
$database="carrental";
$conn=mysqli_connect($servername,$username,$password,$database);
if($conn){
    // echo"the connection to the databse is established";
}
else{
    echo"error in connection to the database".mysqli_connect_error();
}











?>