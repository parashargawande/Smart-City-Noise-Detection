 <?php
$servername = "localhost";
$username = "par";
$password = "pargaw";


echo "start";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 