<?php
date_default_timezone_set("Asia/Kolkata");
$servername = "localhost";
$username = "username";
$password = "pargaw";
$dbname = "id5193425_esp";
$conn = mysqli_connect('localhost', $username, $password);
if (!$conn) {
    die('<div class="alert alert-danger" style="margin:1%;">Could not connect to the database. Set Database Username and Password in the file "/how-to/data-from-database.php"</div>');
}
$selected_database = mysqli_select_db($conn, $dbname);
if (!$selected_database) {
    die('<div class="alert alert-danger" style="margin:1%;">Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
            . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).</div>');
}

if (defined('STDIN')) {
	$id = $argv[1];
} else { 
	$id = $_REQUEST['id'];
}


if (defined('STDIN')) {
	$var1 = $argv[2];
} else { 
	$var1 = $_REQUEST['d'];
}

$query = "SELECT ID FROM ".$id;
$result = mysqli_query($conn, $query);

if(empty($result)) {
                $query = "create table ".$id." (x int(20),hour int(11),minutes int(11),sec int(11),y int(11),date int(11),month text,year int(11))";
                $result = mysqli_query($conn, $query);
}
$hr=date("h");
if(date("a")=="pm")
{
		$hr=$hr+12;
}
echo date("h:i:s")."\n";
$var2=$hr*60*60+date("i")*60+date("s");

$mydate=getdate(date("U"));
echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";

//$query = "insert into ".$id."(minutes) values(".$var2.",".$var1.")";
$query = "insert into ".$id."(x,hour,minutes,sec,date,month,year,y) values(".time().",".$hr.",".date('i').",".date('s').",".$mydate['mday'].",'".$mydate['month']."',".$mydate['year'].",".$var1.")";
echo $query;
$data = mysqli_query($conn, $query);

$WriteMyRequest=
"<p>"       .$var1 ." time in seconds :".$var2."</p>";
file_put_contents('disp.html', $WriteMyRequest, FILE_APPEND);
?>
