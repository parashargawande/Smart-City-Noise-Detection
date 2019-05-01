<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ERROR | E_PARSE);
$id="node1";
$servername = "localhost";
$username = "username";
$password = "pargaw";
$dbname = "id5193425_esp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    //echo "---------------<br>connected to db<br>";
}

$query = "select * from ".$id;
$data = mysqli_query($conn, $query);
$dataPoints = array();
while ($row = $data->fetch_assoc()) {
     echo $row["timestamp"];
    // $sec=$row["x"];
    // $min=$sec/60;
    // $hr=$min/60;
    // $minpart=$min%60;
    // $row["x"]=intval($hr)*100+$minpart;
    array_push($dataPoints, $row);
}
?>
