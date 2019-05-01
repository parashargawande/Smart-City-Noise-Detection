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

<?php 
error_reporting(E_ERROR | E_PARSE);
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

?>
</script>
<script>
      //v i b g y o r
      var colours = new Array("#9400D3","#4B0082","#0000FF","#00FF00","#FFFF00","#FF7F00","#FF0000");
      function initMap() {
        var node1 = {lat: 18.459585, lng: 73.8837288};
        var node2 = {lat: 18.459585, lng: 73.8937288};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: node1
        });

        var tcol="<?php
        $query = "select avg(y) from node1";
        $data = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($data);
        //echo $row[0];
        $dbval=$row[0];
        if($row[0] <= 15)
        {
            echo "#9400D3";
        }
        elseif ( $row[0] > 15 && $row[0] <= 30 ) {
            echo "#4B0082";
        }
        elseif ( $row[0] > 30 && $row[0] <= 45 ) {
            echo "#0000FF";
        }
        elseif ( $row[0] > 45 && $row[0] <= 60 ) {
            echo "#00FF00";
        }
        elseif ( $row[0] > 60 && $row[0] <= 75 ) {
            echo "#FFFF00";
        }
        elseif ( $row[0] > 75 && $row[0] <= 90 ) {
            echo "#FF7F00";
        }
        elseif ( $row[0] > 90 ) {
            echo "#FF0000";
        }
        ?>"
    
          var cityCircle = new google.maps.Circle({
            strokeColor: tcol,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: tcol,
            fillOpacity: 0.35,
            clickable: true,
            map: map,
            center: node1,
            radius: 50
          });

        var infowindow = new google.maps.InfoWindow({
                content: "<?php echo "node1  ".$dbval." DB";?>"
        });

        cityCircle.addListener('mouseover', function() {
        infowindow.open(map, cityCircle);
        //window.location.replace("index.php");
        });
        cityCircle.addListener('mouseout', function() {
        infowindow.close(map, cityCircle);
        //window.location.replace("index.php");
        });
        cityCircle.addListener('click', function() {
        //infowindow.close(map, marker);
        window.open('graph.php?id=node1','_blank');
        });

        var marker = new google.maps.Marker({
          position: node1,
          map: map,
          url :"www.google.com"
        });
        marker.addListener('mouseover', function() {
        infowindow.open(map, marker);
        //window.location.replace("index.php");
        });
        marker.addListener('mouseout', function() {
        infowindow.close(map, marker);
        //window.location.replace("index.php");
        });
        marker.addListener('click', function() {
        window.open('graph.php?id=node1','_blank');
        });
        
        
        
        
        
       var tcol1="<?php
        $query = "select avg(y) from node2";
        $data = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($data);
        //echo $row[0];
        $dbval1=$row[0];
        if($row[0] <= 15)
        {
            echo "#9400D3";
        }
        elseif ( $row[0] > 15 && $row[0] <= 30 ) {
            echo "#4B0082";
        }
        elseif ( $row[0] > 30 && $row[0] <= 45 ) {
            echo "#0000FF";
        }
        elseif ( $row[0] > 45 && $row[0] <= 60 ) {
            echo "#00FF00";
        }
        elseif ( $row[0] > 60 && $row[0] <= 75 ) {
            echo "#FFFF00";
        }
        elseif ( $row[0] > 75 && $row[0] <= 90 ) {
            echo "#FF7F00";
        }
        elseif ( $row[0] > 90 ) {
            echo "#FF0000";
        }
        ?>"
    
          var cityCircle1 = new google.maps.Circle({
            strokeColor: tcol1,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: tcol1,
            fillOpacity: 0.35,
            clickable: true,
            map: map,
            center: node2,
            radius: 50
          });

        var infowindow1 = new google.maps.InfoWindow({
                content: "<?php echo "node2  ".$dbval1." DB";?>"
        });

        cityCircle1.addListener('mouseover', function() {
        infowindow1.open(map, cityCircle1);
        //window.location.replace("index.php");
        });
        cityCircle1.addListener('mouseout', function() {
        infowindow1.close(map, cityCircle1);
        //window.location.replace("index.php");
        });
        cityCircle1.addListener('click', function() {
        //infowindow.close(map, marker);
        window.open('graph.php?id=node2','_blank');
        });

        var marker1 = new google.maps.Marker({
          position: node2,
          map: map,
          url :"www.google.com"
        });
        marker1.addListener('mouseover', function() {
        infowindow1.open(map, marker1);
        //window.location.replace("index.php");
        });
        marker1.addListener('mouseout', function() {
        infowindow.close(map, marker1);
        //window.location.replace("index.php");
        });
        marker1.addListener('click', function() {
        window.open('graph.php?id=node2','_blank');
        });
       
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCufRxoCoPo-141pQlxF6F_7kOykI_rkd0&callback=initMap">
    </script>
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
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Area Chart Example</div>
        <div class="card-body">
        <div class="card-header">
          <img src="scale.jpg" width="90%" height="4%">
        </div>
        <div class="card-body">
          <div id="map" width="100%" height="30%"></div>
        </div>
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
