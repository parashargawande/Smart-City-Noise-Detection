
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
    window.location.replace("index.php");
     alert("user logged out");
  }
});
function signout()
{
 // alert("signout pressed");
  firebase.auth().signOut();
}


function fire()
{
  var dbref = firebase.database().ref();
  var nid=document.getElementById('node').value;
  var val=document.getElementById('select').value;
  var ss=document.getElementById('ssid').value;
  var pp=document.getElementById('passwd').value
  //alert("fire"+val);
  dbref.child(nid).child("status").set(parseInt(val));
dbref.child(nid).child("ssid").set(ss);
  dbref.child(nid).child("passwd").set(pp);


  var delayInMilliseconds = 3000; //1 second
setTimeout(function() {
   dbref.child(nid).child("change").set(1);
}, delayInMilliseconds);

  //location.reload();
}
</script>


<head title="node-control">
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>

  <body>
  <button onclick="signout()" align="right">logout</button>
    <br>select node <select id="node">
    <option value="node1">node 1</option>
    <option value="node2">node 2</option>
    </select>

    <br>Operation on node <select id="select">
      <option value="1">reset</option>
      <option value="2">change ap</option>
      <option value="3">check online</option>
      <option value="4">scan for ap</option>
    </select>
    <br><input type="text" id="ssid" name="ssid" placeholder="SSID">
    <br><input type="text" id="passwd" name="passwd" placeholder="PASSWORD">

    <br><button onclick="fire()">send</button>
      

<table>
  <tr>
    <th>node</th>
    <th><h4 id="dnode"></h4></th>
  </tr>
  <tr>
    <th>change</th>
    <th> <h4 id="dchange"></h4></th>
  </tr>
  <tr>
    <th>list</th>
    <th> <h4 id="dlist"></h4></th>
  </tr>
   <tr>
    <th>ssid</th>
    <th> <h4 id="dssid"></h4></th>
  </tr>
   <tr>
    <th>password</th>
    <th> <h4 id="dpasswd"></h4></th>
  </tr>
     <tr>
    <th>responce</th>
    <th> <h4 id="dresponce"></h4></th>
  </tr>
     <tr>
    <th>status</th>
    <th> <h4 id="dstatus"></h4></th>
  </tr>
</table>

   </body>

<script type="text/javascript"> 

var nid=document.getElementById('node').value;
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

</script>