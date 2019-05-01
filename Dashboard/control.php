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

$id = (!empty($_REQUEST['id'])) ? $_REQUEST['id'] : 'node1';


?>

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

      function fire()
      {
          var dbref = firebase.database().ref();
          var nid="<?php echo $id;?>";
          var val=document.getElementById('select').value;
          var ss=document.getElementById('ssid').value;
          var pp=document.getElementById('passwd').value
          alert("fire"+nid);
          if (nid != "select") {
            if (val=="select") {val="0";}
          dbref.child(nid).child("status").set(parseInt(val));  
         
          dbref.child(nid).child("ssid").set(ss);
        
          dbref.child(nid).child("passwd").set(pp);


          var delayInMilliseconds = 3000; //1 second
        setTimeout(function() {
           dbref.child(nid).child("change").set(1);
        }, delayInMilliseconds);

          //window.open('control.php?id='+nid,'_self');
        }
      } 
</script>

<script>
      function initMap() {
        var node1 = {lat: 18.459585, lng: 73.8837288};
        var node2 = {lat: 18.469585, lng: 73.8837288};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: node1
        });

        var infowindow = new google.maps.InfoWindow({
        
        });

        var marker = new google.maps.Marker({
          position: node1,
          map: map,
          url :"www.google.com"
        });
        marker.addListener('mouseover', function() {
        infowindow.setContent("node1");
        infowindow.open(map, marker);
        //window.location.replace("index.php");
        });
        marker.addListener('mouseout', function() {
        infowindow.close(map, marker);
        //window.location.replace("index.php");
        });
        marker.addListener('click', function() {
        //infowindow.close(map, marker);
        window.open('control.php?id=node1','_self');
        });




        var marker1 = new google.maps.Marker({
          position: node2,
          map: map,
          url :"www.google.com"
        });
        marker1.addListener('mouseover', function() {
        infowindow.setContent("node2");
        infowindow.open(map, marker1);
        var name="node2";
        //window.location.replace("index.php");
        });
        marker1.addListener('mouseout', function() {
        infowindow.close(map, marker1);
        var name="node2";
        //window.location.replace("index.php");
        });
        marker1.addListener('click', function() {
        //infowindow.close(map, marker);
        window.open('control.php?id=node2','_self');
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
  <title>SB Admin - Start Bootstrap Template</title>
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
    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
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
          <a class="nav-link" href="graph.php">
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
        <li class="breadcrumb-item active">Control Node</li>
      </ol>


        <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i>control map</div>
        <div class="card-body">
        <div class="card-body">
          <div id="map" width="100%" height="30%"></div>
        </div>
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Status of <?php echo $id;?></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              
              <tbody>
                  <tr>
                      <th>node</th> 
                      <th>
                      </th> 
                      <th><p id="dnode"></p></th>
                    </tr>
                    <tr>
                      <th>change</th>
                      <th><select id="select">
                            <option value="select">select operation</option>
                            <option value="1">reset</option>
                            <option value="2">change ap</option>
                            <option value="3">check online</option>
                            <option value="4">scan for ap</option>
                            <option value="5">sleep</option>
                            <option value="6">wake-up</option>
                          </select>
                      </th> 
                      <th> <p id="dchange"></p></th>
                    </tr>
                    <tr>
                      <th>list</th>
                      <th></th> 
                      <th> <p id="dlist"></p></th>
                    </tr>
                     <tr>
                      <th>ssid</th>
                      <th><input type="text" id="ssid" name="ssid" placeholder="SSID"></th> 
                      <th> <p id="dssid"></p></th>
                    </tr>
                     <tr>
                      <th>password</th>
                      <th><input type="text" id="passwd" name="passwd" placeholder="PASSWORD"></th> 
                      <th> <p id="dpasswd"></p></th>
                    </tr>
                       <tr>
                      <th>responce</th>
                      <th></th> 
                      <th> <p id="dresponce"></p></th>
                    </tr>
                       <tr>
                      <th>status</th>
                      <th></th>
                      <th> <p id="dstatus"></p></th>
                  </tr>
                  <tr>
                      <th></th>
                      <th><button onclick="fire()">send</button></th> 
                      
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>

<script type="text/javascript"> 
var nid="<?php echo $id;?>";

var dbref = firebase.database().ref();
dbref.child(nid).child("status").set(parseInt(3));  
dbref.child(nid).child("change").set(parseInt(1));
dbref.child(nid).child("responce").set("offline");


//var nid=document.getElementById('node').value;
document.getElementById("dnode").innerHTML = nid;
var rchange = firebase.database().ref().child(nid).child("change");
  rchange.on('value', function(snapshot) {
    document.getElementById("dchange").innerHTML = snapshot.val();
  });
var rlist = firebase.database().ref().child(nid).child("list");
  rlist.on('value', function(snapshot) {
    document.getElementById("dlist").innerHTML = snapshot.val();
  });

var rssid = firebase.database().ref().child(nid).child("ssid");
  rssid.on('value', function(snapshot) {
    document.getElementById("dssid").innerHTML = snapshot.val();
  });

var rpasswd = firebase.database().ref().child(nid).child("passwd");
  rpasswd.on('value', function(snapshot) {
    document.getElementById("dpasswd").innerHTML = snapshot.val();
  });
var rresponce = firebase.database().ref().child(nid).child("responce");
  rresponce.on('value', function(snapshot) {

     if (snapshot.val()=="online")
    {
      document.getElementById("dresponce").style.color = "blue";
    }
  else{
    document.getElementById("dresponce").style.color = "red";
  }
    document.getElementById("dresponce").innerHTML = snapshot.val();
  });

var rstatus = firebase.database().ref().child(nid).child("status");
  rstatus.on('value', function(snapshot) {
   
    
    document.getElementById("dstatus").innerHTML = snapshot.val();
  });
document.getElementById('select').onchange = function () {
          if(this.value == '2') {
              document.getElementById("ssid").hidden = false;
              document.getElementById("passwd").hidden =false;
          } else {
              
              document.getElementById("ssid").hidden = true;
              document.getElementById("passwd").hidden =true;
                }
      }

  function hidessid()
  {
          nid="<?php echo $id;?>";
          document.getElementById("ssid").hidden = true;
          document.getElementById("passwd").hidden =true;

  }
window.onload=hidessid;

</script>
