<?php
date_default_timezone_set("Asia/Kolkata");
$conn = mysqli_connect('localhost', 'par', 'pargaw');
if (!$conn) {
    die('<div class="alert alert-danger" style="margin:1%;">Could not connect to the database. Set Database Username and Password in the file "/how-to/data-from-database.php"</div>');
}
$selected_database = mysqli_select_db($conn, "esp");
if (!$selected_database) {
    die('<div class="alert alert-danger" style="margin:1%;">Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
            . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).</div>');
}
$var1 = $_REQUEST['d'];
$id = $_REQUEST['id'];
$hr=date("h");
if(date("a")=="pm")
{
		$hr=$hr+12;
}
//echo date("h:i:s")."\n";
$var2=$hr*60*60+date("i")*60+date("s");
$query = "insert into ".$id." values(".$var2.",".$var1.")";
$data = mysqli_query($conn, $query);

?>