<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "erhub";

// Create a connection
$conn = mysqli_connect($servername,$username, $password, $database);

// Die if connection was not successful
if (!$conn) {
die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
// echo "
// <script>
    // alert('succesfull!');
    // 
//<script>
// ";
}
?>