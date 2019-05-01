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
<head>
  <style>
      #map {
        height: 600px;
        width: 100%;
       }
    </style>
</head>
  <body>
  <button onclick="signout()">signout</button>
  <a href="index2.php">node control</a>
  <h3>Map of nodes</h3>
     <div id="map"></div>
        <script>
      function initMap() {
        var uluru = {lat: 18.459585, lng: 73.8837288};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        
        var infowindow = new google.maps.InfoWindow({
        content: "node 1"
        });

        var marker = new google.maps.Marker({
          position: uluru,
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
        //infowindow.close(map, marker);
        window.open('graph.php?id=node1','_blank');
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCufRxoCoPo-141pQlxF6F_7kOykI_rkd0&callback=initMap">
    </script>
  </body>
