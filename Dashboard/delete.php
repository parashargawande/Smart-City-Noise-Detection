<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "username";
$password = "pargaw";
$dbname = "id5193425_esp";
$id = $_REQUEST['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    //echo "---------------<br>connected to db<br>";
}

$query = "delete from ".$id;
$data = mysqli_query($conn, $query);
echo "database cleared";
?>