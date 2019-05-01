<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script>
  // Initialize Firebase
  //insert proper config info
var config = {
    apiKey: "your api key",
    authDomain: "esp8266-5608d.firebaseapp.com",
    databaseURL: "https://esp8266-5608d.firebaseio.com",
    projectId: "esp8266-5608d",
    storageBucket: "esp8266-5608d.appspot.com",
    messagingSenderId: "794975108678"
  };
  firebase.initializeApp(config);

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    var displayName = user.displayName;
    var email = user.email;
    var emailVerified = user.emailVerified;
    var photoURL = user.photoURL;
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    var providerData = user.providerData;
 //   alert("user logged in");
//    window.location.replace("index.php");
  } else {
     alert("user logged out");
     window.location.replace("index.php");
  }
});

function signout()
{
 // alert("signout pressed");
  firebase.auth().signOut();
}

</script>

<?php include 'header.php'; ?>

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

$query = "select x,y from ".$id;
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
<div id="chartContainer"></div>

<script type="text/javascript">
$(function () {
  var dps = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;   //dataPoints.
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Line Chart with Data-Points from DataBase"
        },
        data: [
        {
            type: "line",
            dataPoints: dps
        }
        ]
    });
    chart.render();

   
});
</script>

<?php include 'footer.php'; ?>