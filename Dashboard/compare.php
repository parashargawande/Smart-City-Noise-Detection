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
    //alert("user logged in");
  } else {
     //alert("user logged out");
     window.location.replace("index.php");
  }
});


function signout()
{
  firebase.auth().signOut();
}
</script>

<?php 
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "username";
$password = "pargaw";
$dbname = "id5193425_esp";

$thr= $_REQUEST['thr'];
$thr= $thr ? $thr : 0;
$freq= $_REQUEST['freq'];


switch ($freq) {
    case "all":
    	$query="select x,y from node1 where y > ".$thr." order by x";
    	$query1 = "select x,y from node2 where y > ".$thr." order by x";
        break;
    case "minutes":
        $query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year,month,date,hour,minutes order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year,month,date,hour,minutes order by x";
        break;
    case "hour":
        $query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year,month,date,hour order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year,month,date,hour order by x";
        break;
    case "day":
        $query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year,month,date order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year,month,date order by x";
        break;        
    case "month":
        $query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year,month order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year,month order by x";
        break;
    case "year":
        $query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year order by x";
        break;            
    default:
	$query="select x,cast(avg(y) as int) as y   from node1  where y > ".$thr." group by year,month,date,hour,minutes order by x";
        $query1="select x,cast(avg(y) as int) as y   from node2  where y > ".$thr." group by year,month,date,hour,minutes order by x";
} 



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    //echo "---------------<br>connected to db<br>";
}
$data = mysqli_query($conn, $query);
$dataPoints = array();
while ($row = $data->fetch_assoc()) {
   
    $row["x"]=$row["x"]."000";
    array_push($dataPoints, $row);
}
$data = mysqli_query($conn, $query1);
$dataPoints1 = array();
while ($row = $data->fetch_assoc()) {
   
    $row["x"]=$row["x"]."000";
    array_push($dataPoints1, $row);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
      #map {
        height: 350px;
        width: 100%;
       }
    </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
  
  
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
	animationEnabled: false,
    zoomEnabled: true,
      title:{
      },
      data: [
      {        
      	
        type: "line",
        name: "node1",
        xValueType: "dateTime",
        xValueFormatString: "DD MMM hh:mm:ss TT",
        yValueFormatString: "#,##0.##' DB'",
        toolTipContent: "<span style='\"'color: {color};'\"'> <strong>node1 </strong> <br/><strong>Time </strong> {x} <br/> <strong>DB value</strong> {y}<br/></span>",
        dataPoints:  <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      },
        {        
        type: "line",
        name: "node2",
        xValueType: "dateTime",
        xValueFormatString: "DD MMM hh:mm:ss TT",
        yValueFormatString: "#,##0.##' DB'",
        toolTipContent: "<span style='\"'color: {color};'\"'> <strong>node2 </strong> <br/><strong>Time </strong> {x} <br/> <strong>DB value</strong> {y}<br/></span>",
        dataPoints:  <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
      }
      ]
    });

    chart.render();
  }
  </script>
 <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">Noise Control</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="compare.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="node control">
          <a class="nav-link" href="control.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Node Control</span>
          </a>
        </li>
        
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Charts</li>
      </ol>
      <!-- Icon Cards-->
      
      <!-- Area Chart Example-->
      <div class="card mb-3">
      
      <div class="card-header">
          <i class="fa fa-area-chart"></i> Select range</div>
        <div class="card-body">
        <div class="row">
        <div class="col-sm-12 col-md-6">
        <div class="dataTables_length"  id="dataTable_length">
        <label>Frequency    <?php echo "<strong>".$freq."</strong>";?>
 <form action = "compare.php" method = "get">
         <input type="hidden" name="id" value='<?php echo $id;?>' >	
        <select name="freq"  placeholder="select frequency"  aria-controls="dataTable" class="form-control form-control-sm">
        <option value="all">all data</option>
        <option value="minutes">Minutes</option>
        <option value="hour">Hourly</option>
        <option value="day">Daily</option>
        <option value="month">Monthly</option>
        <option value="year">Yearly</option>
        </select> 
     
        </label>
        </div>
        </div>
        <div class="col-sm-12 col-md-6">
        <div id="dataTable_filter" class="dataTables_filter">
        <label>Threshold:<?php echo "<strong>".$thr."</strong>";?>
        <input class="form-control form-control-sm" placeholder="" aria-controls="dataTable" name="thr" type="number"></label></div></div></div>
        </div>

        <div class="modal-footer">
            <input type="submit" value="submit" class="btn btn-secondary" data-dismiss="modal" />
       	</div>
  </form
</div>
  
        <div class="card-header">
          <i class="fa fa-area-chart"></i> All Node Data</div>
        <div class="card-body">
        <div class="card-body">
        <div id="chartContainer" style="height: 300px; width: 100%;">
        </div>
      
      
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          
          <!-- Card Columns Example Social Feed-->
          
      <!-- Example DataTables Card-->
      
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" onclick="signout()" type="button" data-dismiss="modal">Logout</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>