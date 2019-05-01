<?php include 'header.php'; ?>
<?php //include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<?php 
error_reporting(E_ERROR | E_PARSE);
$id=$_REQUEST['id'];
$servername = "localhost";
$username = "par";
$password = "pargaw";
$dbname = "esp";

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
    //echo $row["x"];
    array_push($dataPoints, $row);
}
?>
<h1>node data <?php echo $id;  ?></h1>
<div id="chartContainer"></div>

<script type="text/javascript">
$(function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: ""
        },
        data: [
        {
            type: "line",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
});
</script>