<?php include '../header.php'; ?>
<?php include '../content.php'; ?>
<h1>Render Data From Database</h1>
<?php 
error_reporting(E_ERROR | E_PARSE);
$id="node1";
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
    // echo $row["x"];
    // $sec=$row["x"];
    // $min=$sec/60;
    // $hr=$min/60;
    // $minpart=$min%60;
    // $row["x"]=intval($hr)*100+$minpart;
    array_push($dataPoints, $row);
}
?>
<div id="chartContainer" style="height: 370px; max-width: 95%; margin: 0px auto;"></div>

<script>
window.onload = function() {
var dps = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
var dps1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: false,
    zoomEnabled: true,
    title: {
        text: "Sound level"
    },
    axisX: {
        title: "Time"
    },
    axisY: {
        title: "DB Values",
        suffix: "DB"
    },
    data: [{
        type: "line",
        name: "node1",
        connectNullData: true,
        //nullDataLineDashType: "solid",
        xValueType: "dateTime",
        xValueFormatString: "DD MMM hh:mm TT",
        yValueFormatString: "#,##0.##' DB'",
        dataPoints: dps
    },
    ]
});
chart.render();

}
</script>

<?php include '../footer.php'; ?>
