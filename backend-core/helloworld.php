<?
 header("Access-Control-Allow-Origin: *");
$DB_HOST = "localhost";
$DB_USER = "themytco_userjna";
$DB_PASS = "JnA19DB";
$DB_NAME = "themytco_jna19";

$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if($con->connect_errno > 0) {
  die('Connection failed [' . $con->connect_error . ']');
}

$tableName  = 'yourtable';
$backupFile = 'yourtable.sql';
$query      = "LOAD DATA INFILE 'backupFile' INTO TABLE $tableName";
$result = mysqli_query($con,$query);
if(!$result){
  echo"Error;";
}
?>
