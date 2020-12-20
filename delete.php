<?php 


$mysqli = new mysqli("localhost", "username", "password", "databaseName");
if($mysqli->connect_error) {
  exit('Error connecting to database');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

$empty = '';

$stmt = $mysqli->prepare("UPDATE links SET link = ? WHERE id = 1");
$stmt->bind_param("s", $empty);
$stmt->execute();
$stmt->close();
?>